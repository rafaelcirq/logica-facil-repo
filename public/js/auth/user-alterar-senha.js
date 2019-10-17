var Senha = function() {

    var validar = function() {
        var form = $("#user_senha_form");
        form.validate({
            rules: {
                old_password: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                check_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                "old_password": {
                    required: "Insira sua senha antiga.",
                },
                "password": {
                    required: "Insira sua nova senha.",
                    minlength: "Sua senha deve ter no mínimo 8 caracteres."
                },
                "check_password": {
                    required: "Confirma sua nova senha.",
                    equalTo: "O conteúdo digitado não corresponde à nova senha."
                }
            },
            submitHandler: function(form) {
                // $(form).submit();
                KTApp.blockPage();
                var formAction = $(form).attr('action');
                var formData = new FormData(form);
                handleAjaxFormSubmit(form, formAction, formData);
            }
        });
    }

    var handleAjaxFormSubmit = function(form, formAction, formData) {
        return $.ajax({
            url: formAction,
            type: 'POST',
            dataType: "JSON",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response, status) {

                KTApp.unblockPage();
                var alert = $('#m_form_error_msg');

                if (response.success) {
                    swal.fire({
                        "title": "Sucesso!",
                        "text": response.message,
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary",
                        timer: 2300,
                        "onClose": function(e) {}
                    });
                    if (!$("input[name='_method']").val()) {
                        $(form).trigger('reset');
                        $(form).validate().resetForm();
                    }
                } else {
                    swal.fire({
                        "title": "Erro!",
                        "text": response.message,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary",
                        timer: 2300,
                        "onClose": function(e) {
                            console.log('on close event fired!');
                        }
                    });

                    event.preventDefault();
                }
            },
            error: function(xhr, desc, err) {

            }
        });
    }

    return {
        init: function() {
            validar();
        }
    };
}();

jQuery(document).ready(function() {
    Senha.init();
});