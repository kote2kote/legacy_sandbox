<?php
/* Smarty version 3.1.30, created on 2017-07-16 11:02:04
  from "/Users/nagatayorinobu/Dropbox/htdocs/sample/Section77/htdocs/testlogin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_596ac91cdd5735_26394293',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3124b6711a4f6a9c3f5654d9023c80c0034189ba' => 
    array (
      0 => '/Users/nagatayorinobu/Dropbox/htdocs/sample/Section77/htdocs/testlogin.tpl',
      1 => 1498222873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_596ac91cdd5735_26394293 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;?>

<form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
<?php echo $_smarty_tpl->tpl_vars['form']->value['username']['label'];?>
:<br>
<?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>
<br>
<?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
:<br>
<?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>

<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
<?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

</form><?php }
}
