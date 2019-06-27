$.getJSON('/include/listagem-de-cursos.php', function(retorno) {
    var i = 0;
    while(retorno[i] && i <= 7) {
        function lightDoHSL(hex) {
            var hexadecimal = /^#?([A-f\d]{2})([A-f\d]{2})([A-f\d]{2})$/i.exec(hex);
            var r = parseInt(hexadecimal[1], 16) / 255;
            var g = parseInt(hexadecimal[2], 16) / 255;
            var b = parseInt(hexadecimal[3], 16) / 255;
            var light = ((Math.max(r,g,b) + Math.min(r,g,b)) / 2) * 100;
            return light;
        }
        var light = lightDoHSL(retorno[i].cor);
        $('#cursosEmDestaque').append('<div class="col-sm-6 col-md-4 col-lg-3 mb-2"><div class="card py-4 mb-2 text-white text-center" style="background-color: ' + retorno[i].cor + ';"><a href="/curso/"><img src="' + retorno[i].imagemURL + '" class="mb-3" height="40px"><h4 class="mb-0" style="color: hsl(0,0%,calc((' + light + ' - 70) * (-100%)));">' + retorno[i].titulo + '</h4></a></div></div>');
        i++;
    }
});