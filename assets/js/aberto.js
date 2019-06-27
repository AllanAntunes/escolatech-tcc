var primeiraInteracaoChat = true;

$("#botaoToggleChat").click(function() {
    $("#chat").toggle();
    if(primeiraInteracaoChat == true) {
        $.getJSON("/include/ibm-watson-assistant.php?mensagem=", function(retorno) {
            var i = 0;
            while(retorno.output.generic[i].text) {
                $("#areaChat").append('<div class="mensagemLadoNosso">' + retorno.output.generic[i].text + '</div>');
                i++;
            }
        });
        primeiraInteracaoChat == false;
    }
});

$("#formEscreverMensagem").submit(function() {
    if($("#inputEscreverMensagem").val() != "") {
        $("#areaChat").append('<div class="mensagemLadoUsuario">' + $("#inputEscreverMensagem").val() + '</div>');
        $("#inputEscreverMensagem").val("");
        $("#areaChat").animate({scrollTop: 200000000}, "slow");
        $.getJSON("/include/ibm-watson-assistant.php?mensagem=" + $("#inputEscreverMensagem").val(), function(retorno) {
            var i = 0;
            while(retorno.output.generic[i].text) {
                $("#areaChat").append('<div class="mensagemLadoNosso">' + retorno.output.generic[i].text + '</div>');
                $("#areaChat").animate({scrollTop: 9999}, "slow");
                i++;
            }
            alert(JSON.stringify(retorno));
        });
    }
    return false;
});