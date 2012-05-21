<?php

class Phi_Socnet_Model_System_Config_Source_Facebook_Mode
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                array('value' => Phi_Socnet_Helper_Data::FACEBOOK_XFBML_MODE,
                       'label' => Mage::helper('socnet')->__('XFBML')),
                array('value' => Phi_Socnet_Helper_Data::FACEBOOK_HTML5_MODE,
                        'label' => Mage::helper('socnet')->__('Html 5')),
                array('value' => Phi_Socnet_Helper_Data::FACEBOOK_IFRAME_MODE,
                        'label' => Mage::helper('socnet')->__('Iframe')));
    }
}