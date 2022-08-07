const vueApp = Vue.createApp({
  data() {
    return {
      testText: 'Hello Vue!',
      message: 'this is message for components. ' + new Date().toLocaleString(),
    };
  },
  mounted() {},
  methods: {},
  watch() {},
  computed() {},
});
//  Mount
// -----------------------------------------
vueApp.mount('#vue_root');

vueApp.component('hello', {
  props: ['word'],
  template: `
  <p>{{ word }}</p>
  <p><slot></slot></p>
  <p><slot name="test"></slot></p>
  `,
});

new WOW().init();
gsap.to('#page-test_animation .sec_A .box1', {
  scrollTrigger: {
    trigger: '.sec_A .box1', // 対象オブジェクト
    start: 'bottom bottom', // このオブジェクトのbottomがviewpoertのbottomに到達したら
    markers: true, // デバッグ用マーカー
  },
  x: 500,
});
gsap.to('#page-test_animation .sec_A .box2', {
  scrollTrigger: {
    trigger: '.sec_A .box1',
    start: 'bottom bottom',
    markers: true,
  },
  x: -500,
});

gsap.to('#page-test_animation .sec_C .box1', {
  scrollTrigger: {
    trigger: '.sec_C .box1', // 対象オブジェクト
    start: 'bottom bottom', // このオブジェクトのbottomがviewpoertのbottomに到達したら
    markers: true, // デバッグ用マーカー
  },
  opacity: 1,
});
gsap.to('#page-test_animation .sec_C .box2', {
  scrollTrigger: {
    trigger: '.sec_C .box1',
    start: 'bottom bottom',
    markers: true,
  },
  opacity: 1,
});

// ==================================================
// React App Name
// ==================================================
const ComponentTest = (props) => {
  return (
    <>
      <p>hello world from Test</p>
      <p>{props.pmessage}</p>
      <p>{props.children}</p>
    </>
  );
};

const App = () => {
  return (
    <>
      <p>hello world from react.</p>
      <ComponentTest pmessage='ここはprops.pmessage'>
        <p className='text-red-900'>ここはprops.childrenで取り出す</p>
      </ComponentTest>
    </>
  );
};

const SubApp = () => {
  return (
    <>
      <p>hello sub.</p>
      <ComponentTest pmessage='ここはprops.pmessage'>
        <p className='text-red-900'>ここはprops.childrenで取り出す</p>
      </ComponentTest>
    </>
  );
};

if (document.getElementById('root') && document.getElementById('sub_root')) {
  ReactDOM.render(
    <React.StrictMode>
      <App />
    </React.StrictMode>,
    document.getElementById('root')
  );
  ReactDOM.render(
    <React.StrictMode>
      <SubApp />
    </React.StrictMode>,
    document.getElementById('sub_root')
  );
}
