<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Subscribebutton
extends Phi_Socnet_Block_View_Facebook_Abstract
{
    public function getPluginKey() {
        return 'subscribe_button';
    }

    public function getFont ()
    {
        return $this->getPluginAttributeByKey('font')->getData('data');
    }

    public function getScheme ()
    {
        return $this->getPluginAttributeByKey('colorscheme')->getData('data');
    }

    public function getFbLayout ()
    {
        return $this->getPluginAttributeByKey('layout')->getData('data');
    }

    public function getWidth ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    public function getShowFaces ()
    {
        return (($this->getPluginAttributeByKey('show_faces')
            ->getData('data')) ? "yes" : "no");
    }

    public function getCurrentUrl ()
    {
        return $this->getPluginAttributeByKey('profile')->getData('data');
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/subscribe-button.phtml";
    }
}
