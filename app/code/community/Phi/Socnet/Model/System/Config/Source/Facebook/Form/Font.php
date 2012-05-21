<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Font {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                'arial' => array('value' => 'arial',
                        'label' => Mage::helper('socnet')->__('Arial')),
                'lucida_grande' => array('value' => 'lucida grande',
                        'label' => Mage::helper('socnet')->__('Lucida Grande')),
                'segoe_ui' => array('value' => 'segoe ui',
                        'label' => Mage::helper('socnet')->__('Segoe UI')),
                'tahoma' => array('value' => 'tahoma',
                        'label' => Mage::helper('socnet')->__('Tahoma')),
                'trebuchet_ms' => array('value' => 'trebuchet ms',
                        'label' => Mage::helper('socnet')->__('Trebuchet MS')),
                'verdana' => array('value' => 'verdana',
                        'label' => Mage::helper('socnet')->__('Verdana')),
        );
    }
    
}
