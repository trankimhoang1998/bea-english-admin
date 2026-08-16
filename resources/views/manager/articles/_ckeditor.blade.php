{{-- CKEditor 5 partial. Pass $initialContent (string) to pre-populate. --}}
<script src="https://cdn.jsdelivr.net/npm/ckeditor5@48.4.0/dist/browser/ckeditor5.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ckeditor5@48.4.0/dist/browser/ckeditor5.css">
<script>
    const {
        ClassicEditor, Essentials, Paragraph, Heading,
        Bold, Italic, Underline, Strikethrough,
        FontColor, FontBackgroundColor, Alignment,
        List, Indent, BlockQuote, CodeBlock, Link,
        Image, ImageUpload, ImageResize, ImageStyle, ImageToolbar, ImageCaption, SimpleUploadAdapter,
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
                Image, ImageUpload, ImageResize, ImageStyle, ImageToolbar, ImageCaption, SimpleUploadAdapter,
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
            mediaEmbed: {
                previewsInData: true,
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
