
function myAccount() {
    var acc = document.getElementById("account");
    var pen = document.getElementById("pending");
    var his = document.getElementById("history");
    var noti = document.getElementById("notification");
    if (acc.style.display === "none") {
        acc.style.display = "block";
        pen.style.display = "none";
        his.style.display = "none";
        noti.style.display = "none";
    }else if(pen.style.display === "block" || his.style.display === "block" || noti.style.display === "block"){
        acc.style.display = "block";
        pen.style.display = "none";
        his.style.display = "none";
        noti.style.display = "none";
    }else{
        acc.style.display = "block";
        pen.style.display = "none";
        his.style.display = "none";
        noti.style.display = "none";
    }

}
function myOrder() {
    var acc = document.getElementById("account");
    var pen = document.getElementById("pending");
    var his = document.getElementById("history");
    var noti = document.getElementById("notification");
    if (pen.style.display === "none") {
        acc.style.display = "none";
        pen.style.display = "block";
        his.style.display = "none";
        noti.style.display = "none";
    }else if(acc.style.display === "block" || his.style.display === "block" || noti.style.display === "block"){
        acc.style.display = "none";
        pen.style.display = "block";
        his.style.display = "none";
        noti.style.display = "none";
    }else{
        acc.style.display = "none";
        pen.style.display = "block";
        his.style.display = "none";
        noti.style.display = "none";
    }
}
function myHistory() {
    var acc = document.getElementById("account");
    var pen = document.getElementById("pending");
    var his = document.getElementById("history");
    var noti = document.getElementById("notification");
    if (his.style.display === "none") {
        acc.style.display = "none";
        pen.style.display = "none";
        his.style.display = "block";
        noti.style.display = "none";
    }else if(acc.style.display === "block" || pen.style.display === "block" || noti.style.display === "block"){
        acc.style.display = "none";
        pen.style.display = "none";
        his.style.display = "block";
        noti.style.display = "none";
    }else{
        acc.style.display = "none";
        pen.style.display = "none";
        his.style.display = "block";
        noti.style.display = "none";
    }
}
function myNotification() {
    var acc = document.getElementById("account");
    var pen = document.getElementById("pending");
    var his = document.getElementById("history");
    var noti = document.getElementById("notification");
    if (noti.style.display === "none") {
        acc.style.display = "none";
        pen.style.display = "none";
        his.style.display = "none";
        noti.style.display = "block";
    }else if(acc.style.display === "block" || pen.style.display === "block" || his.style.display === "block"){
        acc.style.display = "none";
        pen.style.display = "none";
        his.style.display = "none";
        noti.style.display = "block";
    }else{
        acc.style.display = "none";
        pen.style.display = "none";
        his.style.display = "none";
        noti.style.display = "block";
    }
}