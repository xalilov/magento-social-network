<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Loginbutton
    extends Phi_Socnet_Block_View_Facebook_Abstract
{
    public function getPluginKey() {
        return 'login_button';
    }

    public function getDataMaxRows ()
    {
        return $this->getPluginAttributeByKey('max_rows')->getData('data');;
    }

    public function getWidth ()
    {
//         return 300;
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    public function getShowFaces ()
    {
        return $this->getPluginAttributeByKey('show_faces')->getData('data');
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return 'phi/socnet/facebook/plugins/login-button.phtml';
    }

    public function getRegisterUrl() {
        return Mage::helper('customer')->getRegisterUrl();
    }

    public function showRegistration() {
         return $this->getPluginAttributeByKey('registration')->getData('data');;
    }
}
