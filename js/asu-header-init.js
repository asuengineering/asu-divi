// console.log(udsHeaderVars.navTree);
// console.log(exampleNavTree);

window.addEventListener("DOMContentLoaded", event => {
	AsuHeader.initGlobalHeader({
		targetSelector: "#header-container",
		props: {
			loggedIn: udsHeaderVars.loggedIn,
			logoutLink: udsHeaderVars.logoutLink,
			loginLink: udsHeaderVars.loginLink,
			userName: udsHeaderVars.userName,
			navTree: udsHeaderVars.navTree,
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
			site: udsHeaderVars.site,
		}
	});
});
