<?php
class Phi_Socnet_Block_View_Facebook_Create extends Mage_Core_Block_Template
{
    /**
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/create.phtml";
    }

    public function getAppId() {
        return $this->getConfig()->getId();
    }

    public function getAppLang() {
        return $this->getConfig()->getLocale();
    }

    private function getConfig() {
        return Mage::getModel('socnet/network')
        ->getConfigByNetworkKey('facebook');

    }
}
