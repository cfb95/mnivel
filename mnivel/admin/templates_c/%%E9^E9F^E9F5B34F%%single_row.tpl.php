<?php /* Smarty version 2.6.26, created on 2013-09-10 11:03:44
         compiled from list/single_row.tpl */ ?>
<?php echo ''; ?><?php if (count ( $this->_tpl_vars['Rows'] ) > 0): ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['Rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['RowsGrid'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['RowsGrid']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Row']):
        $this->_foreach['RowsGrid']['iteration']++;
?><?php echo '<tr class="'; ?><?php if (!(1 & ($this->_foreach['RowsGrid']['iteration']-1))): ?><?php echo 'even'; ?><?php else: ?><?php echo 'odd'; ?><?php endif; ?><?php echo '"'; ?><?php if ($this->_tpl_vars['RowCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)] != ''): ?><?php echo ' style="'; ?><?php echo $this->_tpl_vars['RowCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)]; ?><?php echo '"'; ?><?php endif; ?><?php echo '>'; ?><?php if ($this->_tpl_vars['ShowLineNumbers']): ?><?php echo '<td class="odd pgui-line-number"></td>'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['AllowDeleteSelected']): ?><?php echo ''; ?><?php echo '<td class="odd" '; ?><?php if ($this->_tpl_vars['RowCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)] != ''): ?><?php echo ' style="'; ?><?php echo $this->_tpl_vars['RowCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)]; ?><?php echo '"'; ?><?php endif; ?><?php echo '><input type="checkbox" name="rec'; ?><?php echo ($this->_foreach['RowsGrid']['iteration']-1); ?><?php echo '" id="rec'; ?><?php echo ($this->_foreach['RowsGrid']['iteration']-1); ?><?php echo '" />'; ?><?php $_from = $this->_tpl_vars['RowPrimaryKeys'][($this->_foreach['RowsGrid']['iteration']-1)]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['CPkValues'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['CPkValues']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['PkValue']):
        $this->_foreach['CPkValues']['iteration']++;
?><?php echo '<input type="hidden" name="rec'; ?><?php echo ($this->_foreach['RowsGrid']['iteration']-1); ?><?php echo '_pk'; ?><?php echo ($this->_foreach['CPkValues']['iteration']-1); ?><?php echo '" value="'; ?><?php echo $this->_tpl_vars['PkValue']; ?><?php echo '" />'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</td>'; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['Row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['RowColumns'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['RowColumns']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['RowColumn']):
        $this->_foreach['RowColumns']['iteration']++;
?><?php echo ''; ?><?php echo '<td data-column-name="'; ?><?php echo $this->_tpl_vars['ColumnsNames'][($this->_foreach['RowColumns']['iteration']-1)]; ?><?php echo '" char="'; ?><?php echo $this->_tpl_vars['RowColumnsChars'][($this->_foreach['RowsGrid']['iteration']-1)][($this->_foreach['RowColumns']['iteration']-1)]; ?><?php echo '" class="'; ?><?php if (!(1 & ($this->_foreach['RowColumns']['iteration']-1))): ?><?php echo 'even'; ?><?php else: ?><?php echo 'odd'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['RowColumnsCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)][($this->_foreach['RowColumns']['iteration']-1)] != ''): ?><?php echo 'style="'; ?><?php echo $this->_tpl_vars['RowColumnsCssStyles'][($this->_foreach['RowsGrid']['iteration']-1)][($this->_foreach['RowColumns']['iteration']-1)]; ?><?php echo '"'; ?><?php endif; ?><?php echo '>'; ?><?php echo $this->_tpl_vars['RowColumn']; ?><?php echo '</td>'; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo '</tr><tr pgui-details="true" style="border: none; height: 0px;"><td colspan="'; ?><?php echo $this->_tpl_vars['ColumnCount']; ?><?php echo '" style="border: none; padding: 0px; height: 0px;">'; ?><?php $_from = $this->_tpl_vars['AfterRows'][($this->_foreach['RowsGrid']['iteration']-1)]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['AfterRow']):
?><?php echo ''; ?><?php echo $this->_tpl_vars['AfterRow']; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo '</td></tr>'; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>