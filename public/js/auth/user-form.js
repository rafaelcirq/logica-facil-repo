// Class definition

var UserForm = function() {
    // Private functions

    var validar = function() {
        var form = $("#user-form");
        form.validate({
            // define validation rules
            rules: {
                //= Client Information(step 3)
                // Billing Information
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

            //display error alert on form submit  
            invalidHandler: function(event, validator) {
                swal.fire({
                    "title": "",
                    "text": "Existem problemas em alguns campos. Verifique-os e tente novamente.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary",
                    "onClose": function(e) {
                        console.log('on close event fired!');
                    }
                });
            },

            submitHandler: function(form) {
                event.preventDefault();
                console.log(form);
                form.submit();
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