function OnActionClick() {
    document.getElementById('preloader').style.display="block";
    var xhr = new XMLHttpRequest(),
        method = "GET",
        url = "http://support.salesmanago.com/external/jira/emred/public/index/Refresh";

    xhr.open(method, url, true);
    xhr.onreadystatechange = function () {
        if(xhr.readyState === 4 && xhr.status === 200) {
            location.reload();
        } else {

        }
    };
    xhr.send();
}