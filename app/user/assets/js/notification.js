function notificationCount() {
    document.getElementById("notificationCount").innerHTML = "0";
}

function notificationHandler() {
    var date = new Date();
    document.getElementById("notificationLoginTimeHandler").innerHTML="at "+date.getHours()+":"+date.getMinutes()+":00";
    document.getElementById("notificationLoginDateHandler").innerHTML="Logged in on "+date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
}
