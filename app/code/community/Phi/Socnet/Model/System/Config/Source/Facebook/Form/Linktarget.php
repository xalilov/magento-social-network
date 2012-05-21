<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Linktarget {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                '_blank' => array('value' => '_blank',
                        'label' => Mage::helper('socnet')->__('_blank')),
                '_top' => array('value' => '_top',
                        'label' => Mage::helper('socnet')->__('_top')),
                '_parent' => array('value' => '_parent',
                        'label' => Mage::helper('socnet')->__('_parent')),
        );
    }
    
}
