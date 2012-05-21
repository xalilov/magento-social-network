<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Layout {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                'standard' => array('value' => 'standard',
                        'label' => Mage::helper('socnet')->__('Standard')),
                'button_count' => array('value' => 'button_count',
                        'label' => Mage::helper('socnet')->__('Button Count')),
                'button_box' => array('value' => 'button_box',
                        'label' => Mage::helper('socnet')->__('Button Box')),
        );
    }
    
}
