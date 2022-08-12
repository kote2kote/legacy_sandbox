<?php
/* Smarty version 3.1.30, created on 2017-07-14 10:53:51
  from "/Users/nagatayorinobu/Dropbox/htdocs/sample/Section77/htdocs/testhqf.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5968242f695ad5_21229571',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06dd6204e28e771333b8866479129fb88310c2ca' => 
    array (
      0 => '/Users/nagatayorinobu/Dropbox/htdocs/sample/Section77/htdocs/testhqf.tpl',
      1 => 1499997224,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5968242f695ad5_21229571 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
<?php echo '<script'; ?>
 type="text/javascript" src="js/quickform.js"><?php echo '</script'; ?>
>
</head>
<title></title>
<body>
    <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

    <?php if (isset($_smarty_tpl->tpl_vars['form']->value['name']['error'])) {?>
        <div style="color: red"><?php echo $_smarty_tpl->tpl_vars['form']->value['name']['error'];?>
</div>
    <?php }?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['name']['label'];?>
:<?php echo $_smarty_tpl->tpl_vars['form']->value['name']['html'];?>

    <?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

</form>
<?php if (isset($_smarty_tpl->tpl_vars['form']->value['javascript'])) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }?>
</body>
</html><?php }
}
