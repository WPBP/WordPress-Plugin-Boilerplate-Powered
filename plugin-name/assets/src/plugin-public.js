/* global pn_js_vars */
import "./styles/public.scss";

window.onload = () => {
	// Write in console log the PHP value passed in enqueue_js_vars in public/class-plugin-name.php
	( () => {
		console.log( pn_js_vars.alert );
	} )();

	// Place your public-facing JavaScript here
};
