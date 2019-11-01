"use strict";

var ProfessorAlunos = function() {

    var datatableAlunos = function() {
        var id = $("#turma_id").val();
        var datatable = $('#professor_alunos_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: 'turmas/' + id + '/alunos',
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
                    noRecords: 'Ainda não há alunos nesta turma.'
                }
            },

            // columns definition
            columns: [{
                field: 'name',
                title: 'Nome',
                textAlign: 'center'
            }, {
                field: 'email',
                title: 'Email',
                textAlign: 'center',
            }, {
                field: 'created_at',
                title: 'Dt. de Cadastro',
                sortable: true,
                width: 110,
                autoHide: false,
                overflow: 'visible',
                textAlign: 'center',
            }],

        });
    };

    return {
        // public functions
        init: function() {
            datatableAlunos();
        }
    };
}();

jQuery(document).ready(function() {
    ProfessorAlunos.init();
});