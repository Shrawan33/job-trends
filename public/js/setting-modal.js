// Always use delegated binding for dynamic forms
$(document).on('submit', '#frm_setting', function (e) {
    e.preventDefault();

    const $form = $(this);
    const actionUrl = $form.attr('action');
    const method = $form.attr('method') || 'POST';

    $.ajax({
        url: actionUrl,
        type: method,
        data: $form.serialize(),
        beforeSend: function () {
            $form.find('button[type="submit"]').prop('disabled', true);
        },
        success: function (response) {
            if (response.success) {
                toastr.success(response.message || 'Saved successfully');
                $('#modal').modal('hide');
                $('#datatable').DataTable().ajax.reload(); // optional
            } else {
                toastr.error(response.message || 'Something went wrong');
            }
        },
        error: function (xhr) {
            const msg = xhr.responseJSON?.message || 'Validation failed';
            toastr.error(msg);
        },
        complete: function () {
            $form.find('button[type="submit"]').prop('disabled', false);
        }
    });
});
