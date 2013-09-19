<?php /* Smarty version 2.6.26, created on 2013-09-19 23:07:42
         compiled from editors/check_box.tpl */ ?>
<?php if ($this->_tpl_vars['RenderText']): ?>
<?php if (! $this->_tpl_vars['CheckBox']->GetReadOnly()): ?>
<input type="checkbox" name="<?php echo $this->_tpl_vars['CheckBox']->GetName(); ?>
" id="<?php echo $this->_tpl_vars['CheckBox']->GetName(); ?>
" value="on" <?php if ($this->_tpl_vars['CheckBox']->Checked()): ?> checked="checked"<?php endif; ?> <?php echo $this->_tpl_vars['Validators']['InputAttributes']; ?>
>
<?php else: ?>
<?php if ($this->_tpl_vars['CheckBox']->Checked()): ?>
<img src="images/checked.png" />
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>