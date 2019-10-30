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
                    noRecords: 'Você ainda não tem instituições vinculadas.'
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
                template: function(row) {
                    return '\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Remover">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
                },
            }],

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