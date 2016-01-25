'use strict';
module.exports = function (grunt) {

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
          relativeAssets: true,
          sourcemap: true
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
          relativeAssets: true,
          sourcemap: true
        }
      }
    },
    coffee: {
      admin: {
        options: {
          bare: true,
          join: true
        },
        files: {
          'admin/assets/js/admin.js': 'admin/assets/coffee/admin.coffee'
        }
      },
      public: {
        options: {
          bare: true,
          join: true
        },
        files: {
          'public/assets/js/public.js': 'public/assets/coffee/public.coffee'
        }
      },
      adminDev: {
        options: {
          bare: true,
          join: true,
          sourceMap: true
        },
        files: {
          'admin/assets/js/admin.js': 'admin/assets/coffee/admin.coffee'
        }
      },
      publicDev: {
        options: {
          bare: true,
          join: true,
          sourceMap: true
        },
        files: {
          'public/assets/js/public.js': 'public/assets/coffee/public.coffee'
        }
      }
    },
    watch: {
      compass: {
        files: [
          'admin/assets/sass/*.scss',
          'public/assets/sass/*.scss',
          'admin/assets/coffee/*.coffee',
          'public/assets/coffee/*.coffee'
        ],
        tasks: [
          'compass:adminDev', 'compass:publicDev',
          'coffee:adminDev', 'coffee:publicDev'
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
    'compass:admin', 'compass:public',
    'coffee:admin', 'coffee:public'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
