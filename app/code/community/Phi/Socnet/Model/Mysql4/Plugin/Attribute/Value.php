<?php
/**
 * Description of Value
 *
 * @author chervox
 */
class Phi_Socnet_Model_Mysql4_Plugin_Attribute_Value 
    extends Mage_Core_Model_Mysql4_Abstract {
    
    public function _construct ()
    {
        $this->_init('socnet/plugin_attribute_value','value_id');
    }
    
    public function loadByAttributePluginKey($attribute_key, $plugin_key) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getMainTable())
                ->where('plugin_key=?',$plugin_key)
                ->where('attribute_key=?',$attribute_key);
        return $this->_getReadAdapter()->fetchOne($select);
    }
}