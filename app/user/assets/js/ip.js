$.get("http://ipinfo.io?token=40947f84d963cb", function (response) {
    $("#clientIP").html("Client IP: " + response.ip);
    $("#clientCountry").html("" + response.country);
}, "jsonp");
