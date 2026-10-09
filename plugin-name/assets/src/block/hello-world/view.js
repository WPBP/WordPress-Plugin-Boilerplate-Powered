/**
 * Hello World block — Interactivity API store.
 *
 * The initial text comes from the server-rendered `data-wp-context`
 * attribute, so the block attribute stays the source of truth.
 */
import { store, getContext } from '@wordpress/interactivity';

store( 'plugin-name/hello-world', {
	actions: {
		toggle: () => {
			const context = getContext();
			context.text =
				context.text === 'World' ? 'Interactivity!' : 'World';
		},
	},
} );
