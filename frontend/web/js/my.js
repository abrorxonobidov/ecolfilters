$(document).ready(function () {
    $('.product-category-block').click(function () {
        let url = $(this).data('url');
        if (url > '')
            location.href = "http://" + location.hostname + $(this).data('url');
    })

    $('.pjaxModalButton').click(function (e) {
        callAjaxModal(e, this);
    });
})

lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
})

callAjaxModal = (e, el) => {
    e.preventDefault();
    $('#PjaxModal').modal('show')
        .find('.modal-body')
        .load($(el).attr('href'));
}