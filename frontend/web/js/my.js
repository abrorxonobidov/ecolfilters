const lang = $('html').attr('lang');

let apiUrl = (controllerAction) => window.location.origin + '/' + lang + '/' + controllerAction;


$(document).ready(function () {
    $('.product-category-block').click(function () {
        let url = $(this).data('url');
        if (url > '')
            location.href = "http://" + location.hostname + $(this).data('url');
    })

    $('.pjaxModalButton').click(function (e) {
        callAjaxModal(e, this);
    });

    let form = $('#review-form');

    form.on('beforeSubmit', function (){
        $.post({
            url: apiUrl(form.data('url')),
            data: form.serialize()
        }).done(res => {
            form.trigger("reset");
            if (res.status === -1)
                toastr.error(res.text);
            else
                toastr.success(res.text);
        }).catch(e => {
            toastr.error('An error occurred');
            console.log(e);
        })
    }).submit( function (e) {
        e.preventDefault();
    })

    let linkShowMore = $('.link_show_more');

    linkShowMore.click(function () {
        let offset = $(this).data('offset');
        $.get({
            url: apiUrl('api/reviews'),
            data: $(this).data()
        }).done(res => {
            if (res.count) {
                $(this).data('offset', offset + 3) ;
                $('#review-list').append(res.html);
            } else
                if (offset > 0) toastr.warning(res.text);
        }).catch(e => {
            toastr.error('An error occurred');
            console.log(e);
        })
    })

    linkShowMore.click();


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