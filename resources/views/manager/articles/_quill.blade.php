{{-- Quill editor partial. Pass $initialContent (string) to pre-populate. --}}
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
<style>
    #img-resize-bar { display:none; position:absolute; z-index:100; background:#fff; border:1px solid #e0e0e0; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,.12); padding:6px 8px; align-items:center; gap:6px; }
    #img-resize-bar button { padding:2px 8px; font-size:11px; border:1px solid #ccc; border-radius:5px; background:#f5f5f5; cursor:pointer; }
    #img-resize-bar button:hover { background:#e8e8e8; }
    #img-resize-bar input { width:60px; padding:2px 6px; font-size:11px; border:1px solid #ccc; border-radius:5px; text-align:center; }
    #img-resize-bar .sep { width:1px; height:18px; background:#e0e0e0; }
</style>
<script>
    const uploadUrl = '{{ route('manager.articles.upload-image') }}';
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function imageHandler() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.click();
        input.onchange = async () => {
            const file = input.files[0];
            if (!file) return;
            const fd = new FormData();
            fd.append('image', file);
            fd.append('_token', csrfToken);
            const res = await fetch(uploadUrl, { method: 'POST', body: fd });
            const { url } = await res.json();
            const range = quill.getSelection(true);
            quill.insertEmbed(range.index, 'image', url);
            quill.setSelection(range.index + 1);
        };
    }

    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    [{ header: [1, 2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ color: [] }, { background: [] }],
                    [{ align: [] }],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    [{ indent: '-1' }, { indent: '+1' }],
                    ['blockquote', 'code-block'],
                    ['link', 'image'],
                    ['clean'],
                ],
                handlers: { image: imageHandler },
            },
        },
    });

    @if(!empty($initialContent))
    quill.clipboard.dangerouslyPasteHTML({!! Js::from($initialContent) !!});
    @endif

    document.getElementById('articleForm').addEventListener('submit', function () {
        document.getElementById('content-input').value = quill.getSemanticHTML();
    });

    // Image resize & alignment toolbar
    const resizeBar = document.createElement('div');
    resizeBar.id = 'img-resize-bar';
    resizeBar.innerHTML = `
        <span style="font-size:11px;color:#666;font-weight:600;">Size:</span>
        <button type="button" data-w="25%">25%</button>
        <button type="button" data-w="50%">50%</button>
        <button type="button" data-w="75%">75%</button>
        <button type="button" data-w="100%">100%</button>
        <div class="sep"></div>
        <input type="number" id="img-px-input" placeholder="px" min="10" max="2000">
        <div class="sep"></div>
        <button type="button" data-align="left"   title="Align left">⬅</button>
        <button type="button" data-align="center" title="Align center">↔</button>
        <button type="button" data-align="right"  title="Align right">➡</button>
    `;
    document.getElementById('quill-editor').parentElement.style.position = 'relative';
    document.getElementById('quill-editor').parentElement.appendChild(resizeBar);

    let activeImg = null;

    resizeBar.querySelectorAll('button[data-w]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (!activeImg) return;
            activeImg.style.width = btn.dataset.w;
            activeImg.removeAttribute('width');
            positionBar(activeImg);
        });
    });

    resizeBar.querySelectorAll('button[data-align]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (!activeImg) return;
            const align = btn.dataset.align;
            if (align === 'left')   { activeImg.style.float = 'left';  activeImg.style.display = '';      activeImg.style.margin = '0 1em 0.5em 0'; }
            if (align === 'center') { activeImg.style.float = '';       activeImg.style.display = 'block'; activeImg.style.margin = '0 auto'; }
            if (align === 'right')  { activeImg.style.float = 'right'; activeImg.style.display = '';      activeImg.style.margin = '0 0 0.5em 1em'; }
            positionBar(activeImg);
        });
    });

    resizeBar.querySelector('#img-px-input').addEventListener('keydown', e => {
        if (e.key === 'Enter' && activeImg) {
            activeImg.style.width = e.target.value + 'px';
            activeImg.removeAttribute('width');
            positionBar(activeImg);
        }
    });

    function positionBar(img) {
        const editorEl = document.getElementById('quill-editor');
        const editorRect = editorEl.getBoundingClientRect();
        const imgRect = img.getBoundingClientRect();
        const top = imgRect.top - editorRect.top + editorEl.offsetTop - 44;
        const left = imgRect.left - editorRect.left + editorEl.offsetLeft;
        resizeBar.style.top = Math.max(0, top) + 'px';
        resizeBar.style.left = left + 'px';
        resizeBar.style.display = 'flex';
        const pxInput = resizeBar.querySelector('#img-px-input');
        pxInput.value = img.style.width ? parseInt(img.style.width) || '' : '';
    }

    quill.root.addEventListener('click', e => {
        if (e.target.tagName === 'IMG') {
            activeImg = e.target;
            positionBar(activeImg);
        } else {
            activeImg = null;
            resizeBar.style.display = 'none';
        }
    });

    document.addEventListener('click', e => {
        if (!resizeBar.contains(e.target) && e.target.tagName !== 'IMG') {
            activeImg = null;
            resizeBar.style.display = 'none';
        }
    });
</script>
