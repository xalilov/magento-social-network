<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Mobile {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                'auto-detect' => array('value' => 'auto-detect',
                        'label' => Mage::helper('socnet')->__('Auto Detect')),
                'true' => array('value' => 'true',
                        'label' => Mage::helper('socnet')->__('True')),
                'false' => array('value' => 'false',
                        'label' => Mage::helper('socnet')->__('False')),
        );
    }
    
}
