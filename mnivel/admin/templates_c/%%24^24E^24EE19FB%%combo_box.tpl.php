<?php /* Smarty version 2.6.26, created on 2013-09-19 23:07:42
         compiled from editors/combo_box.tpl */ ?>
<?php if ($this->_tpl_vars['RenderText']): ?>
<?php if (! $this->_tpl_vars['ComboBox']->GetReadOnly()): ?><select id="<?php echo $this->_tpl_vars['ComboBox']->GetName(); ?>
" name="<?php echo $this->_tpl_vars['ComboBox']->GetName(); ?>
" <?php echo $this->_tpl_vars['Validators']['InputAttributes']; ?>
>
<?php if ($this->_tpl_vars['ComboBox']->ShowEmptyValue()): ?>
    <option value=""><?php echo $this->_tpl_vars['ComboBox']->GetEmptyValue(); ?>
</option>
<?php endif; ?>
<?php if ($this->_tpl_vars['ComboBox']->HasMFUValues()): ?>
<?php $_from = $this->_tpl_vars['ComboBox']->GetMFUValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Value'] => $this->_tpl_vars['Name']):
?>
<option value="<?php echo $this->_tpl_vars['Value']; ?>
"><?php echo $this->_tpl_vars['Name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
<option value="----------" disabled="disabled">----------</option>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['ComboBox']->GetDisplayValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Value'] => $this->_tpl_vars['Name']):
?>
    <option value="<?php echo $this->_tpl_vars['Value']; ?>
"<?php if ($this->_tpl_vars['ComboBox']->GetSelectedValue() == $this->_tpl_vars['Value']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select><?php else: ?>
<?php $_from = $this->_tpl_vars['ComboBox']->GetValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Value'] => $this->_tpl_vars['Name']):
?>
<?php if ($this->_tpl_vars['ComboBox']->GetSelectedValue() == $this->_tpl_vars['Value']): ?><?php echo $this->_tpl_vars['Name']; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php endif; ?>