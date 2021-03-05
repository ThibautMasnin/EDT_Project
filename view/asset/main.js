var buttons = document.getElementsByClassName("btnedit");

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", (e) => {
        let click_id = e.target.getAttribute('data-id');
        let str = "td[data-id=\"" + click_id + "\"]";
        let all = document.querySelectorAll(str);


        let textbox = document.getElementsByClassName("input-update");
        for (let m = 0; m < textbox.length; m++) {
            textbox[m].value = all[m].innerText;
        }

    });

}

// remove message
setTimeout(function () {
    document.querySelector('.message').remove();
}, 1000);
