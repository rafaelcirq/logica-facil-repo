// Class definition

var Login = function() {
    // Private functions

    var validar = function() {
        $("#save_form").validate({
            // define validation rules
            rules: {
                //= Client Information(step 3)
                // Billing Information
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                "email": {
                    required: "Insira seu email.",
                    email: "Insira um email válido."
                },
                "password": {
                    required: "Insira sua senha."
                }
            },

            //display error alert on form submit  
            invalidHandler: function(event, validator) {
                swal.fire({
                    "title": "",
                    "text": "Existem campos não preenchidos. Verifique-os e tente novamente.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary",
                    "onClose": function(e) {
                        console.log('on close event fired!');
                    }
                });
                event.preventDefault();
            },

            submitHandler: function(form) {
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
    Login.init();
});