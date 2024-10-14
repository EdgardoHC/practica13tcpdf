//https://gist.github.com/gmelendezcr/3609421
//Validar DUI
var isDUI = function (str) {
    var regex = /(^\d{8})-(\d$)/,
            parts = str.match(regex);
    // verficar formato y extraer digitos junto al digito verificador
    if (parts !== null) {
        var digits = parts[1],
                dig_ve = parseInt(parts[2], 10),
                sum = 0;
        // sumar producto de posiciones y digitos
        for (var i = 0, l = digits.length; i < l; i++) {
            var d = parseInt(digits[i], 10);
            sum += (9 - i) * d;
        }
        return dig_ve === (10 - (sum % 10)) % 10;
    } else {
        return false;
    }
};


//Fortaleza de contraseña:
$('#contrasenaTest').keyup(function (e) {
    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var enoughRegex = new RegExp("(?=.{6,}).*", "g");
    if (false == enoughRegex.test($(this).val())) {
        $('#passstrength').removeClass('alert alert-success').removeClass('alert alert-danger').removeClass('alert alert-warning');
        $('#passstrength').html('');
    } else if (strongRegex.test($(this).val())) {
        $('#passstrength').addClass('alert alert-success').removeClass('alert alert-warning').removeClass('alert alert-danger');
        $('#passstrength').html('Seguridad de contraseña: Fuerte');

    } else if (mediumRegex.test($(this).val())) {
        $('#passstrength').addClass('alert alert-warning').removeClass('alert alert-danger').removeClass('alert alert-success');
        $('#passstrength').html('Seguridad de contraseña: Media');
    } else {
        $('#passstrength').addClass('alert alert-danger').removeClass('alert alert-success').removeClass('alert alert-warning');
        $('#passstrength').html('Seguridad de contraseña: Débil');
    }
    return true;
});


function fechaDeHoyyymmdd() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    return  today = yyyy + '-' + mm + '-' + dd;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function  checkCookie(name) {
    if (getCookie(name) != "") {
        return true;
    } else {
        return false;
    }
}