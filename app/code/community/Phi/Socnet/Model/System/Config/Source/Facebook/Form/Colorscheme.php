<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Colorscheme {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                'light' => array('value' => 'light',
                        'label' => Mage::helper('socnet')->__('Light')),
                'dark' => array('value' => 'dark',
                        'label' => Mage::helper('socnet')->__('Dark')),
        );
    }
    
}
