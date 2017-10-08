// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import datebook from './routes/datebook';
// Utils
import initMap from './initMap';
/** Populate Router instance with DOM routes */
const routes = new Router({
	// All pages
	common,
	// Home page
	home,
	// About Us page, note the change from about-us to aboutUs.
	aboutUs,
	datebook
});

// Load Events
document.addEventListener('DOMContentLoaded', () => routes.loadEvents())

// Init google map callback, it must be here
window.initMap = initMap;