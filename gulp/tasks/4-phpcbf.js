// Process PHP Code sniffer (https://github.com/squizlabs/PHP_CodeSniffer, doc : https://github.com/squizlabs/PHP_CodeSniffer/wiki)

var gulp      = require('gulp');
var shell     = require('gulp-shell');

var config    = require('../config').phpcbf;
var settings  = require('../config').settings;

gulp.task('phpcbf', function () {

   if (config.doit===false) return;
   
   console.log('\n████████████████████████████████████████████████████████████████████████████')
   console.log('█ PHP Code Sniffer - Scan and detect syntax error                          █');
   console.log('█                   exit code 2 : errors have been found                   █');
   console.log('████████████████████████████████████████████████████████████████████████████\n')
   
   return gulp.src(config.src, {read: false})
      .pipe(shell([
	     'phpcbf --standard=PSR2 ' +
		 '--no-patch ' +     // Needed to avoid diff.exe is not recognized error (https://github.com/squizlabs/PHP_CodeSniffer/issues/458)
		 '--ignore=' + config.exclude + ' ' +
		 config.src
      ]))
	
})