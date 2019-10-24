// Class definition

var Compilador = function() {

    // util

    var temCaracter = function(str, car) {
        return (str.indexOf(car) !== -1);
    }

    var exibirMensagem = function(conteudo) {
        $("#resultado").text(conteudo);
    }

    // comando escreva

    var getPalavrasSeparadas = function(comando) {
        return comando.split(/\(|\)|"|'| /);
    }

    var getEscrevaDividido = function(comando) {
        return comando.split(/\(|\)|escreva| /);
    }

    var getConteudoEscreva = function(conteudo) {
        return conteudo[2];
    }

    var comandoEscrevaEValido = function(comando) {
        if (!comando[3]) {
            return true;
        } else {
            return false;
        }
    }

    var isEquacao = function(conteudo) {
        return (temCaracter(conteudo, "+") ||
            temCaracter(conteudo, "-") ||
            temCaracter(conteudo, "*") ||
            temCaracter(conteudo, "/"));
    }

    var getElementos = function(conteudo) {
        return conteudo.split(/\+|\-|\*|\/| /);
    }

    var getValorEnvelope = function(nomeEnvelope) {
        var div = $("div").find("[nome_envelope='" + nomeEnvelope + "']");
        return div.text();
    }

    var converterElementos = function(elementos, conteudo) {
        jQuery.each(elementos, function(index, elemento) {
            if (isNaN(elemento) && envelopeExiste(elemento)) {
                valorElemento = getValorEnvelope(elemento);
                if (valorElemento) {
                    elementos[index] = valorElemento;
                }
            }
        });
        return elementos;
    }

    var gerarEquacao = function(conteudo, letras, numeros) {
        jQuery.each(letras, function(index, letra) {
            conteudo = conteudo.replace(letra, numeros[index]);
        });
        return conteudo;
    }

    var calcular = function(conteudo) {
        conteudo = conteudo.replace(/\s/g, '');
        if (isEquacao(conteudo)) {
            var elementos = getElementos(conteudo);
            elementos = converterElementos(elementos, conteudo).filter(Boolean);
            var equacao = gerarEquacao(conteudo, getElementos(conteudo), elementos);
            return eval(equacao);
        } else {
            if (isNaN(conteudo)) {
                valorConteudo = getValorEnvelope(conteudo);
                if (valorConteudo) return valorConteudo;
            } else {
                return conteudo;
            }
        }
        return "Não foi possível compilar!";
    }

    var escrever = function(comando) {
        var escreva = getEscrevaDividido(comando);
        if (comandoEscrevaEValido(escreva)) {
            var conteudo = getConteudoEscreva(escreva);
            return calcular(conteudo);
        } else {
            exibirMensagem("Não foi possível compilar!");
        }
    }

    // atribuição

    var atribuir = function(comando) {
        var comando = comando.split("=");
        comando[0] = comando[0].replace(" ", "")
        var envelope = comando[0];
        comando[1] = comando[1].replace(" ", "")
        var conteudo = comando[1];

        if (envelopeExiste(envelope)) {
            conteudo = calcular(conteudo);
            setValorByCompilador(envelope, conteudo);
            return "Compilação concluída!";
        }

        return "Não foi possível compilar!";
    }

    // compilador

    var compilar = function(comando) {
        var palavras = getPalavrasSeparadas(comando);
        var conteudo = "Não foi possível compilar!";
        if (palavras[0] === "escreva") {
            conteudo = escrever(comando);
        } else if (palavras[1] === "=") {
            conteudo = atribuir(comando);
        }
        exibirMensagem(conteudo);
    }

    var onClickCompilar = function() {
        $("#compilar").click(function() {
            var comando = $("#comando").val();
            compilar(comando);
        });
    }

    return {
        // public functions
        init: function() {
            onClickCompilar();
        }
    };
}();

jQuery(document).ready(function() {
    Compilador.init();
});