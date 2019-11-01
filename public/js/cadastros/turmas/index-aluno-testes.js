"use strict";

var AlunoTestes = function() {

    var datatableTestes = function() {
        var id = $("#turma_id").val();
        var datatable = $('#aluno_testes_datatable').KTDatatable({
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
                title: '',
                sortable: false,
                width: 120,
                autoHide: false,
                overflow: 'visible',
                textAlign: 'center',
                template: function(row, index, professor) {
                    var displayBotaoResponder = ($("#teste_" + row.id).val() === undefined) ? "unset" : "none";
                    var displayBotaoRespondido = ($("#teste_" + row.id).val() === undefined) ? "none" : "unset";
                    console.log(($("#teste_" + row.id).val() === undefined, "teste_" + row.id));
                    return '\
                    <a disabled style="display: ' + displayBotaoRespondido + ';" class="btn btn-bold btn-label-brand btn-sm" title="Respondido">\
                        <i class="la la-reply"></i>\
                        Responder\
                    </a>\
                    <a href="testes/' + row.id + '/responder" style="display: ' + displayBotaoResponder + ';" class="btn btn-bold btn-label-brand btn-sm" title="Responder">\
                        <i class="la la-reply"></i>\
                        Responder\
                    </a>\
                ';
                },
            }],

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
    AlunoTestes.init();
});