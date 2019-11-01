"use strict";

var ProfessorTestes = function() {

    var datatableTestes = function() {
        var id = $("#turma_id").val();
        var datatable = $('#professor_testes_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: 'turmas/' + id + '/testes',
                        map: function(raw) {
                            var dataSet = raw;

                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }

                            return dataSet;
                        },
                    },
                },
                pageSize: 30,
                serverPaging: false,
                serverFiltering: false,
                serverSorting: false,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#busca_geral')
            },

            translate: {
                toolbar: {
                    pagination: {
                        items: {
                            info: 'Mostrando {{start}} - {{end}} de {{total}} registros',
                        }
                    }
                },
                records: {
                    noRecords: 'Ainda não há testes para esta turma.'
                }
            },

            // columns definition
            columns: [{
                field: 'nome',
                title: 'Nome',
                textAlign: 'center'
            }, {
                field: 'data_inicio',
                title: 'Data Início',
                textAlign: 'center',
            }, {
                field: 'data_limite',
                title: 'Data Limite',
                textAlign: 'center',
            }, {
                field: 'valor',
                title: 'Valor',
                textAlign: 'center',
            }, {
                field: 'Actions',
                title: 'Ações',
                sortable: false,
                width: 110,
                autoHide: false,
                overflow: 'visible',
                textAlign: 'center',
                template: function(row, index, professor) {
                    var idTurma = $("#turma_id").val();
                    return '\
                    <a href="testes/' + row.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detalhes">\
                        <i class="la la-eye"></i>\
                    </a>\
                    <a href="javascript:;" data-id="' + row.id + '" row-index="' + index + '" class="btn btn-sm btn-clean btn-icon btn-icon-md m_sweetalert_delete" title="Excluir">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
                },
            }],

        });

        $(document).on('click', '.m_sweetalert_delete', function() {
            var id = $(this).attr("data-id");
            var index = $(this).attr("row-index");
            deleteData(id, index, datatable);
        });
    };

    var deleteData = function(id, index, datatable) {
        swal.fire({
            "title": "Deseja realmente excluir esta turma?",
            "text": "Esta ação não poderá ser desfeita!",
            "type": "warning",
            "showCancelButton": "true",
            "confirmButtonText": "Confirmar",
            "cancelButtonText": 'Cancelar'
        }).then(function(result) {

            if (result.value) {

                KTApp.blockPage();
                var form = $('#delete_form_' + id);
                var formAction = form.attr('action');
                var formData = form.serializeArray();

                $.post(formAction, formData, function(response) {

                    KTApp.unblockPage();

                    if (response.success) {

                        datatable.reload();

                        swal.fire({
                            'type': 'success',
                            'title': 'Deletado!',
                            'text': response.message, //Registro excluído com sucesso.
                            'showConfirmButton': true,
                            'timer': 2300,
                            onClose: () => {
                                // Synerg.scrollTo('#app');
                            }
                        });
                    } else {
                        swal.fire("Erro!", response.message, "error");
                    }

                }, 'json');
            }
        });
    };

    return {
        // public functions
        init: function() {
            datatableTestes();
        }
    };
}();

jQuery(document).ready(function() {
    ProfessorTestes.init();
});