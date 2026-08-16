# Article Content Editor: CKEditor 5 Swap Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the Quill 2 editor used for the article "Content" field with CKEditor 5, so authors get robust paste cleanup (fixes the `&nbsp;` corruption bug), more editing features (tables, media embed), and a better UX — touching only the content-editing/display pipeline.

**Architecture:** A new Blade partial (`_ckeditor.blade.php`) loads CKEditor 5's self-contained browser UMD bundle from CDN (no build tool, same pattern Quill used) and wires it to the existing hidden `content` form field. `create.blade.php`/`edit.blade.php` swap their `@include` and drop the Quill CSS `<link>`. The `Article` model's now-redundant `&nbsp;`-normalizing mutators are removed. Everything downstream (controller validation, DB column, public `article-detail.blade.php` rendering) is untouched.

**Tech Stack:** CKEditor 5 v48.4.0, "browser" self-hosted UMD distribution (`ckeditor5.umd.js` + `ckeditor5.css`) from jsDelivr, GPL self-hosted license (`licenseKey: 'GPL'`).

## Global Constraints

- Scope is limited to: the editor partial, the two lines in create/edit views that reference it, and the `Article` model mutators. No route, controller logic, migration, or other page changes.
- `content` stays a plain HTML string — no storage format change.
- Image upload reuses the existing `manager.articles.upload-image` route and its current `{"url": "..."}` JSON response verbatim — no backend changes.
- No server-side HTML sanitization is being added (explicit decision from the design phase).
- No automated test suite covers this admin flow today (consistent with the rest of the manager UI) — verification throughout this plan is manual: PHP lint (`docker compose exec -T php php -l <file>`) plus real-browser checks (Playwright screenshots, matching the pattern already used in this project's dev workflow) or by hand in the browser.
- Self-hosted GPL usage of CKEditor 5 shows a small "Powered by CKEditor" badge in the corner of the editor UI — this is expected and only visible in the admin editor, never on the public site. Not a bug.

---

### Task 1: Build the CKEditor 5 partial

**Files:**
- Create: `resources/views/manager/articles/_ckeditor.blade.php`

**Interfaces:**
- Consumes: an optional `$initialContent` (string) variable passed via `@include`, exactly like `_quill.blade.php` did.
- Produces: a CKEditor instance mounted on `#content-editor`, and on the `#articleForm` submit event, writes the editor's current HTML into `#content-input` (the existing hidden field both create/edit forms already have) — same contract `_quill.blade.php` fulfilled, so Task 2 only needs to swap the include line.

- [ ] **Step 1: Create the partial with the full editor setup**

```blade
{{-- CKEditor 5 partial. Pass $initialContent (string) to pre-populate. --}}
<script src="https://cdn.jsdelivr.net/npm/ckeditor5@48.4.0/dist/browser/ckeditor5.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ckeditor5@48.4.0/dist/browser/ckeditor5.css">
<script>
    const {
        ClassicEditor, Essentials, Paragraph, Heading,
        Bold, Italic, Underline, Strikethrough,
        FontColor, FontBackgroundColor, Alignment,
        List, Indent, BlockQuote, CodeBlock, Link,
        Image, ImageUpload, ImageResize, ImageStyle, ImageToolbar, SimpleUploadAdapter,
        Table, TableToolbar, MediaEmbed, PasteFromOffice,
    } = CKEDITOR;

    const ckCsrfToken = document.querySelector('meta[name="csrf-token"]').content;

    ClassicEditor
        .create(document.getElementById('content-editor'), {
            licenseKey: 'GPL',
            plugins: [
                Essentials, Paragraph, Heading,
                Bold, Italic, Underline, Strikethrough,
                FontColor, FontBackgroundColor, Alignment,
                List, Indent, BlockQuote, CodeBlock, Link,
                Image, ImageUpload, ImageResize, ImageStyle, ImageToolbar, SimpleUploadAdapter,
                Table, TableToolbar, MediaEmbed, PasteFromOffice,
            ],
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', '|',
                'fontColor', 'fontBackgroundColor', 'alignment', '|',
                'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                'blockQuote', 'codeBlock', 'link', 'uploadImage', 'insertTable', 'mediaEmbed', '|',
                'undo', 'redo',
            ],
            image: {
                toolbar: [
                    'imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|',
                    'toggleImageCaption', 'imageTextAlternative', 'resizeImage',
                ],
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
            },
            simpleUpload: {
                uploadUrl: '{{ route('manager.articles.upload-image') }}',
                headers: { 'X-CSRF-TOKEN': ckCsrfToken },
            },
        })
        .then(editor => {
            window.contentEditor = editor;

            @if(!empty($initialContent))
            editor.setData({!! Js::from($initialContent) !!});
            @endif

            document.getElementById('articleForm').addEventListener('submit', function () {
                document.getElementById('content-input').value = editor.getData();
            });
        })
        .catch(error => console.error('CKEditor init failed:', error));
</script>
```

- [ ] **Step 2: Lint the new file**

Run: `docker compose exec -T php php -l resources/views/manager/articles/_ckeditor.blade.php`
Expected: `No syntax errors detected`

- [ ] **Step 3: Commit**

```bash
git add resources/views/manager/articles/_ckeditor.blade.php
git commit -m "feat: add CKEditor 5 partial for article content editing"
```

---

### Task 2: Wire CKEditor into the create/edit pages

**Files:**
- Modify: `resources/views/manager/articles/create.blade.php`
- Modify: `resources/views/manager/articles/edit.blade.php`

**Interfaces:**
- Consumes: `_ckeditor.blade.php` from Task 1, `$initialContent` passed the same way `_quill.blade.php` received it (`old('content', '')` on create, `old('content', $article->content)` on edit).
- Produces: nothing new for later tasks — this is the integration point the whole feature hangs off of.

- [ ] **Step 1: Update `create.blade.php`**

Remove this line (the Quill CDN stylesheet):
```blade
    {{-- Quill CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
```

Change the editor mount div:
```blade
                    <div id="quill-editor" style="min-height:320px;"></div>
```
to:
```blade
                    <div id="content-editor" style="min-height:320px;"></div>
```

Change the include at the bottom of the file:
```blade
    @include('manager.articles._quill', ['initialContent' => old('content', '')])
```
to:
```blade
    @include('manager.articles._ckeditor', ['initialContent' => old('content', '')])
```

- [ ] **Step 2: Update `edit.blade.php`**

Remove this line:
```blade
    {{-- Quill CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
```

Change the editor mount div:
```blade
                    <div id="quill-editor" style="min-height:320px;"></div>
```
to:
```blade
                    <div id="content-editor" style="min-height:320px;"></div>
```

Change the include:
```blade
    @include('manager.articles._quill', ['initialContent' => old('content', $article->content)])
```
to:
```blade
    @include('manager.articles._ckeditor', ['initialContent' => old('content', $article->content)])
```

- [ ] **Step 3: Lint both files**

Run:
```bash
docker compose exec -T php php -l resources/views/manager/articles/create.blade.php
docker compose exec -T php php -l resources/views/manager/articles/edit.blade.php
```
Expected: `No syntax errors detected` for both.

- [ ] **Step 4: Manually verify the create page**

Log into the manager panel and open `/manager/articles/create`. Confirm:
- CKEditor loads (toolbar with Heading/Bold/Italic/.../Table/Media embed visible), no console errors.
- Typing text and clicking "Save Article" with a title filled in creates an article whose content matches what was typed (check via `/manager/articles` list → open the article, or query the DB: `docker compose exec -T mysql mysql -u bea_user -psecret -e "SELECT content FROM articles ORDER BY id DESC LIMIT 1;" bea_english`).

- [ ] **Step 5: Manually verify the edit page pre-population**

Open `/manager/articles/{id}/edit` for an existing article. Confirm the editor loads pre-filled with that article's existing content (proves `editor.setData()` wiring works), and that saving without changes doesn't corrupt it.

- [ ] **Step 6: Commit**

```bash
git add resources/views/manager/articles/create.blade.php resources/views/manager/articles/edit.blade.php
git commit -m "feat: switch article create/edit forms to CKEditor 5"
```

---

### Task 3: Remove the now-redundant `&nbsp;` mutators

**Files:**
- Modify: `app/Models/Article.php`

**Interfaces:**
- Consumes: nothing new.
- Produces: nothing new — this is a pure removal, safe to do once Task 2 confirms CKEditor's own `PasteFromOffice` plugin is doing the paste cleanup instead.

- [ ] **Step 1: Remove the two mutators**

In `app/Models/Article.php`, delete this block (added in the earlier `&nbsp;`-fix commit):
```php
    public function setContentAttribute(?string $value): void
    {
        $this->attributes['content'] = $value === null
            ? null
            : str_replace(["\u{00A0}", '&nbsp;'], ' ', $value);
    }

    public function setExcerptAttribute(?string $value): void
    {
        $this->attributes['excerpt'] = $value === null
            ? null
            : str_replace(["\u{00A0}", '&nbsp;'], ' ', $value);
    }
```

- [ ] **Step 2: Confirm nothing else references these methods**

Run: `grep -rn "setContentAttribute\|setExcerptAttribute" app/ resources/`
Expected: no matches.

- [ ] **Step 3: Lint the model**

Run: `docker compose exec -T php php -l app/Models/Article.php`
Expected: `No syntax errors detected`

- [ ] **Step 4: Commit**

```bash
git add app/Models/Article.php
git commit -m "refactor: remove redundant nbsp mutators now that CKEditor cleans paste input"
```

---

### Task 4: End-to-end feature verification and public-page rendering check

**Files:**
- No file changes expected. Only touch `resources/views/home/article-detail.blade.php` if Step 3 below finds a real rendering gap — in that case, add the smallest possible additional CSS selector (e.g. targeting `figure.image`/`figure.table`), not a restructure.

**Interfaces:**
- Consumes: the working editor from Tasks 1–2 and the cleaned-up model from Task 3.
- Produces: the signed-off, done state of this plan.

- [ ] **Step 1: Exercise every toolbar feature in one test article**

In `/manager/articles/create`, author a test article that uses: an H2 heading, bold/italic/underline/strikethrough text, a font color change, a bulleted list, an indented list item, a block quote, a code block, a hyperlink, an uploaded image (resize it and set an alignment via the image's own floating toolbar), a table (2x2, type some text in cells), and a media embed (paste a YouTube URL). Save as Published.

- [ ] **Step 2: Confirm image upload works end-to-end**

While authoring the test article, confirm the uploaded image actually appears in the editor (proves `SimpleUploadAdapter` correctly hit `manager.articles.upload-image` and inserted the returned URL) — check Network tab shows a `200` from that endpoint if anything looks off.

- [ ] **Step 3: Visually check the public article-detail page**

Visit `/tin-tuc/{slug}` for the test article from Step 1 (desktop viewport). Confirm:
- The image renders with rounded corners and constrained width (matching `prose-img:rounded-xl prose-img:max-w-full` in `resources/views/home/article-detail.blade.php:107`).
- The table renders full-width and scrolls horizontally on overflow rather than breaking the page layout (matching `[&_table]:w-full [&_table]:block [&_table]:overflow-x-auto` at `article-detail.blade.php:112`).
- The code block, block quote, and headings are styled consistently with the rest of the article body.

If any of these look wrong because CKEditor wrapped the element differently than Quill did (e.g. `<figure class="image">` around the `<img>`, or `<figure class="table">` around the `<table>`), add the smallest additional Tailwind arbitrary-variant selector to the `#article-content` class list in `article-detail.blade.php` to fix just that gap — do not restructure the existing prose classes.

- [ ] **Step 4: Regression-check the original `&nbsp;` bug**

Open the manager edit page for the article that previously had the `&nbsp;`-corruption bug (`7-phuong-phap-hoc-tieng-anh-tai-nha-hieu-qua-cho-nguoi-moi-bat-dau` in production, or the local test article `123` used earlier this session), paste in a paragraph of Vietnamese text copied from a Word document or Google Docs (a real paste, not typed text — this is what triggers `&nbsp;` in the first place), save, and confirm the public detail page wraps the text normally at word boundaries with no horizontal overflow. This is the regression case that motivated this whole change — it must pass with the mutators removed, relying solely on CKEditor's `PasteFromOffice` plugin.

- [ ] **Step 5: Clean up the test article**

Delete or set to Draft the test article created in Step 1, and restore any test article content changed in Step 4 back to its original state, so this verification work doesn't leave visible junk on the live site.

- [ ] **Step 6: Final commit (only if Step 3 required a CSS fix)**

```bash
git add resources/views/home/article-detail.blade.php
git commit -m "fix: adjust prose selectors for CKEditor's image/table figure wrappers"
```

If Step 3 required no changes, there is nothing to commit for this task — the plan is complete after Task 3's commit.
