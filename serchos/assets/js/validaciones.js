$('.LetrasNumeros').on('input', function (e) {
    if (!/^[ a-z0-9áéíóúüñ]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig,"");
    }
});

$(".Domicilio").on("input", function (e) {
    if (!/^[ a-z0-9áéíóúüñ#_-.,]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig,"");
    }
});

$('.Letras').on('input', function (e) {
    //console.log("entro num");
    if (!/^[ a-záéíóúüñ]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-záéíóúüñ]+/ig,"");
    }
}); 

$('.Numeros').on('input', function (e) {
    //console.log("entro letra");
    if (!/^[0-9]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^0-9]+/ig,"");
    }
});

$('.NumerosDecimales').on('input', function (e) {
    //console.log("xd");
    var punto = this.value.indexOf(".");

    if(punto != -1){
        var ant = this.value.substring(0,punto);
        var des = this.value.substring(punto+1,punto+3);

        if (!/^[0-9]*$/i.test(des)) {
            des = des.replace(/[^0-9]+/ig,"");
        }

        if (!/^[0-9]*$/i.test(ant)) {
            ant = ant.replace(/[^0-9]+/ig,"");
        }

        this.value = ant + "." + des;
    }else{
        if (!/^[.0-9]*$/i.test(this.value)) {
            this.value = this.value.replace(/[^.0-9]+/ig,"");
        }               
    }
});

$('.LetrasSinEspacio').on('input', function (e) {
    if (!/^[a-záéíóúüñ]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^a-záéíóúüñ]+/ig,"");
    }
});