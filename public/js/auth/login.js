// Class definition

var Login = function() {
    // Private functions

    var validar = function() {
        var form = $("#save_form");
        form.validate({
            rules: {
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