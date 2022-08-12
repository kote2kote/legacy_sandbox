<?php
/* Smarty version 3.1.30, created on 2017-07-02 20:56:47
  from "/Users/nagatayorinobu/Dropbox/htdocs/sample/Section77/php_libs/smarty/templates/premember.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5958df7f08cb10_97121078',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3b1dc93e8ed2aea2345d1e6fcf8dc02850b26aa' => 
    array (
      0 => '/Users/nagatayorinobu/Dropbox/htdocs/sample/Section77/php_libs/smarty/templates/premember.tpl',
      1 => 1498222873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5958df7f08cb10_97121078 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
    <table>
      <tr>
        
      <td> <a href="index.php">トップページへ</a>
      </td>
        
      <td>
  		<?php echo $_smarty_tpl->tpl_vars['message']->value;?>


        </td>
      </tr>
    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
