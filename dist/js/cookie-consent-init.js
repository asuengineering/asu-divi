/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./src/scripts/cookie-consent-init.js ***!
  \********************************************/
window.addEventListener("DOMContentLoaded", event => {
  AsuCookieConsent.initCookieConsent({
    targetSelector: "#cookieConsentContainer",
    props: {
      enableCookieConsent: true,
      expirationTime: 90 // Number of days to expire the consent
    }
  });
});
/******/ })()
;
//# sourceMappingURL=cookie-consent-init.js.map