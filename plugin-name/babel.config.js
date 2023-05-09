/** @type {import('@babel/core').ConfigFunction} */
module.exports = ( api ) => {
	api.cache.using( () => process.env.NODE_ENV );

	return {
		presets: [
			'@babel/preset-typescript',
			'@wordpress/babel-preset-default',
		],
	};
};
