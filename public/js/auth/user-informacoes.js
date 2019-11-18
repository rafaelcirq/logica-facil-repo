var Informacoes = function() {

    var setTipo = function() {
        var tipo = $('#tipo-user').val();
        $('#tipo').val(tipo);
    }

    var validar = function() {
        var form = $("#user_info_form");
        form.validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                "name": {
                    required: "Insira seu nome.",
                },
                "email": {
                    required: "Insira seu email.",
                    email: "Insira um email válido."
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
            setTipo();
        }
    };
}();

jQuery(document).ready(function() {
    Informacoes.init();
});