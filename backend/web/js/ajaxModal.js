function callAjaxModal(e,el) {
    e.preventDefault();
    $('#PjaxModal').find('.modal-header').html('<div class=\'pull-left\'><h4>' +$(el).text()+'</h4></div><button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>');
    $('#PjaxModal').modal('show')
        .find('.modal-body')
        .load($(el).attr('href'));
}