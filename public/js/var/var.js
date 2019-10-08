var Dinamica = function() {

    var onClickRadio = function() {

        $("input[name='selecaoEnvelope']").click(function() {
            $("#campoNome").removeAttr('disabled');
            $("#setNome").removeAttr('disabled', 'true');

            var id = $("input[name='selecaoEnvelope']:checked").attr("id");

            var nome = $("#nome_" + id).text();
            if (nome) {
                $("#campoValor").removeAttr('disabled');
                $("#setValor").removeAttr('disabled');
            }
            $("#campoNome").val(nome);

            var valor = $("#valor_" + id).text();
            $("#campoValor").val(valor);


        });
    }

    var onClickRadio2 = function() {
        $("input[name='selecaoEnvelope']").click(function() {

            $("#campoNome").removeAttr('disabled');
            $("#setNome").removeAttr('disabled', 'true');
            var id = $("input[name='selecaoEnvelope']:checked").attr("id");
            var nome = $("#nome_" + id).text();
            if (nome) $("#campoValor").removeAttr('disabled');
            if (nome) $("#setValor").removeAttr('disabled');
            var valor = $("#valor_" + id).text();
            $("#campoNome").val(nome);
            $("#campoValor").val(valor);

        });
    }

    var onClickSetNome = function() {
        $("#setNome").click(function() {

            var nome = $("#campoNome").val();
            if (nome && validarNome(nome)) {
                setNome(nome);
                normalizarCampo('campoNome');
            } else {
                destacarCampo('campoNome');
            }
            desabilitarCampos();
        });
    }

    var desabilitarCampos = function() {
        $("#setNome").attr('disabled', 'true');
        $("#campoNome").val('');
        $("#campoNome").attr('disabled', 'true');

        $("#setValor").attr('disabled', 'true');
        $("#campoValor").val('');
        $("#campoValor").attr('disabled', 'true');

        $('input[name="selecaoEnvelope"]').prop('checked', false);
    }

    var setNome = function(nome) {
        var id = $("input[name='selecaoEnvelope']:checked").attr("id");
        $("#nome_" + id).text(nome);
    }

    var onClickSetValor = function() {
        $("#setValor").click(function() {

            var valor = $("#campoValor").val();
            if (valor && validarValor(valor)) {
                setValor(valor);
                normalizarCampo('campoValor');
            } else {
                destacarCampo('campoValor');
            }
            desabilitarCampos();
        });
    }

    var normalizarCampo = function(nomeCampo) {
        $("#" + nomeCampo).removeClass("is-invalid");
    }

    var destacarCampo = function(nomeCampo) {
        $("#" + nomeCampo).addClass("is-invalid");
    }

    var setValor = function(valor) {
        var id = $("input[name='selecaoEnvelope']:checked").attr("id");
        $("#valor_" + id).text(valor);
    }

    var validarValor = function(valor) {
        return !(!$.isNumeric(valor) || valor.length > 4);
    }

    var validarNomeUnico = function(nome) {
        var retorno = true;
        $("#envelopeSelecionado option").each(function() {
            var optionName = $(this).text();
            if (nome === optionName) {
                retorno = false;
            }
        });
        return retorno;
    }

    var validarNome = function(nome) {
        var nomeValido = true;

        // se primeiro caracter é numero
        var primeiroCaractere = "";
        if (nome.length > 1) {
            primeiroCaractere = nome.substring(0, 1);
        } else {
            primeiroCaractere = nome;
        }
        if ($.isNumeric(primeiroCaractere)) {
            // console.log('primeiro caracter deve ser letra');
            nomeValido = false;
        }

        // se tem mais de 30 caracteres
        if (nome.length > 30) {
            nomeValido = false;
        }

        // se tem espaço
        while (nome.indexOf(" ") != -1)
            nome = nome.replace(" ", "#");

        // se tem traço
        while (nome.indexOf("-") != -1)
            nome = nome.replace("-", "#");

        // sem caracteres especiais
        var alphaExp = /^[a-zA-Z-0-9-_]+$/;
        if (!nome.match(alphaExp)) {
            // console.log('contém caracter especial', nome);
            nomeValido = false;
        }

        // nome deve ser unico
        if (!validarNomeUnico(nome)) {
            nomeValido = false;
        };

        return nomeValido;
    }

    var abreFechaEnvelope = function() {
        $(".imagem").click(function() {
            var id = $(this).attr('idNumber');
            if ($(this).attr("src") === "imagens/opened-envelop.png") {
                $("#valor_" + id).hide();
                $(this).attr("src", "imagens/closed-envelop.png");
            } else {
                $(this).attr("src", "imagens/opened-envelop.png")
                $("#valor_" + id).show();
            }
        });
    }

    var escondeValores = function() {
        var textos = $('div.valorEnvelope');
        jQuery.each(textos, function() {
            $(this).hide();
        });
    }

    // =================================================================================

    var setNomeValor = function() {
        $("#set-button").click(function() {
            var id = $("#envelopeSelecionado").val();
            var valor = $("#valorSelecionado").val();
            var nome = $("#nomeSelecionado").val();
            if (nome && validarNome(nome)) {
                $("#nome_" + id).text(nome);
                $("#envelopeSelecionado option:selected").text(nome);
                $("#nomeSelecionado").val('');
            }
            if (valor && validarValor(valor)) {
                $("#valor_" + id).text(valor);
                $("#valorSelecionado").val('');
            }
        });
    }

    return {
        init: function() {

            onClickRadio();
            onClickSetNome();
            onClickSetValor();

            // ======================================

            escondeValores();
            abreFechaEnvelope();
            setNomeValor();
            // reiniciar();

        },
    };

}();

jQuery(document).ready(function() {
    Dinamica.init();
});