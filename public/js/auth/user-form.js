// Class definition

var UserForm = function() {

    var validar = function() {
        var form = $("#user-form");
        form.validate({
            rules: {
                name: {
                    required: true,
                },
                tipo: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                checkPassword: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                "name": {
                    required: "Insira seu nome.",
                },
                "tipo": {
                    required: "Diga se você é um professor ou um aluno",
                },
                "email": {
                    required: "Insira seu email.",
                    email: "Insira um email válido."
                },
                "password": {
                    required: "Escolha uma senha.",
                    minlength: "Sua senha deve ter no mínimo 8 caracteres."
                },
                "checkPassword": {
                    required: "Confirme a senha escolhida.",
                    equalTo: "O conteúdo digitado não corresponde à senha escolhida."
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
                    // alert.addClass('m--hide').hide();
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

                        }
                    });
                }
            },
            error: function(xhr, desc, err) {

            }
        });
    }

    return {
        // public functions
        init: function() {
            validar();
        }
    };
}();

jQuery(document).ready(function() {
    UserForm.init();
});