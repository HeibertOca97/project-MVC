/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/


console.log('Archivo: App.js');
var btnBar = document.getElementById("btn-navbar"),
  btnMas = document.getElementById("btn-mas"),
  listBoxLink = document.querySelectorAll(".link-action");
var toggleStyleAppSection = function toggleStyleAppSection(widthElement1, widthElement2) {
  var appSection = document.querySelector("#app-section");
  appSection.style.gridTemplateColumns = "".concat(widthElement1, " ").concat(widthElement2);
};
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
document.addEventListener("DOMContentLoaded", function () {
  windowResize();
  closeNavbarModalOption();
});
var stateBar = function stateBar(element, state) {
  element.setAttribute("data-state", state);
};

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
listBoxLink.forEach(function (btnLink, key) {
  stateBar(btnLink.parentElement, false);
  toggleStyleOptionLink(btnLink.parentElement.children[1], 0);
  btnLink.addEventListener('click', function () {
    return handleToggleOptionLink(btnLink);
  });
});
function handleToggleOptionLink(btnLink) {
  var listGroupLink = btnLink.parentElement,
    optLink = listGroupLink.children[1],
    linkItem = optLink.children;
  var totalHeightElement = linkItem[0].clientHeight * linkItem.length,
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
    element.style.height = "".concat(height, "px");
  }
}

/****NavBar - Mas****/
btnMas.addEventListener('click', function () {
  return handleToggleNavbarModalOption(btnMas);
});
function handleToggleNavbarModalOption(btn) {
  if (btn.getAttribute("data-state") == "false") {
    stateBar(btn, true);
    toggleStyleNavbarModalOption(btn.parentElement.children[1], {
      height: 'auto',
      padding: '10px'
    });
  } else {
    stateBar(btn, false);
    toggleStyleNavbarModalOption(btn.parentElement.children[1], {
      height: '0px',
      padding: '0px'
    });
  }
}
function toggleStyleNavbarModalOption(element, style) {
  element.parentElement.children[1].style.height = style.height;
  element.parentElement.children[1].style.padding = style.padding;
}
function closeNavbarModalOption() {
  [btnMas].forEach(function (el) {
    stateBar(el, false);
    toggleStyleNavbarModalOption(el, {
      height: '0px',
      padding: '0px'
    });
  });
}

//Cargar datos de API de prueba
fetch('https://jsonplaceholder.typicode.com/users').then(function (response) {
  return response.json();
}).then(function (json) {
  var card = document.getElementById("card-db");
  var el = "<ul>";
  for (var i = 0; i < json.length; i++) {
    el += "<li>".concat(json[i].name, " | ").concat(json[i].email, "</li>");
  }
  el += "</ul>";
  card.innerHTML = el;
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin

})();

/******/ })()
;
//# sourceMappingURL=app.bundle.js.map