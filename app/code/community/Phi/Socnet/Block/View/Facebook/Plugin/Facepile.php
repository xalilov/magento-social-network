<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Facepile
extends Phi_Socnet_Block_View_Facebook_Abstract
{
    public function getPluginKey() {
        return 'facepile';
    }

    public function getCurrentUrl ()
    {
        $url = $this->getPluginAttributeByKey('href')->getData('data');
        if(empty($url)) {
            $urlRequest = Mage::app()->getFrontController()->getRequest();
            $urlPart = $urlRequest->getServer('ORIG_PATH_INFO');
            if (is_null($urlPart)) {
                $urlPart = $urlRequest->getServer('PATH_INFO');
            }
            $urlPart = substr($urlPart, 1);
            $url = $this->getUrl($urlPart);
        }

        return $url;
    }

    public function getShowActions ()
    {
        $a = $this->getActions();
        return (bool) (! empty($a));
    }

    public function getActions ()
    {
        return $this->getPluginAttributeByKey('action')->getData('data');
    }

    public function getWidth ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    public function getScheme ()
    {
        return $this->getPluginAttributeByKey('colorscheme')->getData('data');
    }

    public function getMaxRows() {
        return $this->getPluginAttributeByKey('max_rows')->getData('data');
    }

    public function getSize() {
        return $this->getPluginAttributeByKey('size')->getData('data');
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/facepile.phtml";
    }
}
