$(document).ready(function () {
    $(document).on('click', '.removeCrnt', function () {
        $('.loading_image').show();
        var url = $(this).attr('data-att-href');
        $(this).parent().parent().remove();
        window.location.href = url;
    });
    $('.alert-success').delay(1000).fadeOut();
    $('#example').DataTable({
        dom: 'lBfrtip',
        buttons: ['excel', 'csv']
    });
    $('#exampleTable').DataTable({
        dom: 'lBfrtip',
        buttons: ['excel', 'csv']
       

    });


});
