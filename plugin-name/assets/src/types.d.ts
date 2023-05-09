/// <reference types="@wordpress/blocks" />
import { BlockAttributes } from '@wordpress/blocks';

/**
 * Admin script types
 */
interface ExampleDemo {
	nonce: string;
	wp_rest: string;
	alert: string;
}

declare global {
	interface Window {
		exampleDemo: ExampleDemo;
	}
}
