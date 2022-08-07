"use strict";

// ==================================================
// debug tool
// ==================================================
var isDebugMode = false;
var domDebug = document.querySelector('#js_debug');

function openDebug(e) {
  // console.log(e);
  if (e.keyCode === 27) {
    // 27 === esc
    isDebugMode = !isDebugMode;

    if (isDebugMode) {
      console.log('remove hidden');
      domDebug.classList.remove('hidden');
    } else {
      console.log('add hidden');
      domDebug.classList.add('hidden');
    }
  }
}

window.addEventListener('keyup', openDebug);
var vueApp = Vue.createApp({
  data: function data() {
    return {
      testText: 'Hello Vue!',
      message: 'this is message for components. ' + new Date().toLocaleString()
    };
  },
  mounted: function mounted() {},
  methods: {},
  watch: function watch() {},
  computed: function computed() {}
}); //  Mount
// -----------------------------------------

vueApp.mount('#vue_root');
vueApp.component('hello', {
  props: ['word'],
  template: "\n  <p>{{ word }}</p>\n  <p><slot></slot></p>\n  <p><slot name=\"test\"></slot></p>\n  "
});
new WOW().init();
gsap.to('#page-test_animation .sec_A .box1', {
  scrollTrigger: {
    trigger: '.sec_A .box1',
    // 対象オブジェクト
    start: 'bottom bottom',
    // このオブジェクトのbottomがviewpoertのbottomに到達したら
    markers: true // デバッグ用マーカー

  },
  x: 500
});
gsap.to('#page-test_animation .sec_A .box2', {
  scrollTrigger: {
    trigger: '.sec_A .box1',
    start: 'bottom bottom',
    markers: true
  },
  x: -500
});
gsap.to('#page-test_animation .sec_C .box1', {
  scrollTrigger: {
    trigger: '.sec_C .box1',
    // 対象オブジェクト
    start: 'bottom bottom',
    // このオブジェクトのbottomがviewpoertのbottomに到達したら
    markers: true // デバッグ用マーカー

  },
  opacity: 1
});
gsap.to('#page-test_animation .sec_C .box2', {
  scrollTrigger: {
    trigger: '.sec_C .box1',
    start: 'bottom bottom',
    markers: true
  },
  opacity: 1
}); // ==================================================
// React App Name
// ==================================================

var ComponentTest = function ComponentTest(props) {
  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("p", null, "hello world from Test"), /*#__PURE__*/React.createElement("p", null, props.pmessage), /*#__PURE__*/React.createElement("p", null, props.children));
};

var App = function App() {
  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("p", null, "hello world from react."), /*#__PURE__*/React.createElement(ComponentTest, {
    pmessage: "\u3053\u3053\u306Fprops.pmessage"
  }, /*#__PURE__*/React.createElement("p", {
    className: "text-red-900"
  }, "\u3053\u3053\u306Fprops.children\u3067\u53D6\u308A\u51FA\u3059")));
};

var SubApp = function SubApp() {
  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("p", null, "hello sub."), /*#__PURE__*/React.createElement(ComponentTest, {
    pmessage: "\u3053\u3053\u306Fprops.pmessage"
  }, /*#__PURE__*/React.createElement("p", {
    className: "text-red-900"
  }, "\u3053\u3053\u306Fprops.children\u3067\u53D6\u308A\u51FA\u3059")));
};

if (document.getElementById('root') && document.getElementById('sub_root')) {
  ReactDOM.render( /*#__PURE__*/React.createElement(React.StrictMode, null, /*#__PURE__*/React.createElement(App, null)), document.getElementById('root'));
  ReactDOM.render( /*#__PURE__*/React.createElement(React.StrictMode, null, /*#__PURE__*/React.createElement(SubApp, null)), document.getElementById('sub_root'));
}