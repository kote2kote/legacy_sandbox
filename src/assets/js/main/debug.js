// ==================================================
// debug tool
// ==================================================
let isDebugMode = false;
const domDebug = document.querySelector('#js_debug');
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
