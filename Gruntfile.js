module.exports = function(grunt) {
  const sass = require('node-sass');
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Define Path
    dirs: {
        input               : 'development',
        inputSCSS           : 'development/sass',
        inputJS             : 'assets',
        inputDevJS          : 'development/js',
        inputHTMLELements   : 'development/html-elements',
        output              : 'production',
        outputCSS           : './',
        outputJS            : 'js',
    },
    // Plugin 01: CSSmin
    cssmin: {
        options: {
        },
        target: {
            files: {
                '<%= dirs.outputCSS %>/main.css' : '<%= dirs.outputCSS %>/main.css'
            }
        }
    },
    // Plugin 02: Uglify
    uglify: {
        options: {
            beautify: false,
            compress: {
                drop_console: true
            }
        },
        my_target: {
            files: {
                '<%= dirs.outputJS %>/main.js': ['<%= dirs.inputJS %>/main.js']
            }
        },
        // my_advanced_target: {
        //     files: {
        //         '<%= dirs.outputJS %>/plugins.min.js': ['<%= dirs.inputJS %>/plugins.js']
        //     }
        // }
    },

    concat: {
        basic: {
            src: [
                // '<%= dirs.inputJS %>/js/jquery-1.11.1.min.js',
                '<%= dirs.inputJS %>/jquery-migrate-3.1.0.min.js',
                '<%= dirs.inputJS %>/bootstrap/js/bootstrap.min.js',
                '<%= dirs.inputJS %>/js/jquery.lazyload.min.js',
                '<%= dirs.inputJS %>/bxslider/jquery.bxslider.min.js',
                '<%= dirs.inputJS %>/lobibox/dist/js/lobibox.min.js',
                '<%= dirs.inputJS %>/nprogress-master/nprogress.js',
                '<%= dirs.inputJS %>/fancybox/jquery.fancybox.js',
                // '<%= dirs.inputJS %>/iView-master/js/raphael-min.js',
                // '<%= dirs.inputJS %>/iView-master/js/jquery.easing.j',
                // '<%= dirs.inputJS %>/iView-master/js/iview.js',
                '<%= dirs.inputJS %>/carousel/js/jquery.flexisel.js',
                '<%= dirs.inputJS %>/slick.min.js',
                '<%= dirs.inputJS %>/js/less-1.7.3.min.js',
                '<%= dirs.inputJS %>/js/script.js',
            ],
            dest: '<%= dirs.inputJS %>/main.js',
        },
        // extras: {
        //     src: [
        //         '<%= dirs.inputJS %>/jquery-migrate-3.1.0.min.js',
        //         '<%= dirs.inputJS %>/lazyload.min.js',
        //         // '<%= dirs.inputJS %>/bootstrap.bundle.min.js',
        //         '<%= dirs.inputJS %>/jquery.fancybox.min.js',
        //         '<%= dirs.inputJS %>/slick.min.js',
        //         '<%= dirs.inputJS %>/list.min.js',
        //         '<%= dirs.inputJS %>/wow.min.js',
        //         '<%= dirs.inputJS %>/magiczoomplus.js',
        //     ],
        //     dest: '<%= dirs.inputJS %>/plugins.js',
        // },
      },
    
    // Plugin 04: Sass
    sass: {
        options: {
            implementation: sass,
            style: 'expanded',
            sourceMap: true
        },
        dist: {
            files: {
                '<%= dirs.outputCSS %>/main.css': '<%= dirs.inputSCSS %>/main.scss'
            }
        }
    },

    // Plugin 05: watch
    watch: {
        scripts: {
            files: [
                '<%= dirs.inputSCSS %>/*.scss',             // development/sass/*.scss
                '<%= dirs.inputSCSS %>/*/*.scss',           // development/sass/*/*.scss
                '<%= dirs.inputDevJS %>/*.js', 
                '<%= dirs.input %>/index.html',
                '<%= dirs.inputHTMLELements %>/*.html',     // development/html-elements/*.html
                //'<%= dirs.inputHTMLELements %>/*/*.html', // development/html-elements/*/*.html
            ],
            tasks: ['sass'],
            options: {
                spawn: false,
                livereload: true
            },
        },
    },
    // Plugin 06: connect
    // connect: {
    //     server: {
    //         options: {
    //             hostname: 'localhost',
    //             port: 3069,
    //             base: '<%= dirs.output %>/',
    //             livereload: true
    //         }
    //     }
    // },
});
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  // grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.registerTask('default', 'Log some stuff.', function() {
    grunt.log.write('Logging some stuff...').ok();
  });

  grunt.registerTask('dev', [
    'sass',
    // 'connect',
    'watch'
  ]);
  // grunt.registerTask('ci', [
  //   'critical'
  // ]);
  // Task Publish Project
    grunt.registerTask('publish', [
        'cssmin',
        'concat',
        'uglify'
    ]);
    grunt.registerTask('devjs', [
      'concat:basic'
    ]);
    
}