'use strict';
module.exports = function (grunt) {

	grunt.initConfig({
		compass: {
			css: {
				options: {
					sassDir: 'assets/sass',
					cssDir: 'assets/css',
					environment: 'production',
					relativeAssets: true
				}
			},
			cssDev: {
				options: {
					environment: 'development',
					debugInfo: true,
					noLineComments: false,
					sassDir: 'assets/sass',
					cssDir: 'assets/css',
					outputStyle: 'expanded',
					relativeAssets: true,
					sourcemap: true
				}
			}
		},
		watch: {
			compass: {
				files: [
					'assets/sass/*.scss',
					'assets/coffee/*.coffee'
				],
				tasks: [
					'compass:css', 'compass:cssDev',
					'coffee:js', 'coffee:jsDev'
				]
			}
		}
	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');

	// Register tasks
	grunt.registerTask('default', [
		'compass:css', 'compass:cssDev'
	]);
	grunt.registerTask('dev', [
		'watch'
	]);

};
