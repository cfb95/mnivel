<?php /* Smarty version 2.6.26, created on 2013-09-19 23:07:29
         compiled from editors/autocomplete_combo_box.tpl */ ?>
<?php if (! $this->_tpl_vars['ComboBox']->GetReadOnly()): ?>
<?php if ($this->_tpl_vars['RenderText']): ?>
<div id="<?php echo $this->_tpl_vars['ComboBox']->GetName(); ?>
_container" class="dropdown_container" style="width: <?php echo $this->_tpl_vars['ComboBox']->GetSize(); ?>
;">
    <table class="dropdown_button_container" cellpadding="0" cellspacing="0">
        <tr>
            <td class="dropdown_input_container" style="background-color: #fff;">
                <input
                    type="text"
                    id="<?php echo $this->_tpl_vars['ComboBox']->GetName(); ?>
_selector"
                    class="dropdown_input"
                    value="<?php echo $this->_tpl_vars['ComboBox']->GetDisplayValue(); ?>
"
                    data-url="<?php echo $this->_tpl_vars['ComboBox']->GetDataUrl(); ?>
"
                    pgui-autocomplete="true"
                    copy-id-to="#<?php echo $this->_tpl_vars['ComboBox']->GetName(); ?>
"
                    />
                <input
                    type="hidden"
                    id="<?php echo $this->_tpl_vars['ComboBox']->GetName(); ?>
"
                    name="<?php echo $this->_tpl_vars['ComboBox']->GetName(); ?>
"
                    value="<?php echo $this->_tpl_vars['ComboBox']->GetValue(); ?>
"
                    <?php echo $this->_tpl_vars['Validators']['InputAttributes']; ?>

                    />
            </td>
            <td class="dropdown_button_column" style="width:15px;">  </td>
        </tr>
    </table>
</div>
<?php endif; ?>
<?php else: ?>
<?php echo $this->_tpl_vars['ComboBox']->GetDisplayValue(); ?>

<?php endif; ?>