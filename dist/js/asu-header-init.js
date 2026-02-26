/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./src/scripts/asu-header-init.js ***!
  \****************************************/
/*
Initialize ASU React Header.
*/

window.addEventListener("DOMContentLoaded", event => {
  AsuHeaderFooter.initGlobalHeader({
    targetSelector: "#header-container",
    props: {
      loggedIn: udsHeaderVars.loggedIn,
      logoutLink: udsHeaderVars.logoutLink,
      loginLink: udsHeaderVars.loginLink,
      userName: udsHeaderVars.userName,
      navTree: udsHeaderVars.navTree,
      // navTree: exampleNavTree,
      title: udsHeaderVars.title,
      baseUrl: udsHeaderVars.baseUrl,
      logo: udsHeaderVars.logo,
      isPartner: udsHeaderVars.isPartner,
      partnerLogo: udsHeaderVars.partnerLogo,
      animateTitle: udsHeaderVars.animateTitle,
      expandOnHover: udsHeaderVars.expandOnHover,
      parentOrg: udsHeaderVars.parentOrg,
      parentOrgUrl: udsHeaderVars.parentOrgUrl,
      breakpoint: udsHeaderVars.breakpoint,
      buttons: udsHeaderVars.buttons,
      searchUrl: udsHeaderVars.searchUrl,
      site: udsHeaderVars.site
    }
  });
});
/******/ })()
;
//# sourceMappingURL=asu-header-init.js.map