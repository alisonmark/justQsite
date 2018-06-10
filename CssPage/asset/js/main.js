// Function Validation ò Form
function validate(useName, useName) {
    var useName = document.getElementById('username').value;
    var pWord = document.getElementById('password').value;
    var rePassWord = document.getElementById('re-password').value;

    if (useName == null || useName === "undefined" || useName == "") {
        alert('Please enter Usename');
        // console.log("pWord" + useName);
        return false;
    }

    if (pWord == null || pWord === "undefined" || pWord == "") {
        alert('Please enter password');
        // console.log("pWord" + pWord);
        return false;
    }

    if (rePassWord == null || rePassWord === "undefined" || rePassWord == "") {
        alert('Please enter password once more time');
        console.log("pWord" + rePassWord);
        return false;
    }
    if (rePassWord != pWord) {
        alert('Your password not match');
        // console.log("pWord" + rePassWord);
        // console.log("pWord" + pWord);
        return false;
    }
    alert('Mr Right');
    return true;
}

function AddingToDiv() {
    var inElement = document.getElementsByClassName('in');
    var temp = "";
    console.log(inElement);
    // document.getElementById('Adding').innerHTML += "A muon fuck e roi day";
    Array.prototype.forEach.call(inElement, child => {
        temp += child.value;
        document.getElementById('Adding').innerHTML = temp;
    });
}

function changeMebyButton() {
    var valAttribute = document.getElementById("btn-change-me").type;
    alert(valAttribute);
    if (valAttribute === 'button') {
        document.getElementById("btn-change-me").type = 'text';
    }
    if (valAttribute === 'text') {
        document.getElementById("btn-change-me").type = 'button';
    }
}

function changeColorF() {
    var vl = document.getElementById('kkk');
    vl.style.color = 'red';
    return false;
}

function change_bgrF() {
    var vl = document.getElementById('kkk');
    vl.style.background = 'tomato';
    return false;
}

function change_heightF() {
    // var vl = document.getElementById('btn-height');
    document.getElementById('kkk').style.height = '500px';
    return false;
}

function change_FontF() {
    // var vl = document.getElementById('btn-height');
    document.querySelector('div#kkk').style.fontSize = '150px';
    return false;
}

window.onload = function(e) {
    var btn = document.getElementById('btn');
    // console.log("Exception ??? : " + e);
    // btn.addEventListener('click', validate);
    btn.onclick = validate;

    var chagingDiv = document.getElementsByClassName('in');
    for (var i = 0; i < chagingDiv.length; i++) {
        chagingDiv[i].addEventListener('keyup', AddingToDiv);
    }

    var changeMe = document.getElementById("btn-change-me");
    changeMe.addEventListener('click', changeMebyButton);

    var changeColor = document.getElementById('btn-color');
    changeColor.onclick = changeColorF;

    var change_bgr = document.getElementById('btn-backgr');
    change_bgr.onclick = change_bgrF;

    var change_height = document.getElementById('btn-height');
    change_height.onclick = change_heightF;

    var change_font = document.getElementById('btn-font');
    change_font.onclick = change_FontF;

    // Tao thẻ h1 mới
    var h1NewExlement = document.createElement('h1');
    h1NewExlement.innerHTML = 'Xin chào các bạn';
    document.getElementById('content').appendChild(h1NewExlement);
}