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

