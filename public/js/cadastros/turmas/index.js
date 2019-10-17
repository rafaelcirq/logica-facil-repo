"use strict";
// Class definition

var TurmasIndex = function() {
    // Private functions

    // basic datatable
    var datatable = function() {

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
                    noRecords: 'Nenhuma turma foi encontrada.'
                }
            },

            // columns definition
            columns: [{
                field: 'nome',
                title: 'Turma',
                textAlign: 'center',
            }, {
                field: 'instituicao.nome',
                title: 'Instituição',
                textAlign: 'center',
            }, {
                field: 'created_at',
                title: 'Data de Criação',
                type: 'date',
                format: 'MM/DD/YYYY',
                textAlign: 'center',
            }, {
                field: 'Actions',
                title: 'Ações',
                sortable: false,
                width: 110,
                autoHide: false,
                overflow: 'visible',
                textAlign: 'center',
                template: function(row) {
                    return '\
                    <a href="turmas/' + row.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ver">\
                        <i class="la la-eye"></i>\
                    </a>\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Excluir">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
                },
            }],

        });

        $('#filtro_instituicao').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'instituicao.nome');
        });

        $('#filtro_instituicao').select2();

    };

    return {
        // public functions
        init: function() {
            datatable();
        }
    };
}();

jQuery(document).ready(function() {
    TurmasIndex.init();
});