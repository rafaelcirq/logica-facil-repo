"use strict";

var TurmasForm = function() {

    var select2 = function() {
        $('.kt-select2').select2({

        });
    }

    var setAlunos = function() {
        var instituicao = $('#instituicoes_id').val();
        $.ajax({
            url: "/turmas/" + instituicao + "/alunos",
            success: function(data) {
                $('#alunos').empty();
                jQuery.each(data, function(index, aluno) {
                    $('#alunos').append(
                        `<option value="${aluno.id}"> 
                            ${aluno.name} 
                        </option>`);
                });
            }
        });
    }

    var onInstituicaoChange = function() {
        $("#instituicoes_id").change(function() {
            setAlunos();
        });
    }

    return {
        // public functions
        init: function() {
            onInstituicaoChange();
            select2();
        }
    };
}();

jQuery(document).ready(function() {
    TurmasForm.init();
});