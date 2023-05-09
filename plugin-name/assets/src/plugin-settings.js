import './styles/settings.scss';

/**
 * Search for an element with the "tabs" id then fire the "tabs" function
 *
 * @param {jQuery} $ The jQuery object to be used in the function body
 */
( ( $ ) => {
	$( () => {
		$( '#tabs' ).tabs();
	} );
	// Place your administration-specific JavaScript here
} )( jQuery );
