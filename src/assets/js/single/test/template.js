console.log('hello');

// ==================================================
// On / Off Humberger
// ==================================================
const isHumApp = Vue.createApp({
  setup() {
    const isHumOpen = Vue.ref(false);

    const openMenu = () => {
      isHumOpen.value = !isHumOpen.value;
    };

    return {
      isHumOpen,
      openMenu,
    };
  },
}).mount('header');

// ==================================================
// title
// ==================================================
const tabApp = Vue.createApp({
  setup() {
    // -- ref/reactive -------------- //
    const isTabOpenSimple = Vue.ref([]); // 個別タブ1開閉フラグ
    const isTabOpenJson = Vue.ref([]); // jsonタブ開閉フラグ
    const isTabOpenWP = Vue.ref([]); // wpタブ開閉フラグ

    // data
    const wpPosts = Vue.ref([]); // wp

    const dammyPost = Vue.reactive([
      // json
      {
        id: 1,
        title: 'ここはタイトル1',
        post: 'いわゆる状態保持状態の変数の定義1。reactiveはvue2のdataのようなもの(vue2のdataは常に保持していた)',
      },
      {
        id: 2,
        title: 'ここはタイトル2',
        post: 'いわゆる状態保持状態の変数の定義2。reactiveはvue2のdataのようなもの(vue2のdataは常に保持していた)',
      },
      {
        id: 3,
        title: 'ここはタイトル3',
        post: 'いわゆる状態保持状態の変数の定義3。reactiveはvue2のdataのようなもの(vue2のdataは常に保持していた)',
      },
      {
        id: 4,
        title: 'ここはタイトル4',
        post: 'いわゆる状態保持状態の変数の定義4。reactiveはvue2のdataのようなもの(vue2のdataは常に保持していた)',
      },
    ]);

    // -- methods -------------- //
    const openTabSimple = (num) => {
      isTabOpenSimple.value[num] = isTabOpenSimple.value[num] ?? false;

      if (isTabOpenSimple.value[num]) {
        isTabOpenSimple.value[num] = false;
      } else {
        isTabOpenSimple.value[num] = true;
      }
      // if (num === '01') {
      //   isTabOpenSimple01.value = !isTabOpenSimple01.value;
      // } else {
      //   isTabOpenSimple02.value = !isTabOpenSimple02.value;
      // }
    };
    const openTabJson = (num) => {
      isTabOpenJson.value[num] = isTabOpenJson.value[num] ?? false;

      if (isTabOpenJson.value[num]) {
        isTabOpenJson.value[num] = false;
      } else {
        isTabOpenJson.value[num] = true;
      }
    };
    const openTabWP = (num) => {
      isTabOpenWP.value[num] = isTabOpenWP.value[num] ?? false;

      if (isTabOpenWP.value[num]) {
        isTabOpenWP.value[num] = false;
      } else {
        isTabOpenWP.value[num] = true;
      }
    };
    const getPosts = async () => {
      const tmpPosts = await axios
        .get('https://kote2tokyo.kote2.biz/wp-json/wp/v2/posts?_embed&per_page=10&page=1')
        .then((response) => (wpPosts.value = response.data));
      return tmpPosts;
    };
    const beforeEnter = (el) => {
      console.log('beforeEnter');
      console.log(el);
      el.style.height = '0';
    };
    const enter = (el) => {
      console.log('enter');
      console.log(el);
      el.style.height = el.scrollHeight + 'px';
    };
    const beforeLeave = (el) => {
      console.log('beforeLeave');
      console.log(el);
      el.style.height = el.scrollHeight + 'px';
    };
    const leave = (el) => {
      console.log('leave');
      console.log(el);
      el.style.height = '0';
    };

    Vue.onMounted(() => {
      getPosts();
    });

    return {
      isTabOpenSimple,
      openTabSimple,
      dammyPost,
      isTabOpenJson,
      openTabJson,
      wpPosts,
      openTabWP,
      isTabOpenWP,
      beforeEnter,
      enter,
      beforeLeave,
      leave,
    };
  },
}).mount('#Section00');

// ==================================================
// smooth-scroll.js
// ==================================================
var scroll = new SmoothScroll('a[href*="#"]', {
  speed: 500,
  speedAsDuration: true,
  offset: 100,
});

// ==================================================
// ある地点までスクロールしたらトップに戻るボタン表示
// ==================================================
const app = Vue.createApp({
  setup() {
    const scrollTop = Vue.ref(null);
    const isActive = Vue.ref(false);

    Vue.onMounted(() => {
      console.log(scrollTop.value);
      gsap.to(scrollTop, {
        scrollTrigger: {
          trigger: '#Section01',
          start: 'bottom bottom',
          end: 'top top',
          duration: 1,
          onEnter: () => {
            // startの地点
            // console.log('onEnter');
            isActive.value = true;
          },
          onEnterBack: () => {
            // endの地点
            // console.log('onEnterBack');
            isActive.value = false;
          },
        },
      });
    });

    return { scrollTop, isActive };
  },
}).mount('#scrollTop');
