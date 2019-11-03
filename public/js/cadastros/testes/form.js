"use strict";

var TestesForm = function() {

    var mask = function() {
        $("#valor").mask('00.00');
    }

    var validar = function() {
        var form = $("#testes_form");
        form.validate({
            rules: {
                nome: {
                    required: true
                },
                valor: {
                    required: true
                },
                data_inicio: {
                    required: true
                },
                data_limite: {
                    required: true
                }
            },
            messages: {
                "nome": {
                    required: "Defina um nome para o teste."
                },
                "valor": {
                    required: "Defina o valor do teste."
                },
                "data_inicio": {
                    required: "Defina uma data para o início do teste."
                },
                "data_limite": {
                    required: "Defina uma data limite para o teste."
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
            success: function(response, status, form) {

                // var idTurma = $("#turma_id").val();
                // if (idTurma === undefined) {
                $('#testes_form')[0].reset();
                // formRepeater();
                //     select2();
                //     setAlunos();
                // }

                KTApp.unblockPage();

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

    var dateTimePickerLimite = function(dataInicial) {
        $('#data_limite').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy-mm-dd hh:ii',
            startDate: dataInicial
        });
    }

    var dateTimePickerInicial = function() {
        $('#data_inicio').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy-mm-dd hh:ii',
            startDate: new Date()
        });
    }

    var dateTimePickerChange = function() {
        $('#data_inicio').change(function() {
            var data = $(this).val();
            $('#data_limite').val('');
            $('#data_limite').datetimepicker('setStartDate', data);
        });
    }

    var formRepeater = function() {
        $('#kt_repeater_3').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                if (confirm('Tem certeza que deseja excluir esta questão?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    }

    return {
        // public functions
        init: function() {
            mask();
            dateTimePickerInicial();
            dateTimePickerLimite(new Date());
            dateTimePickerChange();
            formRepeater();
            validar();
        }
    };
}();

jQuery(document).ready(function() {
    TestesForm.init();
});