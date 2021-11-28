console.log('Archivo: App.js')
const btnBar: any = document.getElementById("btn-navbar"),
    btnMas: any = document.getElementById("btn-mas"),
    listBoxLink: any = document.querySelectorAll(".link-action");

const toggleStyleAppSection = (widthElement1: number, widthElement2: number) => {
    const appSection: any = document.querySelector("#app-section");
    appSection.children[0].style.width = `${widthElement1}px`;
    appSection.children[0].style.minWidth = `${widthElement1}px`;
    appSection.children[1].style.width = `${widthElement2}%`;
}

function windowResize() {
    if (window.innerWidth < 361) {
        toggleStyleAppSection(0, 100);
        stateBar(btnBar, false);
    } else {
        toggleStyleAppSection(250, 100);
        stateBar(btnBar, true);
    }
}

window.addEventListener('resize', windowResize);
document.addEventListener("DOMContentLoaded", () => {
    windowResize();
    closeNavbarModalOption();
});


const stateBar = (element: any, state: boolean) => {
    element.setAttribute("data-state", state);
}

/****NavBar - Menu****/
btnBar.addEventListener('click', handleToggleNavbar);

function handleToggleNavbar() {
    if (btnBar.getAttribute("data-state") == "false") {
        stateBar(btnBar, true);
        toggleStyleAppSection(250, 100);
    } else {
        stateBar(btnBar, false);
        toggleStyleAppSection(0, 100);
    }
    closeNavbarModalOption();
}

/**** BOX MENU - GROUP LINKS ****/
listBoxLink.forEach((btnLink: any) => {
    stateBar(btnLink.parentElement, false);
    toggleStyleOptionLink(btnLink.parentElement.children[1], 0);
    btnLink.addEventListener('click', () => handleToggleOptionLink(btnLink));
});

function handleToggleOptionLink(btnLink: any) {
    let listGroupLink: any = btnLink.parentElement,
        optLink: any = listGroupLink.children[1],
        linkItem: any = optLink.children;
    let totalHeightElement: number = linkItem[0].clientHeight * linkItem.length,
        borderUpDown: number = linkItem.length * 2;
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

function toggleStyleOptionLink(element: any, height: number) {
    if (element) {
        element.style.height = `${height}px`;
    }
}

/****NavBar - Mas****/
btnMas.addEventListener('click', () => handleToggleNavbarModalOption(btnMas));

function handleToggleNavbarModalOption(btn: any) {
    if (btn.getAttribute("data-state") == "false") {
        stateBar(btn, true);
        toggleStyleNavbarModalOption(btn.parentElement.children[1], { height: 'auto', padding: '10px' });
    } else {
        stateBar(btn, false);
        toggleStyleNavbarModalOption(btn.parentElement.children[1], { height: '0px', padding: '0px' });
    }
}

function toggleStyleNavbarModalOption(element:any, style: {height: string, padding: string}) {
    element.parentElement.children[1].style.height = style.height;
    element.parentElement.children[1].style.padding = style.padding;
}

function closeNavbarModalOption() {
    [btnMas].forEach(el => {
        stateBar(el, false);
        toggleStyleNavbarModalOption(el, { height: '0px', padding: '0px' });
    });
}

