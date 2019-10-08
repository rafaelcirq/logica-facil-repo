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

    var handleLogin = function(form, formAction, formData) {
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: formAction,
            type: 'POST',
            contentType: 'application/json',
            data: formData
        });
        console.log(request);
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