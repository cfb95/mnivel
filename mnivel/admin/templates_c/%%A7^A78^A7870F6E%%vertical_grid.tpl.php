<?php /* Smarty version 2.6.26, created on 2013-09-10 11:01:48
         compiled from insert/vertical_grid.tpl */ ?>
<div vertical-grid="true" align="center" style="width: 100%">
    <form
        validate="true"
        name="insertform"
        id="insertform"
        enctype="multipart/form-data"
        method="POST"
        action="<?php echo $this->_tpl_vars['Grid']->GetModalInsertPageAction(); ?>
"
    >
        <input type="hidden" name="edit_operation" value="commit_insert" />
        <?php $_from = $this->_tpl_vars['HiddenValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['HiddenValueName'] => $this->_tpl_vars['HiddenValue']):
?>
        <input type="hidden" name="<?php echo $this->_tpl_vars['HiddenValueName']; ?>
" value="<?php echo $this->_tpl_vars['HiddenValue']; ?>
" />
        <?php endforeach; endif; unset($_from); ?>

        <div class="error-message-container"></div>

        <table class="grid edit-grid" style="width: auto">
<?php $_from = $this->_tpl_vars['Grid']->GetInsertColumns(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['Columns'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['Columns']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['column']):
        $this->_foreach['Columns']['iteration']++;
?>

            <tr class="<?php if (!(1 & ($this->_foreach['Columns']['iteration']-1))): ?>even<?php else: ?>odd<?php endif; ?>">

                                <td class="even labels-column">
                        <?php echo $this->_tpl_vars['column']->GetCaption(); ?>

                        <?php if (! $this->_tpl_vars['column']->GetAllowSetToNull()): ?>
                            <span class="required-mark">*</span>
                        <?php endif; ?>
                </td>
                
                                <td class="odd editors-column"><?php echo $this->_tpl_vars['Renderer']->Render($this->_tpl_vars['column']); ?>
</td>
                
                <td class="odd set-null-column">
                <?php if ($this->_tpl_vars['column']->GetShowSetToNullCheckBox()): ?>
                    <input
                        type="checkbox"
                        value="1"
                        id="<?php echo $this->_tpl_vars['column']->GetFieldName(); ?>
_null"
                        name="<?php echo $this->_tpl_vars['column']->GetFieldName(); ?>
_null"<?php if ($this->_tpl_vars['column']->IsValueNull()): ?>
                        checked="checked"<?php endif; ?>/>
                        <?php echo $this->_tpl_vars['Captions']->GetMessageString('SetNull'); ?>

                <?php endif; ?>
                </td>
                
                <td class="odd set-default-column">
                <?php if ($this->_tpl_vars['column']->GetAllowSetToDefault()): ?>
                    <input
                        type="checkbox"
                        value="1"
                        name="<?php echo $this->_tpl_vars['column']->GetFieldName(); ?>
_def"
                        id="<?php echo $this->_tpl_vars['column']->GetFieldName(); ?>
_def"/>
                        <?php echo $this->_tpl_vars['Captions']->GetMessageString('SetDefault'); ?>

                <?php endif; ?>
                </td>
            </tr>
<?php endforeach; endif; unset($_from); ?>

            <tr class="editor_buttons">
                <td colspan="4" style="text-align: left" valign="middle">
                    <span class="required-mark">*</span> - <?php echo $this->_tpl_vars['Captions']->GetMessageString('RequiredField'); ?>

                </td>
            </tr>
            
        </table>
    </form>
</div>