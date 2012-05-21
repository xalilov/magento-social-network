<?php

class Phi_Socnet_Model_System_Config_Source_Facebook_Locale
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                array('value' => 'en_US',
                        'label' => Mage::helper('socnet')->__(
                                'American English')),
                array('value' => 'es_ES',
                        'label' => Mage::helper('socnet')->__('Spanish')),
                array('value' => 'es_LA',
                        'label' => Mage::helper('socnet')->__('Spanish Latam')));
    }
}