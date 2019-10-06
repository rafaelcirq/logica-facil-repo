"use strict";

var Login = function() {

    var validation = function() {
        $("#kt-form").validate({
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
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary",
                    "onClose": function(e) {
                        console.log('on close event fired!');
                    }
                });

                event.preventDefault();
            },

            submitHandler: function(form) {
                //form[0].submit(); // submit the form
                swal.fire({
                    "title": "",
                    "text": "Form validation passed. All good!",
                    "type": "success",
                    "confirmButtonClass": "btn btn-secondary"
                });

                return false;
            }
        });
    }

    return {
        // public functions
        init: function() {
            validation();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    Login.init();
});