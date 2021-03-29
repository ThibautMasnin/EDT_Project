window.onload = function () {

    // crud
    let buttons = document.querySelectorAll("button.btnedit");
    // console.log(buttons)

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function (event) {

            let click_id = event.target.getAttribute('data-id');
            let str = "td[data-id=\"" + click_id + "\"]";
            let all = document.querySelectorAll(str);

            //  console.log(click_id, str, all);
            let textbox = document.getElementsByClassName("input-update");

            for (let m = 0; m < textbox.length; m++) {
                textbox[m].value = all[m].getAttribute('db');
            }

        });

    }




}

// remove message
setTimeout(function () {
    document.querySelector('.message').remove();
}, 1000);




// left side bar -management / planning

let tmp_arr = document.querySelectorAll(".indent a");

tmp_arr.forEach(element => {
    element.addEventListener("click", function (event) {
        event.preventDefault();
        let form = document.getElementById('getFormBuilder');
        if (form) {
            let table_name = form.lastElementChild;
            table_name.value = element.getAttribute('target');
            form.submit();
        } else {
            // planning
            form = element.nextElementSibling;
            form.submit();

        }

    });

});



// top nav 
let management = document.getElementById("management-spec");
management.addEventListener("click", function (event) {
    event.preventDefault();
    let form = management.nextElementSibling;
    //  console.log(form);
    form.submit();
});

let consultation = document.getElementById("consultation-spec");
consultation.addEventListener("click", function (event) {
    event.preventDefault();
    let form = consultation.nextElementSibling;
    //  console.log(form);
    form.submit();
});






// //