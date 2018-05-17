$(document).ready(function(){
    $('.carousel').carousel({
        interval: 4000
    })

    $(document).on('click', '#quick-reply', function (){
        $('#reply-it').removeClass('d-none');
    })
});
