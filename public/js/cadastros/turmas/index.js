"use strict";

var TurmasIndex = function() {

    var datatableTurmas = function() {

        var datatable = $('#turmas_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: 'turmas',
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
                    noRecords: 'Você ainda não faz parte de nenhuma turma.'
                }
            },

            // columns definition
            columns: [{
                field: 'nome',
                title: 'Nome',
                textAlign: 'center'
            }, {
                field: 'instituicao.nome',
                title: 'Instituição',
                textAlign: 'center',
            }, {
                field: 'professor.name',
                title: 'Professor',
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
                    var tipo = $("#user-tipo").val();
                    var display = tipo === "Professor" ? "unset" : "none";
                    return '\
                    <a href="turmas/' + row.id + '/edit" style="display: ' + display + ';" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Editar">\
                        <i class="la la-edit"></i>\
                    </a>\
                    <a href="turmas/' + row.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detalhes">\
                        <i class="la la-eye"></i>\
                    </a>\
                    <a href="javascript:;" style="display: ' + display + ';" data-id="' + row.id + '" row-index="' + index + '" class="btn btn-sm btn-clean btn-icon btn-icon-md m_sweetalert_delete" title="Excluir">\
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
            datatableTurmas();
        }
    };
}();

jQuery(document).ready(function() {
    TurmasIndex.init();
});