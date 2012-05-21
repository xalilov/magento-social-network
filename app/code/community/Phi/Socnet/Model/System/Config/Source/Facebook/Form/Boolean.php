<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Boolean {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'true', 'label'=>Mage::helper('adminhtml')->__('True')),
            array('value' => 'false', 'label'=>Mage::helper('adminhtml')->__('False')),
        );
    }

}
