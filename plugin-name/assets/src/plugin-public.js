import './styles/public.scss';

/**
 * @function onload The window.onload function is called when the page is loaded
 */
window.onload = () => {
	// Write in console log the PHP value passed in enqueue_js_vars in frontend/Enqueue.php
	( () => {
		// WPBPGen{{#if system_rest}}
		/**
		 * This is a function that is called when the button is clicked
		 *
		 * @function JQuery<HTMLElement>.on<"click">
		 */
		jQuery( '#example-demo-button' ).on( 'click', function () {
			/**
			 * This is a function fires a jQuery AJAX request
			 *
			 * @function jQuery.ajax The AJAX function
			 * @return {Promise} A promise
			 */
			jQuery
				.ajax( {
					method: 'POST',
					url: window.location + 'wp-json/wp/v2/demo/example',
					data: {
						nonce: window.exampleDemo.nonce,
					},
					beforeSend( xhr ) {
						xhr.setRequestHeader(
							'X-WP-Nonce',
							window.exampleDemo.wp_rest
						);
					},
				} )
				.done( function () {
					window.location.reload();
				} )
				.fail( function () {
					// eslint-disable-next-line no-alert,no-undef
					alert( window.exampleDemo.alert );
				} );
		} );
		// {{/if}}
	} )();
	// Place your public-facing magic js 🪄 here
};
