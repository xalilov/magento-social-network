<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Likebox extends Phi_Socnet_Block_View_Facebook_Abstract
{

    public function getPluginKey() {
        return 'like_box';
    }

    public function getShowHeader ()
    {
        return (($this->getPluginAttributeByKey('header')
            ->getData('data')) ? "yes" : "no");
    }

    public function getWidth ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    public function getHeight ()
    {
        return $this->getPluginAttributeByKey('height')->getData('data');
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

    public function getScheme ()
    {
        return $this->getPluginAttributeByKey('colorscheme')->getData('data');
    }

    public function getForceWall ()
    {
        return $this->getPluginAttributeByKey('force_wall')->getData('data');
    }

    public function getShowFaces ()
    {
        return (($this->getPluginAttributeByKey('show_faces')
            ->getData('data')) ? "yes" : "no");
    }

    public function getStream ()
    {
        return $this->getPluginAttributeByKey('stream')->getData('data');
    }

    public function getBorderColor ()
    {
        return $this->getPluginAttributeByKey('border_color')->getData('data');
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/like-box.phtml";
    }
}