document.addEventListener("DOMContentLoaded", function () {
    const customMenu = document.getElementById("custom-menu");
    const customContextElements = document.querySelectorAll(".customContext");

    customContextElements.forEach(function (element) {
        element.addEventListener("contextmenu", function (event) {
            event.preventDefault();
            const triggerId = element.id;
            customMenu.querySelectorAll("a").forEach(function (menuItem) {
                menuItem.href = menuItem.getAttribute("data-base-url");
            });
            customMenu.querySelectorAll("a").forEach(function (menuItem) {
                menuItem.href += triggerId;
            });
            customMenu.style.display = "block";
            customMenu.style.left = event.pageX + "px";
            customMenu.style.top = event.pageY + "px";
            console.log(triggerId);
        });
    });

    document.addEventListener("click", function (event) {
        customMenu.style.display = "none";
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            customMenu.style.display = "none";
        }
    });
    const myButton = document.querySelectorAll("#addToText");
    const myInput = document.getElementById("message");
    const emote_area = document.getElementsByClassName("emote-area");

    myButton.forEach(function (e) {
        e.addEventListener("click", function () {
            const eId = e.value;
            myInput.value += eId;
            if (emote_area.classList.contains("hidden")) {
            } else {
                emote_area.classList.add("hidden");
            }
        });
    });
});
