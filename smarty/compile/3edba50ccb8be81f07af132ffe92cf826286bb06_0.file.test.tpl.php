<?php
/* Smarty version 4.3.4, created on 2023-11-22 08:34:26
  from '/Users/stoyantodorov/Desktop/Projects/custom-framework/smarty/templates/test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_655dbd12b42083_31650558',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3edba50ccb8be81f07af132ffe92cf826286bb06' => 
    array (
      0 => '/Users/stoyantodorov/Desktop/Projects/custom-framework/smarty/templates/test.tpl',
      1 => 1700642065,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655dbd12b42083_31650558 (Smarty_Internal_Template $_smarty_tpl) {
?><h1><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8', true);?>
</h1>
<ul>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cities']->value, 'city');
$_smarty_tpl->tpl_vars['city']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['city']->value) {
$_smarty_tpl->tpl_vars['city']->do_else = false;
?>
        <li><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['city']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo $_smarty_tpl->tpl_vars['city']->value['population'];?>
)</li>
        <?php
}
if ($_smarty_tpl->tpl_vars['city']->do_else) {
?>
        <li>no cities found</li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>

<a href="<?php echo urlById('web-test-test');?>
">Link</a><?php }
}
