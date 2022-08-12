<?php
define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../php_libs/init.php';

$smarty = new Smarty;
$smarty->template_dir = _SMARTY_TEMPLATES_DIR;
$smarty->compile_dir  = _SMARTY_TEMPLATES_C_DIR;
$smarty->config_dir   = _SMARTY_CONFIG_DIR;
$smarty->cache_dir    = _SMARTY_CACHE_DIR;

session_start();

if (!empty($_POST['type']) &&  $_POST['type'] == 'authenticate' ) {
    // 認証機能
    if( $_POST['username']== 'user' && $_POST['password'] == 'pass' ){
        $_SESSION['id'] = 1;// 数値ならなんでもOK
    }
}else if( !empty($_GET['type']) && $_GET['type'] == 'logout'){
    $_SESSION = [];
}


if(!empty($_SESSION) && $_SESSION['id'] >= 1){
    // 認証済み
    $smarty->assign("title", "会員ページ");
    $file = 'testauth.tpl';

}else{
    // 未認証
    $smarty->assign("title", "ゲストページ");
    $smarty->assign("type", "authenticate");
    $file = 'testlogin.tpl';

    $form = new HTML_QuickForm2('Form');
    $form->addElement('text','username', ['size' => 15, 'maxlength' => 50], ['label' => 'ユーザー名']);
    $form->addElement('password','password', ['size' => 15, 'maxlength' => 50], ['label' => 'パスワード']);
    $form->addElement('submit','submit', ['value' => 'ログイン']);

    HTML_QuickForm2_Renderer::register('smarty','HTML_QuickForm2_Renderer_Smarty');
    $renderer  = HTML_QuickForm2_Renderer::factory('smarty');
    $renderer->setOption('old_compat', true);
    $renderer->setOption('group_errors', false);
    $smarty->assign('form', $form->render($renderer)->toArray());
}

$smarty->display($file);
