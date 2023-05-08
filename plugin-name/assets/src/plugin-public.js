import './styles/public.scss';

window.onload = () => {
	// Write in console log the PHP value passed in enqueue_js_vars in frontend/Enqueue.php
	( () => {
		// WPBPGen{{#if system_rest}}
		jQuery( '#example-demo-button' ).on( 'click', function () {
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
							window.exampleDemo?.wp_rest
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

	// Place your public-facing JavaScript here
};
