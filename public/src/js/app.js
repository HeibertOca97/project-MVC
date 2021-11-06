"use strict";
console.log("Alerta: Archivo App.js en ejecucion");

const btnBar = document.getElementById("btn-navbar"),
    btnMas = document.getElementById("btn-mas"),
    listBoxLink = document.querySelectorAll(".link-action");

const toggleStyleAppSection = (widthElement1, widthElement2) => {
    const appSection = document.querySelector("#app-section");
    appSection.style.gridTemplateColumns = `${widthElement1} ${widthElement2}`;
}

function windowResize() {
    if (window.innerWidth < 361) {
        toggleStyleAppSection('0px', '1fr');
        stateBar(btnBar, false);
    } else {
        toggleStyleAppSection('250px', '1fr');
        stateBar(btnBar, true);
    }
}

window.addEventListener('resize', windowResize);
document.addEventListener("DOMContentLoaded", () => {
    windowResize();
    closeNavbarModalOption();
});


const stateBar = (element, state) => {
    element.setAttribute("data-state", state);
}

/****NavBar - Menu****/
btnBar.addEventListener('click', handleToggleNavbar);

function handleToggleNavbar() {
    if (btnBar.getAttribute("data-state") == "false") {
        stateBar(btnBar, true);
        toggleStyleAppSection('250px', '1fr');
    } else {
        stateBar(btnBar, false);
        toggleStyleAppSection('0px', '1fr');
    }
    closeNavbarModalOption();
}

/**** BOX MENU - GROUP LINKS ****/
listBoxLink.forEach((btnLink, key) => {
    stateBar(btnLink.parentElement, false);
    toggleStyleOptionLink(btnLink.parentElement.children[1], 0);
    btnLink.addEventListener('click', () => handleToggleOptionLink(btnLink));
});

function handleToggleOptionLink(btnLink) {
    let listGroupLink = btnLink.parentElement,
        optLink = listGroupLink.children[1],
        linkItem = optLink.children;
    let totalHeightElement = linkItem[0].clientHeight * linkItem.length,
        borderUpDown = linkItem.length * 2;
    totalHeightElement = totalHeightElement + borderUpDown;

    if (listGroupLink.getAttribute("data-state") == "false") {
        stateBar(listGroupLink, true);
        toggleStyleOptionLink(optLink, totalHeightElement);
    } else {
        stateBar(listGroupLink, false);
        toggleStyleOptionLink(optLink, 0);
    }
    closeNavbarModalOption();
}

function toggleStyleOptionLink(element, height) {
    if (element) {
        element.style.height = `${height}px`;
    }
}

/****NavBar - Mas****/
btnMas.addEventListener('click', () => handleToggleNavbarModalOption(btnMas));

function handleToggleNavbarModalOption(btn) {
    if (btn.getAttribute("data-state") == "false") {
        stateBar(btn, true);
        toggleStyleNavbarModalOption(btn.parentElement.children[1], { height: 'auto', padding: '10px' });
    } else {
        stateBar(btn, false);
        toggleStyleNavbarModalOption(btn.parentElement.children[1], { height: '0px', padding: '0px' });
    }
}

function toggleStyleNavbarModalOption(element, style) {
    element.parentElement.children[1].style.height = style.height;
    element.parentElement.children[1].style.padding = style.padding;
}

function closeNavbarModalOption() {
    [btnMas].forEach(el => {
        stateBar(el, false);
        toggleStyleNavbarModalOption(el, { height: '0px', padding: '0px' });
    });
}