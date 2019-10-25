var InstituicoesImport = function() {

    var select2 = function() {
        // basic
        $('.kt-select2').select2({

        });
    }

    var setEstados = function() {
        $.ajax({
            url: "https://servicodados.ibge.gov.br/api/v1/localidades/estados",
            success: function(data) {
                jQuery.each(data, function(index, estado) {
                    $('#estado').append(
                        `<option value="${estado.sigla}"> 
                            ${estado.nome} 
                        </option>`);
                });
            }
        });
    }

    var setUniversidades = function() {
        var estado = $('#estado').val();
        $.ajax({
            url: "/minhas-instituicoes/universidades/" + estado,
            success: function(data) {
                jQuery.each(data, function(index, universidade) {
                    $('#instituicoes').append(
                        `<option value="${universidade.codigo}">
                    ${universidade.sigla} - ${universidade.nome} 
                    </option>`);
                });
            }
        });
    }

    var setInstituicoes = function() {
        var tipo = $('#tipo').val();
        var estado = $('#estado').val();
        if (tipo === "1" && estado !== "") {
            console.log("Básico de " + estado);
        } else if (tipo === "2" && estado !== "") {
            setUniversidades();
        }
    }

    var onTipoChange = function() {
        $("#tipo").change(function() {
            setInstituicoes();
        });
    }

    var onEstadoChange = function() {
        $("#estado").change(function() {
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
            setInstituicoes();
        }
    };
}();

jQuery(document).ready(function() {
    InstituicoesImport.init();
});