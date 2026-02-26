/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./src/scripts/asu-footer-init.js ***!
  \****************************************/
/*
Initialize ASU React Footer.
*/

// console.log(udsFooterVars);

window.addEventListener("DOMContentLoaded", event => {
  AsuHeaderFooter.initASUFooter({
    targetSelector: "#asu-react-footer",
    props: {
      contact: udsFooterVars
    }
  });
});
/******/ })()
;
//# sourceMappingURL=asu-footer-init.js.map