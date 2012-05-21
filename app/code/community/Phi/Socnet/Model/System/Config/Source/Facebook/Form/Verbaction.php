<?php
/**
 * Description of Font
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form_Verbaction {
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                'like' => array('value' => 'like',
                        'label' => Mage::helper('socnet')->__('Like')),
                'recommend' => array('value' => 'recommend',
                        'label' => Mage::helper('socnet')->__('Recommend')),
        );
    }
    
}
