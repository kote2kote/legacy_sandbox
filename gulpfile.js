const { src, dest, task, watch, series, parallel } = require('gulp');
const config = require('./config');
// const del = require('del');
const clean = require('gulp-clean');
// css
const postcss = require('gulp-postcss');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const gulpIf = require('gulp-if');
const processhtml = require('gulp-processhtml');
let isProd = false;
if (process.env.NODE_ENV === 'production') {
  isProd = true;
}

// js
const babel = require('gulp-babel');
const uglify = require('gulp-terser');

// server
const browserSync = require('browser-sync');
const phpServer = require('gulp-connect-php');

// ==================================================
// server
// ==================================================
function livePreview() {
  phpServer.server(
    {
      base: `${config.paths.build}`,
      port: config.port,
      keepalive: true,
      bin: '/Applications/MAMP/bin/php/php7.2.8/bin/php',
      ini: '/Applications/MAMP/bin/php/php7.2.8/conf/php.ini',
    },
    function () {
      browserSync({
        baseDir: `${config.paths.build}`,
        proxy: `127.0.0.1:${config.port}`,
        port: config.port,
      });
    }
  );

  // --------------------------------------------------
  // watch
  // --------------------------------------------------
  // -- html -------------- //
  watch(`${config.paths.src}/**/*.html`, series(html, css, js, jsLibs, jsSingle, previewReload));
  // -- php -------------- //
  watch(`${config.paths.src}/**/*.php`, series(php, css, js, jsLibs, jsSingle, previewReload)); // static用

  // -- css -------------- //
  watch(
    ['./tailwind.config.js', `${config.paths.src}/**/*.scss`],
    series(css, js, jsLibs, jsSingle, previewReload)
  );

  // -- js -------------- //
  watch(`${config.paths.src}/**/*.{js,ts}`, series(css, js, jsLibs, jsSingle, previewReload));
}

function previewReload(done) {
  console.log('ブラウザをリロード');
  browserSync.reload();
  done();
}

// ==================================================
// task
// ==================================================
function cleanFiles() {
  return src(`${config.paths.build}`, { read: false }).pipe(clean());
}

function html() {
  return src(`${config.paths.src}/**/*.html`)
    .pipe(processhtml())
    .pipe(dest(`${config.paths.build}`));
}

function php() {
  // return src(`./**/*.php`).pipe(dest(`./`)); // wpの場合
  return src(`${config.paths.src}/**/*.php`).pipe(dest(`${config.paths.build}`));
}

function css() {
  const tailwindcss = require('tailwindcss');
  return (
    src(`${config.paths.src}/**/*.scss`)
      .pipe(sass.sync().on('error', sass.logError))
      // .pipe(dest(`./src/assets/css`))
      .pipe(postcss([tailwindcss('./tailwind.config.js'), require('autoprefixer')]))
      .pipe(concat({ path: 'style.css' }))
      .pipe(gulpIf(isProd, cleanCSS({ compatibility: 'ie8' }))) // minify
      // .pipe(dest('./')) // wpの場合
      .pipe(dest(`${config.paths.build}/assets/css`))
  );
}

function js() {
  return src(`${config.paths.src}/assets/js/main/**/*.js`)
    .pipe(concat({ path: 'scripts.js' }))
    .pipe(babel())
    .pipe(gulpIf(isProd, uglify()))
    .pipe(dest(`${config.paths.build}/assets/js/main`));
}
function jsLibs() {
  return src([`${config.paths.src}/assets/js/libs/**/*.js`]).pipe(
    dest(`${config.paths.build}/assets/js/libs`)
  );
}
function jsSingle() {
  return (
    src([`${config.paths.src}/assets/js/single/**/*.js`])
      // .pipe(concat({ path: 'scripts.js' }))
      .pipe(babel())
      .pipe(gulpIf(isProd, uglify()))
      .pipe(dest(`${config.paths.build}/assets/js/single`))
  );
}

function etc() {
  return src(`${config.paths.src}/assets/etc/**/*`).pipe(dest(`${config.paths.build}/assets/etc`));
}

function defaultTask(cb) {
  // place code for your default task here
  // console.log('test');
  isProd ? console.log('書き出しました') : console.log('サーバーを起動しました');
  cb();
}

// exports.default = defaultTask;
exports.default = series(
  cleanFiles,
  parallel(html, php, css, js, jsLibs, jsSingle, etc),
  livePreview,
  defaultTask
  // devClean, // Clean Dist Folder
  // parallel(devStyles, devScripts, devImages, icon, prodDevSVG), //Run All tasks in parallel
  // livePreview, // Live Preview Build
  // watchFiles // Watch for Live Changes
);
exports.build = series(
  cleanFiles,
  parallel(html, php, css, js, jsLibs, jsSingle, etc),
  defaultTask
  // devClean, // Clean Dist Folder
  // parallel(devStyles, devScripts, devImages, icon, prodDevSVG), //Run All tasks in parallel
  // livePreview, // Live Preview Build
  // watchFiles // Watch for Live Changes
);
