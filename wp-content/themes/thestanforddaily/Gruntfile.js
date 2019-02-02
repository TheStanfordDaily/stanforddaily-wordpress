// Load Grunt
// Ref: https://www.taniarascia.com/getting-started-with-grunt-and-sass/
module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		// Tasks
		sass: {
			dist: {
				files: {
					'style.css': 'sass/style.scss'
				}
			}
		},

		postcss: { // Begin Post CSS Plugin
			options: {
				map: true,
				processors: [
					require('autoprefixer')({
						browsers: ['last 2 versions']
					})
				]
			},
			dist: {
				src: 'style.css'
			}
		},

		cssmin: { // Begin CSS Minify Plugin
			target: {
				files: {
					'style.min.css': 'style.css'
				}
			}
		},

		watch: { // Compile everything into one task with Watch Plugin
			css: {
				files: 'sass/**/*.scss',
				tasks: ['sass', 'postcss', 'cssmin']
			}
		}
	});
	// Load Grunt plugins
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Register Grunt tasks
	grunt.registerTask('default', ['watch']);
};
