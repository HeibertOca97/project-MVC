(()=>{"use strict";(()=>{console.log("Archivo: App.js");const e=document.getElementById("btn-navbar"),t=document.getElementById("btn-mas"),n=document.querySelectorAll(".link-action"),i=(e,t)=>{document.querySelector("#app-section").style.gridTemplateColumns=`${e} ${t}`};function d(){window.innerWidth<361?(i("0px","1fr"),a(e,!1)):(i("250px","1fr"),a(e,!0))}window.addEventListener("resize",d),document.addEventListener("DOMContentLoaded",(()=>{d(),r()}));const a=(e,t)=>{e.setAttribute("data-state",t)};function l(e,t){e&&(e.style.height=`${t}px`)}function c(e,t){e.parentElement.children[1].style.height=t.height,e.parentElement.children[1].style.padding=t.padding}function r(){[t].forEach((e=>{a(e,!1),c(e,{height:"0px",padding:"0px"})}))}e.addEventListener("click",(function(){"false"==e.getAttribute("data-state")?(a(e,!0),i("250px","1fr")):(a(e,!1),i("0px","1fr")),r()})),n.forEach((e=>{a(e.parentElement,!1),l(e.parentElement.children[1],0),e.addEventListener("click",(()=>function(e){let t=e.parentElement,n=t.children[1],i=n.children,d=i[0].clientHeight*i.length;d+=2*i.length,"false"==t.getAttribute("data-state")?(a(t,!0),l(n,d)):(a(t,!1),l(n,0)),r()}(e)))})),t.addEventListener("click",(()=>{var e;"false"==(e=t).getAttribute("data-state")?(a(e,!0),c(e.parentElement.children[1],{height:"auto",padding:"10px"})):(a(e,!1),c(e.parentElement.children[1],{height:"0px",padding:"0px"}))})),fetch("https://jsonplaceholder.typicode.com/todos").then((e=>e.json())).then((e=>console.log(e)))})()})();