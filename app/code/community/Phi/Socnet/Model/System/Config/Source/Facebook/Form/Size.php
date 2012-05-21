<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Size {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'small', 'label'=>Mage::helper('adminhtml')->__('Small')),
            array('value' => 'medium', 'label'=>Mage::helper('adminhtml')->__('Medium')),
            array('value' => 'large', 'label'=>Mage::helper('adminhtml')->__('Large')),
            );
    }

}
