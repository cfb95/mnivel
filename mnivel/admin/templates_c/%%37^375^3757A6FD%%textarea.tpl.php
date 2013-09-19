<?php /* Smarty version 2.6.26, created on 2013-09-19 23:07:42
         compiled from editors/textarea.tpl */ ?>
<?php if (! $this->_tpl_vars['TextArea']->GetReadOnly()): ?><textarea id="<?php echo $this->_tpl_vars['TextArea']->GetName(); ?>
" name="<?php echo $this->_tpl_vars['TextArea']->GetName(); ?>
" <?php if ($this->_tpl_vars['TextArea']->GetColumnCount() != null): ?> cols="<?php echo $this->_tpl_vars['TextArea']->GetColumnCount(); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['TextArea']->GetRowCount() != null): ?> rows="<?php echo $this->_tpl_vars['TextArea']->GetRowCount(); ?>
"<?php endif; ?> <?php echo $this->_tpl_vars['Validators']['InputAttributes']; ?>
><?php echo $this->_tpl_vars['TextArea']->GetValue(); ?>
</textarea><?php else: ?>
<?php echo $this->_tpl_vars['TextArea']->GetValue(); ?>

<?php endif; ?>