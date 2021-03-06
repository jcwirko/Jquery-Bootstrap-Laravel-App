$(document).ready(function () {
    if ($.fn.DataTable) {
        $('.dts').DataTable({
            language: {
                url: '/libs/datatables/spanish.json'
            }
        });
    }

    $('form').submit(function () {
        $(this).find('button[type=submit]').prop('disabled', true);
        $(this).find('button[type=submit] > i').removeClass('d-none');
    });
});
