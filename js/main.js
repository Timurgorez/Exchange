
if(document.getElementById('use_pass')){
    if(document.getElementById('use_pass').checked){
        document.getElementById('pass').disabled = false;
    }else{
        document.getElementById('pass').disabled = true
    }
    document.getElementById('use_pass').onchange = function (e) {
        if(this.checked){
            document.getElementById('pass').disabled = false;
        }else{
            document.getElementById('pass').disabled = true
            document.getElementById('pass').value = '';
        }
    }
}

function setClipboard() {
    var copyText = document.getElementById("url_with_file").innerHTML;
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = copyText;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
}

function checkCountDownload(file_n) {
    console.log(file_n);
    var xhr = new XMLHttpRequest();
    var file = 'file_n=' + file_n;
    xhr.open('POST', location.origin + '/main/checkOnceDownload', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.status === 200 && xhr.readyState === 4) {
            console.log(xhr.response);
        } else {
            console.log(xhr.status);
        }
    }
    xhr.send(file);
}

$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
});