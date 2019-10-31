"use strict";

var InstituicoesIndex = function() {

    var datatableInstituicoes = function() {

        var datatable = $('#instituicoes_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: 'minhas-instituicoes',
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
                    noRecords: 'Você ainda não tem instituições vinculadas.'
                }
            },

            // columns definition
            columns: [{
                field: 'sigla',
                title: 'Sigla',
                textAlign: 'center'
            }, {
                field: 'nome',
                title: 'Nome',
                textAlign: 'center',
            }, {
                field: 'cidade',
                title: 'Cidade',
                textAlign: 'center',
            }, {
                field: 'Actions',
                title: 'Ações',
                sortable: false,
                width: 110,
                autoHide: false,
                overflow: 'visible',
                textAlign: 'center',
                template: function(row, index, datatable) {
                    return '\
                    <a href="javascript:;" data-id="' + row.id + '" row-index="' + index + '" class="btn btn-sm btn-clean btn-icon btn-icon-md m_sweetalert_delete" title="Remover">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
                },
            }],

        });

        $(document).on('click', '.m_sweetalert_delete', function() {
            // e.preventDefault();
            var id = $(this).attr("data-id");
            var index = $(this).attr("row-index");
            deleteData(id, index, datatable);
        });
    };

    var deleteData = function(id, index, datatable) {

        swal.fire({
            "title": "Deseja realmente excluir?",
            "text": "Após excluído, você não poderá reverter isso!",
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

                // Ajax post data to server.
                $.post(formAction, formData, function(response) {

                    // console.log(response);
                    KTApp.unblockPage();

                    if (response.success) {

                        // Removing the row
                        // console.log(datatable.row('[data-row="' + index + '"]'));
                        datatable.row('[data-row="' + index + '"]').remove();
                        // $('.m_datatable').mDatatable('reload');

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
            datatableInstituicoes();
        }
    };
}();

jQuery(document).ready(function() {
    InstituicoesIndex.init();
});