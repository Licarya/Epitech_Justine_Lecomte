const cook = document.getElementsByTagName("div")[2];
const text = cook.innerHTML

cook.onclick = function () {
    if (getCookieData("acceptCookies")) {
        cook.innerHTML = text
        document.cookie = "acceptCookies; expires=Thu, 01 Jan 1970 00:00:00 UTC; SameSite=None; Secure";

    } else {
        var newDate = new Date(Date.now() + 24 * 60 * 60 * 1000);
        newDate = Date.parse(newDate)
        document.cookie = "acceptCookies ; expires=" + newDate + ";SameSite=None; Secure";
        cook.innerHTML = "Delete the cookie. <a href='#'>OK</a>"
    }
}
function getCookieData(name) {
    console.log(document.cookie)
    var patrn = new RegExp("^" + name + "=(.*?);"),
        patr2 = new RegExp(" " + name + "=(.*?);");
    if (match = (document.cookie.match(patrn) || document.cookie.match(patr2)))
        return match[1];
    return false;
}

if (getCookieData("acceptCookies")) {
    cook.innerHTML = "Delete the cookie. <a href='#'>OK</a>"
}

console.log(getCookieData("acceptCookies"))