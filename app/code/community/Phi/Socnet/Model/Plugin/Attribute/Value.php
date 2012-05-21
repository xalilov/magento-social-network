<?php
/**
 * Description of Value
 *
 * @author chervox
 */
class Phi_Socnet_Model_Plugin_Attribute_Value extends Mage_Core_Model_Abstract {

    public function _construct ()
    {
        $this->_init('socnet/plugin_attribute_value');
    }

    public function loadByAttributePluginKey($attribute_key, $plugin_key) {
        $id = $this->_getResource()
                ->loadByAttributePluginKey($attribute_key, $plugin_key);
        if(!$id) {
            Mage::exception('Phi_Socnet', 'Not attribute found with this keys '
                    . $attribute_key .' and ' . $plugin_key);
        }

        return $this->load($id);

    }
}