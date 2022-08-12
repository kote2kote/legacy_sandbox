<?php
define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../php_libs/init.php';

$smarty = new Smarty;
$smarty->template_dir = _SMARTY_TEMPLATES_DIR;
$smarty->compile_dir  = _SMARTY_TEMPLATES_C_DIR;
$smarty->config_dir   = _SMARTY_CONFIG_DIR;
$smarty->cache_dir    = _SMARTY_CACHE_DIR;

$form = new HTML_QuickForm2('Form');
$name = $form->addElement('text','name', ['size' => 30], ['label' => '名前']);
$name->addRule('required', '名前を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
$form->addElement('submit','submit', ['value' => '送信']);
if ($form->validate()){ $form->toggleFrozen(true);}

HTML_QuickForm2_Renderer::register('smarty','HTML_QuickForm2_Renderer_Smarty');
$renderer  = HTML_QuickForm2_Renderer::factory('smarty');
$renderer->setOption('old_compat', true);
$renderer->setOption('group_errors', false);

$smarty->assign('form', $form->render($renderer)->toArray());

$file = 'testhqf.tpl';
$smarty->display($file);
