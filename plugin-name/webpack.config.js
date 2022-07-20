const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

const entry = {
	'plugin-name-admin': path.resolve(
		process.cwd(),
		`assets/src/plugin-admin.js`
	),
	'plugin-name-block': path.resolve(
		process.cwd(),
		`assets/src/plugin-block.js`
	),
	'plugin-name-public': path.resolve(
		process.cwd(),
		`assets/src/plugin-public.js`
	),
	'plugin-name-settings': path.resolve(
		process.cwd(),
		`assets/src/plugin-settings.js`
	),
};

module.exports = {
	...defaultConfig,
	entry,
	output: {
		path: path.join( __dirname, './assets/build' ),
	},
	externals: {
		react: 'React',
		'react-dom': 'ReactDOM',
	},
};
