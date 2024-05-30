let error = document.querySelector("div#error");

function showError(msg){
    error.innerHTML = "Ошибка: "+msg;
    error.classList.remove("hidden");
}
function hideError(){
    error.classList.add("hidden");
}

let button = document.getElementsByClassName("nextstep")[0];

// пока что только 2 шага
let fields1 = document.querySelectorAll(".f1");
let fields2 = document.querySelectorAll(".f2");

function nextStep(){
    let inputs = document.querySelectorAll(".f1 > :not(input[type='submit'], h3, a, label, button)");
    let checkboxes = document.querySelectorAll(".f1 > input[type='checkbox']");
    let signedInputs = 0;
    let unsignedInputs = [];
    let signedChecks = 0;
    let unsignedChecks = [];
    inputs.forEach((element) => {
        if (element.value != '') signedInputs++;
        else unsignedInputs.push(element);
    });
    checkboxes.forEach((element) => {
        if (element.checked != 0) signedChecks++;
        else unsignedChecks.push(element);
    });
    if(inputs.length === signedInputs && checkboxes.length === signedChecks){
        hideError();
        fields1.forEach((fields) => {
            fields.classList.add("hidden");
        })
        fields2.forEach((fields) => {
            fields.classList.remove("hidden");
        })
    }
    else{
        if (unsignedInputs.length !== 0){
            showError("Не все поля заполнены.");
            unsignedInputs.forEach(input => {
                input.classList.add("errored");
            })
        }
        else{
            showError("Вы не согласились с правилами.");
            unsignedChecks.forEach(check => {
                check.classList.add("errored");
            })
        }
    }
}

if (fields1 && fields2){
    fields2.forEach((fields) => {
        fields.classList.add("hidden");
    })
}
if(button) button.addEventListener('click', nextStep);

document.addEventListener("DOMContentLoaded", function () {
    let eventCallback = function (e) {
        let el = e.target,
        clearVal = el.dataset.phoneClear,
        pattern = el.dataset.phonePattern,
        matrix_def = "+7(___) ___-__-__",
        matrix = pattern ? pattern : matrix_def,
        i = 0,
        def = matrix.replace(/\D/g, ""),
        val = e.target.value.replace(/\D/g, "");
        if (clearVal !== 'false' && e.type === 'blur') {
            if (val.length < matrix.match(/([\_\d])/g).length) {
                e.target.value = '';
                return;
            }
        }
        if (def.length >= val.length) val = def;
        e.target.value = matrix.replace(/./g, function (a) {
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
        });
    }
    let phone_inputs = document.querySelectorAll('[data-phone-pattern]');
    if(phone_inputs){
        for (let elem of phone_inputs) {
            for (let ev of ['input', 'blur', 'focus']) {
                elem.addEventListener(ev, eventCallback);
            }
        }
    }

    let passwordR = document.querySelector("#passwordR");
    if(passwordR){
        for (let ev of ['input', 'blur', 'focus']) {
            passwordR.addEventListener(ev, (e) => {
                let el = e.target;
        
                if(el.value !== document.querySelector('#password').value) showError("Пароли не совпадают.");
                else hideError();
            });
        }
    }
});