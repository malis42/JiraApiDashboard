function OnActionClick() {
    document.getElementById('preloader').style.display="block";
    var xhr = new XMLHttpRequest(),
        method = "GET",
        url = "http://apijira.localdev/refresh";

    xhr.open(method, url, true);
    xhr.onreadystatechange = function () {
        if(xhr.readyState === 4 && xhr.status === 200) {
            location.reload();
           // console.log('hwdp');
        } else {

        }
    };
    xhr.send();
}