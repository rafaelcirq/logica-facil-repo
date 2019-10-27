var InstituicoesImport = function() {

    var validar = function() {
        var form = $("#import-form");
        form.validate({
            rules: {
                tipo: {
                    required: true
                },
                estado: {
                    required: true
                },
                municipio: {
                    required: true
                },
                'instituicoes[]': {
                    required: true
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
                    limparInstituicoes();
                    setInstituicoes();
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

    var select2 = function() {
        $('.kt-select2').select2({

        });
    }

    var setEstados = function() {
        $.ajax({
            url: "https://servicodados.ibge.gov.br/api/v1/localidades/estados",
            success: function(data) {
                jQuery.each(data, function(index, estado) {
                    $('#estado').append(
                        `<option value="${estado.id}"> 
                            ${estado.nome} 
                        </option>`);
                });
            }
        });
    }

    var setMunicipios = function() {
        var estado = $('#estado').val();
        $.ajax({
            url: "http://servicodados.ibge.gov.br/api/v1/localidades/estados/" + estado + "/municipios",
            success: function(data) {
                $('#municipio').empty();
                $('#municipio').append(
                    `<option value="">Nenhum</option>`);
                jQuery.each(data, function(index, municipio) {
                    $('#municipio').append(
                        `<option value="${municipio.id}"> 
                            ${municipio.nome} 
                        </option>`);
                });
            }
        });
    }

    var limparInstituicoes = function() {
        $('#instituicoes').empty();
    }

    var disableInstituicoesOptions = function(codigo) {
        $.ajax({
            url: "minhas-instituicoes/is-instituicao-associada-ao-usuario/" + codigo,
            success: function(data) {
                if (data.codigo) {
                    var option = $("#instituicoes option[value=" + data.codigo + "]");
                    $(option).attr('disabled', 'disabled');
                }
            }
        });
    }

    var setUniversidades = function() {
        var estado = $('#estado').val();
        var municipio = $('#municipio').val();
        $.ajax({
            url: "/minhas-instituicoes/universidades/" + estado + "/" + municipio,
            success: function(data) {
                limparInstituicoes();
                jQuery.each(data, function(index, universidade) {
                    var separador = "";
                    if (universidade.sigla !== "") {
                        separador = " - ";
                    }
                    $('#instituicoes').append(
                        `<option value="${universidade.codigo}">
                            ${universidade.sigla}${separador}${universidade.nome}
                        </option>`);
                    disableInstituicoesOptions(universidade.codigo);
                });
            }
        });
    }

    var setEscolas = function() {
        var estado = $('#estado').val();
        var municipio = $('#municipio').val();
        $.ajax({
            url: "/minhas-instituicoes/escolas/" + estado + "/" + municipio,
            success: function(data) {
                limparInstituicoes();
                jQuery.each(data, function(index, escola) {
                    $('#instituicoes').append(
                        `<option value="${escola.codigo}">
                            ${escola.nome} 
                        </option>`);
                    disableInstituicoesOptions(escola.codigo);
                });
            }
        });
    }

    var setInstituicoes = function() {
        var tipo = $('#tipo').val();
        var municipio = $('#municipio').val();
        if (tipo === "1" && municipio !== "") {
            setEscolas();
        } else if (tipo === "2" && municipio !== "") {
            setUniversidades();
        }
    }

    var onTipoChange = function() {
        $("#tipo").change(function() {
            limparInstituicoes();
            setInstituicoes();
        });
    }

    var onEstadoChange = function() {
        $("#estado").change(function() {
            limparInstituicoes();
            setMunicipios();
        });
    }

    var onMunicipioChange = function() {
        $("#municipio").change(function() {
            limparInstituicoes();
            setInstituicoes();
        });
    }

    // Public functions
    return {
        init: function() {
            select2();
            setEstados();
            onTipoChange();
            onEstadoChange();
            onMunicipioChange();
            validar();
        }
    };
}();

jQuery(document).ready(function() {
    InstituicoesImport.init();
});