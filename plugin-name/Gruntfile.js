'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    compass: {
      admin: {
        options: {
          sassDir: 'admin/assets/sass',
          cssDir: 'admin/assets/css',
          environment: 'production',
          relativeAssets: true
        }
      },
      public: {
        options: {
          sassDir: 'public/assets/sass',
          cssDir: 'public/assets/css',
          environment: 'production',
          relativeAssets: true
        }
      },
      adminDev: {
        options: {
          environment: 'development',
          debugInfo: true,
          noLineComments: false,
          sassDir: 'public/assets/sass',
          cssDir: 'public/assets/css',
          outputStyle: 'expanded',
          relativeAssets: true
        }
      },
      publicDev: {
        options: {
          environment: 'development',
          debugInfo: true,
          noLineComments: false,
          sassDir: 'public/assets/sass',
          cssDir: 'public/assets/css',
          outputStyle: 'expanded',
          relativeAssets: true
        }
      }
    },
    watch: {
      compass: {
        files: [
          'admin/assets/sass/*.scss',
          'public/assets/sass/*.scss'
        ],
        tasks: ['compass:adminDev', 'compass:publicDev']
      }
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');

  // Register tasks
  grunt.registerTask('default', [
    'compass:admin', 'compass:public'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
