<?php /* Smarty version 2.6.26, created on 2013-09-19 23:07:28
         compiled from hinted_text_box.tpl */ ?>
<span class="hinted_header"><span <?php if ($this->_tpl_vars['TextBox']->GetHint() != ''): ?>style="border-bottom: 1px dotted;"<?php endif; ?>><?php echo $this->_tpl_vars['TextBox']->GetInnerText(); ?>
</span>
<div class="box_hidden_header" style="display: none;"><?php echo $this->_tpl_vars['TextBox']->GetHint(); ?>
</div>
</span><?php echo $this->_tpl_vars['TextBox']->GetAfterLinkText(); ?>
