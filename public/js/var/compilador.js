// Class definition

var Compilador = function() {

    var getValorDoEnvelope = function(nomeEnvelope) {
        return 10;
    }

    var fazerOperacaoMatematica = function(n1, n2, operador) {
        equacao = n1 + operador + n2;
        return eval(equacao);
    }

    var exibirResultado = function(resultado) {
        $("#resultado").text(resultado);
    }

    var alterarEnvelope = function(envelope, resultado) {
        console.log(envelope + " recebe: " + resultado);
        exibirResultado("Envelope alterado com sucesso!");
    }

    var erroDeCompilacao = function() {
        exibirResultado("Erro ao compilar!");
    }

    var compilar = function() {
        $("#compilar").click(function() {

            var comando = $("#comando").val();
            var comandos = comando.split(" ");

            var resultado;
            var envelopeAlterado;

            jQuery.each(comandos, function(index, operador) {
                var n1 = comandos[index - 1];
                var n2 = comandos[index + 1];
                switch (operador) {
                    case "+":
                    case "-":
                    case "*":
                    case "/":
                        if (isNaN(n1)) n1 = getValorDoEnvelope(n1);
                        if (isNaN(n2)) n2 = getValorDoEnvelope(n2);
                        resultado = fazerOperacaoMatematica(n1, n2, operador);
                        break;
                    case "=":
                        envelopeAlterado = n1;
                        if (comandos.length === 3) {
                            if (isNaN(n2)) n2 = getValorDoEnvelope(n2);
                            resultado = n2;
                        }
                        break;
                }
            });

            if (envelopeAlterado && resultado) {
                alterarEnvelope(envelopeAlterado, resultado);
            } else if (resultado) {
                exibirResultado(resultado);
            } else {
                erroDeCompilacao();
            }

        });
    }

    return {
        // public functions
        init: function() {
            compilar();
        }
    };
}();

jQuery(document).ready(function() {
    Compilador.init();
});