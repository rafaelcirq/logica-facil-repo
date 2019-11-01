"use strict";

var Load = function() {

    var loadStart = function() {
        // KTApp.blockPage();
    }

    var loadEnd = function() {
        $(window).on('load', function() {
            console.log("terminou");
            KTApp.unblockPage();
        });
    }

    return {
        // public functions
        init: function() {
            loadStart();
            loadEnd();
        }
    };
}();

jQuery(document).ready(function() {
    Load.init();
});