/* global pn_js_vars */
import "./styles/public.scss";

window.onload = () => {
	// Write in console log the PHP value passed in enqueue_js_vars in frontend/Enqueue.php
	( () => {
		// WPBPGen{{#if system_rest}}
		jQuery("#example-demo-button").on("click", function() {
			jQuery.ajax({
				method: "POST",
				url: window.location + "wp-json/wp/v2/demo/example",
				data: {
					nonce: window.example_demo.nonce
				},
				beforeSend: function (xhr) {
					xhr.setRequestHeader("X-WP-Nonce", window.example_demo.wp_rest);
				}
			})
			.done(function( msg ) {
				window.location.reload();
			}).fail(function( msg ) {
				alert( window.example_demo.alert );
			});
		});
		// {{/if}}
	} )();

	// Place your public-facing JavaScript here
};
