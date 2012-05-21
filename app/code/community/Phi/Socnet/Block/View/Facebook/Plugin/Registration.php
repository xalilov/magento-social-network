<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Registration
    extends Phi_Socnet_Block_View_Facebook_Abstract
{
    public function getPluginKey() {
        return 'registration';
    }

    public function getFields ()
    {
        $atts = Mage::getModel( 'customer/attribute')->getResourceCollection();
        return Mage::helper('socnet')->getCreateAccountFields($this->getNetworkKey());
    }

    public function getRedirectUrl ()
    {
        $url = '';
        if($this->getPluginAttributeByKey('registration_form_prefill')
                ->getData('data') === 'true') {
            $url = Mage::helper('customer')->getRegisterUrl();
        } else {
            $url=Mage::helper('customer')->getRegisterPostUrl();
            $url = $url . ((strpos($url,'?') !== false) ? "&":"?")."network=facebook";
        }
        return $url;
    }

    public function getWidth ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/registration.phtml";
    }
}
