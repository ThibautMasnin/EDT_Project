window.onload = function () {

    // crud
    let buttons = document.querySelectorAll("button.btnedit");
    console.log(buttons)

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function (event) {

            let click_id = event.target.getAttribute('data-id');
            let str = "td[data-id=\"" + click_id + "\"]";
            let all = document.querySelectorAll(str);

            console.log(click_id, str, all);
            let textbox = document.getElementsByClassName("input-update");

            for (let m = 0; m < textbox.length; m++) {
                textbox[m].value = all[m].innerText;
            }

        });

    }




}

// remove message
setTimeout(function () {
    document.querySelector('.message').remove();
}, 1000);




// left side bar
let tmp_arr = document.querySelectorAll(".indent a");

tmp_arr.forEach(element => {
    element.addEventListener("click", function (event) {
        event.preventDefault();
        let dd = document.querySelectorAll(".indent a.nav-link.active");
        if (dd != null) {
            dd[0].classList.remove('active');
        }
        element.classList.add('active');


        let show = document.querySelector(".tab-pane.not-d-none");

        if (show != null) {
            show.classList.remove('not-d-none');
            show.classList.add('d-none');
        }
        document.getElementById("v-pills-" + element.getAttribute('target')).classList.remove("d-none");
        document.getElementById("v-pills-" + element.getAttribute('target')).classList.add("not-d-none");

    });


});







// //