# Article Content Editor: Replace Quill with CKEditor 5 — Design

**Goal:** Replace the Quill 2 rich-text editor used for the article "Content" field with CKEditor 5, to get more robust paste handling (no more `&nbsp;`-style corruption), more editing features (tables, media embed), and a better authoring UX — without touching anything outside the content-editing/display pipeline.

**Architecture:** Same integration pattern as today: a Blade partial embeds the editor via CDN `<script>`/`<link>` tags (no build tool), the create/edit pages include it and read the editor's HTML output into the existing hidden `content` form field on submit. Controller, model, migrations, routes, and the public article-detail display all stay as they are today, since CKEditor still produces standard HTML compatible with the current `.prose` (Tailwind Typography) rendering.

**Tech Stack:** CKEditor 5 "Classic Build", loaded from CDN (jsDelivr), version pinned to an exact release (not a floating `@2`-style tag as Quill currently uses).

## Global Constraints

- Scope is limited to the article Content field: editor partial, the two lines in create/edit views that reference it, and (only if needed) minor CSS selector additions in `article-detail.blade.php` for CKEditor's image/table wrapper markup. No other page, route, controller method, or model field changes.
- `content` remains a plain HTML string in the DB — no change to storage format (ruling out block/JSON-based editors).
- Image upload reuses the existing `manager.articles.upload-image` route and its current `{"url": "..."}` JSON response — no backend changes for uploads.
- No server-side HTML sanitization step is being added (explicit decision — relying on CKEditor's client-side paste cleanup only, consistent with the existing trust model where only manager/vice-manager roles can reach this form).
- Remove the `setContentAttribute` / `setExcerptAttribute` mutators added to `App\Models\Article` in the prior `&nbsp;`-fix commit — they become redundant now that the editor itself cleans paste input, and the earlier decision was explicitly to not layer a server-side content filter on top of the editor.
- Existing articles (authored via Quill) keep rendering unchanged; no data migration.

---

## Components

**`resources/views/manager/articles/_ckeditor.blade.php` (new)**
Replaces `_quill.blade.php`. Responsibilities:
- Load CKEditor 5 Classic Build CSS/JS from CDN, pinned to an exact version.
- Initialize the editor on `#content-editor` (renamed from `#quill-editor`) with this toolbar: Heading, Bold, Italic, Underline, Strikethrough, Font color, Font background color, Alignment, Bulleted list, Numbered list, Indent/Outdent, Block quote, Code block, Link, Image (upload/resize/style — CKEditor's built-in image toolbar), Insert table, Media embed.
- Configure `SimpleUploadAdapter` pointing at `route('manager.articles.upload-image')` with the CSRF token header, matching the existing endpoint's `{ "url": "..." }` response shape.
- Pre-populate initial content via `editor.setData(...)` when editing an existing article (equivalent of Quill's `dangerouslyPasteHTML`).
- On the article form's submit event, write `editor.getData()` into the existing hidden `#content-input` before the browser submits.
- The hand-rolled image resize/align toolbar (`#img-resize-bar` and its positioning JS) is deleted entirely — CKEditor's native image toolbar replaces it.

**`resources/views/manager/articles/create.blade.php` / `edit.blade.php` (edited)**
Two changes only, applied identically to both files:
1. Remove the Quill CDN `<link href=".../quill.snow.css">` line. CKEditor 5's Classic prebuilt bundle (the self-contained distribution, one `<script>` tag) bundles its own styling internally — no separate stylesheet `<link>` is needed, unlike Quill.
2. Swap `@include('manager.articles._quill', ['initialContent' => ...])` for `@include('manager.articles._ckeditor', ['initialContent' => ...])`.
3. The editor mount point `<div id="quill-editor" ...>` becomes `<div id="content-editor" ...>`; the surrounding card markup, label, and hidden `#content-input` are untouched.

Everything else on these two pages (title, excerpt, status, category, tags, thumbnail, form action/method) is untouched.

**`app/Models/Article.php` (edited)**
Delete the `setContentAttribute` and `setExcerptAttribute` mutators added in the earlier `&nbsp;`-normalization fix. Nothing else in the model changes.

**`resources/views/home/article-detail.blade.php` (touched only if verification finds a rendering gap)**
CKEditor wraps images as `<figure class="image"><img ...></figure>` and tables as `<figure class="table"><table>...</table></figure>`, rather than Quill's bare `<img>`/`<table>`. Tailwind Typography's `prose-img:` and the existing `[&_table]:...` arbitrary-variant selectors target `img`/`table` by tag regardless of ancestor wrapper, so no change is expected — but this gets a real visual check in Task testing (render an article with an image and a table, compare against the current design) before being called done. If a gap is found, the fix is additive CSS selectors only (e.g. targeting `figure.image` for spacing), not a restructuring of the prose container.

## Data Flow

1. Manager opens create/edit → `_ckeditor.blade.php` boots CKEditor, optionally seeded with existing `$article->content` via `editor.setData()`.
2. Manager types/pastes content and images; CKEditor cleans pasted HTML (strips `&nbsp;` runs, Word/Google Docs cruft) as part of its own paste pipeline — no app code involved in that cleanup.
3. Image uploads go through the unchanged `manager.articles.upload-image` endpoint; CKEditor's `SimpleUploadAdapter` inserts the returned URL as an `<img>`.
4. On submit, `editor.getData()` → hidden `#content-input` → normal POST/PUT to `ArticleController@store`/`@update`, which validate `content` as `required|string` and save it as-is (unchanged).
5. Public article-detail page renders `{!! $article->content !!}` inside `.prose` exactly as today.

## Error Handling

- No new failure modes introduced: image upload failure behavior (network/validation errors from the existing endpoint) is handled the same way CKEditor's upload adapter surfaces adapter errors today would need to under Quill's custom handler — i.e., CKEditor's built-in upload UI shows its own inline error state on a failed request, which is a UX improvement over the current silent `fetch` in `_quill.blade.php` (no error handling today if the upload request fails).
- Form validation (`content required`) is untouched; an editor left empty still fails the same server-side rule.

## Testing

- Manual verification only (no existing automated test suite covers this admin flow, consistent with the rest of the project's manager UI).
- Create a new article using every toolbar feature at least once (heading, list, table, image upload + resize, media embed, code block, link) and confirm the saved HTML renders correctly on the public article-detail page.
- Edit the article that previously had the `&nbsp;` corruption bug and confirm re-saving through the new editor produces clean, correctly-wrapping text (this is the regression case this whole change is motivated by).
- Confirm image upload still works end-to-end through the unchanged `upload-image` route.
- Confirm mobile view of an edited article is unaffected (this page's mobile layout was not part of the recent overflow bug and should stay that way).
