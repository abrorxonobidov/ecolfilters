function popupWindow(url, title, w, h) {
    if (url.length == 0){
        url = document.location.href;
    }
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

$(document).ready(function () {

    $('a[href^="#"]').on("click", function(event) {
        event.preventDefault();
    });

    $('.main_menu .dropdown').hover(function () {
        $(this).addClass('open');
    }, function () {
        $(this).removeClass('open');
    });

});




