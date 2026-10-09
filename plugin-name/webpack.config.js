const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

const entry = {};
[ 'plugin-admin', 'plugin-public', 'plugin-settings' ].forEach(
	( script ) =>
		( entry[ script ] = path.resolve(
			process.cwd(),
			`assets/src/${ script }.js`
		) )
);

// Block entry point
entry[ 'plugin-block' ] = path.resolve(
	process.cwd(),
	'assets/src/block/hello-world/index.js'
);

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
