$(document).ready(function () {
    $('.product-category-block').click(function () {
        let url = $(this).data('url');
        if (url > '')
            location.href = "http://" + location.hostname + $(this).data('url');
    })
})