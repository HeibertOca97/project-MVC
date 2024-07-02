/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://mvc1/./resources/sass/app.scss?");

/***/ }),

/***/ "./resources/js/app.ts":
/*!*****************************!*\
  !*** ./resources/js/app.ts ***!
  \*****************************/
/***/ (() => {

eval("\nconsole.log('Archivo: App.js');\nconst btnBar = document.getElementById(\"btn-navbar\"), btnMas = document.getElementById(\"btn-mas\"), listBoxLink = document.querySelectorAll(\".link-action\");\nconst toggleStyleAppSection = (widthElement1, widthElement2) => {\n    const appSection = document.querySelector(\"#app-section\");\n    appSection.children[0].style.width = `${widthElement1}px`;\n    appSection.children[0].style.minWidth = `${widthElement1}px`;\n    appSection.children[1].style.width = `${widthElement2}%`;\n};\nfunction windowResize() {\n    if (window.innerWidth < 361) {\n        toggleStyleAppSection(0, 100);\n        stateBar(btnBar, false);\n    }\n    else {\n        toggleStyleAppSection(250, 100);\n        stateBar(btnBar, true);\n    }\n}\nwindow.addEventListener('resize', windowResize);\ndocument.addEventListener(\"DOMContentLoaded\", () => {\n    windowResize();\n    closeNavbarModalOption();\n});\nconst stateBar = (element, state) => {\n    element.setAttribute(\"data-state\", state);\n};\n/****NavBar - Menu****/\nbtnBar.addEventListener('click', handleToggleNavbar);\nfunction handleToggleNavbar() {\n    if (btnBar.getAttribute(\"data-state\") == \"false\") {\n        stateBar(btnBar, true);\n        toggleStyleAppSection(250, 100);\n    }\n    else {\n        stateBar(btnBar, false);\n        toggleStyleAppSection(0, 100);\n    }\n    closeNavbarModalOption();\n}\n/**** BOX MENU - GROUP LINKS ****/\nlistBoxLink.forEach((btnLink) => {\n    stateBar(btnLink.parentElement, false);\n    toggleStyleOptionLink(btnLink.parentElement.children[1], 0);\n    btnLink.addEventListener('click', () => handleToggleOptionLink(btnLink));\n});\nfunction handleToggleOptionLink(btnLink) {\n    let listGroupLink = btnLink.parentElement, optLink = listGroupLink.children[1], linkItem = optLink.children;\n    let totalHeightElement = linkItem[0].clientHeight * linkItem.length, borderUpDown = linkItem.length * 2;\n    totalHeightElement = totalHeightElement + borderUpDown;\n    if (listGroupLink.getAttribute(\"data-state\") == \"false\") {\n        stateBar(listGroupLink, true);\n        toggleStyleOptionLink(optLink, totalHeightElement);\n    }\n    else {\n        stateBar(listGroupLink, false);\n        toggleStyleOptionLink(optLink, 0);\n    }\n    closeNavbarModalOption();\n}\nfunction toggleStyleOptionLink(element, height) {\n    if (element) {\n        element.style.height = `${height}px`;\n    }\n}\n/****NavBar - Mas****/\nbtnMas.addEventListener('click', () => handleToggleNavbarModalOption(btnMas));\nfunction handleToggleNavbarModalOption(btn) {\n    if (btn.getAttribute(\"data-state\") == \"false\") {\n        stateBar(btn, true);\n        toggleStyleNavbarModalOption(btn.parentElement.children[1], { height: 'auto', padding: '10px' });\n    }\n    else {\n        stateBar(btn, false);\n        toggleStyleNavbarModalOption(btn.parentElement.children[1], { height: '0px', padding: '0px' });\n    }\n}\nfunction toggleStyleNavbarModalOption(element, style) {\n    element.parentElement.children[1].style.height = style.height;\n    element.parentElement.children[1].style.padding = style.padding;\n}\nfunction closeNavbarModalOption() {\n    [btnMas].forEach(el => {\n        stateBar(el, false);\n        toggleStyleNavbarModalOption(el, { height: '0px', padding: '0px' });\n    });\n}\n\n\n//# sourceURL=webpack://mvc1/./resources/js/app.ts?");

/***/ })

/******/ 	});
/************************************************************************/
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
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	__webpack_modules__["./resources/js/app.ts"](0, {}, __webpack_require__);
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/sass/app.scss"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;