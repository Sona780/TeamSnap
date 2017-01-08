module.exports = function (grunt) {
	// Project configuration.
	grunt.initConfig({
    	pkg: grunt.file.readJSON('package.json'),
        uglify: {
        	options: {
            	banner: '/*! <%= pkg.name %> <%= grunt.template.today("2017-01-07") %> */\n'
        	},
        	build: {
            	src: 'resources/assets/sass/*.js',
            	dest: 'main.js'
        	}
    	},
    	sass: {
        	dist: {
            	options: {
                	style: 'compact'
            	},
            	files: {
                	'style.css': 'resources/assets/sass/style.scss',
            	}
            }
    	},
    	watch: {
        	scripts: {
            	files: [
      	'resources/assets/sass/*.js',
      	'resources/assets/sass/*.scss',
    	],
            	tasks: ['default'],
            	options: {
                	spawn: false,
            	}
        	}
    	}
	});