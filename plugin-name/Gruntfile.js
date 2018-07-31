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
    coffee: {
      js: {
        options: {
          bare: true,
          join: true
        },
        files: {
          'assets/js/public.js': 'assets/coffee/public.coffee',
          'assets/js/admin.js': 'assets/coffee/admin.coffee',
          'assets/js/settings.js': 'assets/coffee/settings.coffee'
        }
      },
      jsDev: {
        options: {
          bare: true,
          join: true,
          sourceMap: true
        },
        files: {
          'assets/js/public.js': 'assets/coffee/public.coffee',
          'assets/js/admin.js': 'assets/coffee/admin.coffee',
          'assets/js/settings.js': 'assets/coffee/settings.coffee'
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
  grunt.loadNpmTasks('grunt-contrib-coffee');

  // Register tasks
  grunt.registerTask('default', [
    'compass:css', 'compass:cssDev',
    'coffee:js', 'coffee:jsDev'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
