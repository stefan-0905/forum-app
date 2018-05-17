$(function() {
    $('#message').froalaEditor({
        height: 300
    })
  });
  $(function() {
    $('#reply').froalaEditor({
        height: 200,
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'fontFamily', 'fontSize', 'insertLink', 'insertImage', 'insertTable', 'undo', 'redo']
    })
  });