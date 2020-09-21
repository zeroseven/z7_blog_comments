'use strict';

const gulp = require('gulp');
const uglify = require('gulp-uglify');
const babel = require('gulp-babel');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const cleancss = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('Scss', function (done) {

  // Define the file path
  gulp.src('./Resources/Private/Scss/**/*.scss')

  // Convert scss to css
    .pipe(sass().on('error', sass.logError))

    // Save an uncompressed file (for debugging)
    .pipe(rename({suffix: '.dist'}))
    .pipe(autoprefixer())
    .pipe(gulp.dest('./Resources/Public/Css'))

    // Generate a compressed file
    .pipe(rename({suffix: '.min'}))
    .pipe(cleancss())
    .pipe(gulp.dest('./Resources/Public/Css'));

  done();
});


gulp.task('JavaScript', done => {

  // Define the file paths
  gulp.src(['./Resources/Private/JavaScript/**/*.js'])

  // Make compatibility to older browser versions
    .pipe(babel({
      presets: ['@babel/preset-env']
    }))

    // Beautify the code for debugging (only)
    .pipe(uglify({
      compress: false,
      mangle: false,
      output: {
        beautify: true
      }
    }))

    // Save a uncompressed file
    .pipe(rename({suffix: '.dist'}))
    .pipe(gulp.dest('./Resources/Public/JavaScript'))

    // Save the minified JavaScript
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./Resources/Public/JavaScript'));

  done();
});

gulp.task('build', gulp.series('JavaScript', 'Scss'));

gulp.task('watch', () => {
  gulp.watch(['./Resources/Private/JavaScript/**/*.js', './Resources/Private/Scss/**/*.scss'], gulp.series('build'));
});

gulp.task('default', gulp.series('build', 'watch'));
