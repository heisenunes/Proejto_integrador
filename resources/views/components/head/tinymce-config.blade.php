<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#myeditorinstance',
        plugins: 'link image table code',
        toolbar: 'redo undo | fontfamily | fontsize | forecolor | bold italic underline | align lineheight checklist image editimage table link hr | code',
        toolbar_mode: 'floating',
        menubar: 'false',
        skin: 'custom',
        content_css: 'css/content.css',
    });
</script>
