<?php /* Smarty version 2.6.26, created on 2013-09-19 23:08:09
         compiled from inline_operations/grid.tpl */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="utf-8" <?php echo '?>'; ?>

<editors>
<namesuffix><?php echo $this->_tpl_vars['EditorsNameSuffix']; ?>
</namesuffix>
<?php $_from = $this->_tpl_vars['ColumnEditors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['Editors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['Editors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['editor']):
        $this->_foreach['Editors']['iteration']++;
?>
    <editor name="<?php echo $this->_tpl_vars['name']; ?>
">
        <html>
            <![CDATA[
                <?php echo $this->_tpl_vars['editor']['Html']; ?>

            ]]>
        </html>
        <script>
            <![CDATA[
                <?php echo $this->_tpl_vars['editor']['Script']; ?>

            ]]>
        </script>
    </editor>
<?php endforeach; endif; unset($_from); ?>
</editors>