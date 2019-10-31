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

    var validar = function() {
        var form = $("#turmas_form");
        form.validate({
            rules: {
                instituicoes_id: {
                    required: true
                },
                nome: {
                    required: true
                }
            },
            messages: {
                "instituicoes_id": {
                    required: "Defina a instituição.",
                },
                "nome": {
                    required: "Defina o nome da instituição.",
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
                // var alert = $('#m_form_error_msg');

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
            onInstituicaoChange();
            select2();
            validar();
        }
    };
}();

jQuery(document).ready(function() {
    TurmasForm.init();
});