$(document).ready(function() {
    $('.editor').click(function() {
        $('#updateform-id').val(this.dataset.id);
        $('.backModal').show();
    });
    $('.modalForm .close').click(function() {
        $('.backModal').hide();
    });
    $('.field-signupform-adminpass').hide();
    $('#signupform-adminpass').prop('disabled', true)
    $('#signupform-admin').click(function() {
        if ($('#signupform-adminpass').prop('disabled')) {
            $('.field-signupform-adminpass').show();
            $('#signupform-adminpass').prop('disabled', false)
            $('#signupform-adminpass').prop('required', true)
        } else {
            $('.field-signupform-adminpass').hide();
            $('#signupform-adminpass').prop('disabled', true)
            $('#signupform-adminpass').prop('required', false)
        }
    })

});