"use strict";

var ProfessoresIndex = function() {

    var datatableAlunos = function() {

        var turmaId = $("#turmaId").val();

        var datatable = $('#alunos_turma_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: 'turma/' + turmaId + '/alunos',
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
                    noRecords: 'Nenhum aluno foi encontrado.'
                }
            },

            // columns definition
            columns: [{
                field: 'user.name',
                title: 'Nome',
                textAlign: 'center',
            }, {
                field: 'user.email',
                title: 'Email',
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

    var datatableTestes = function() {

        var turmaId = $("#turmaId").val();

        var datatable = $('#testes_turma_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: 'turma/' + turmaId + '/testes',
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
                    noRecords: 'Nenhum teste foi encontrado.'
                }
            },

            // columns definition
            columns: [{
                field: 'nome',
                title: 'Nome',
                textAlign: 'center',
            }, {
                field: 'valor',
                title: 'Valor',
                textAlign: 'center',
            }, {
                field: 'data_inicio',
                title: 'Data de Início',
                type: 'date',
                format: 'MM/DD/YYYY',
                textAlign: 'center',
            }, {
                field: 'data_limite',
                title: 'Data Limite',
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
            datatableAlunos();
            datatableTestes();
        }
    };
}();

jQuery(document).ready(function() {
    ProfessoresIndex.init();
});