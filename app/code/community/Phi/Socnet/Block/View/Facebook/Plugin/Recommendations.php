<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Recommendations
    extends Phi_Socnet_Block_View_Facebook_Abstract
{

    public function getPluginKey() {
        return 'recommendations';
    }

    public function getShowHeader ()
    {
        return ($this->getPluginAttributeByKey('header')->getData('data'))
            ? "true" : "false";
    }

    public function getWidth ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    public function getHeight ()
    {
        return "200";
    }

    public function getScheme ()
    {
        return $this->getPluginAttributeByKey('colorscheme')->getData('data');
    }

    public function getLinkTarget ()
    {
        // return "_top";
        // return "_blank";
        return "_parent";
    }

    public function getShowReferer ()
    {
        $r = $this->getRefererParameter();
        return (bool) (! empty($r));
    }

    public function getRefererParameter ()
    {
        return $this->getPluginAttributeByKey('ref')->getData('data');
    }

    public function getBorderColor ()
    {
        return "#CECECE";
    }

    public function getShowMaxAge ()
    {
        $age = $this->getMaxAge();
        return (! empty($age));
    }

    public function getMaxAge ()
    {
        return "";
        return "20";
    }

    public function getActions ()
    {
        return $this->getPluginAttributeByKey('action')->getData('data');
    }

    public function getAppId() {
        return $this->getConfig()->getId();
    }

    public function getCurrentUrl ()
    {
        $url = $this->getPluginAttributeByKey('site')->getData('data');
        if(empty($url)) {
            $urlRequest = Mage::app()->getFrontController()->getRequest();
            $urlPart = $urlRequest->getServer('ORIG_PATH_INFO');
            if (is_null($urlPart)) {
                $urlPart = $urlRequest->getServer('PATH_INFO');
            }
            $urlPart = substr($urlPart, 1);
            $url = $this->getUrl($urlPart);
        }
        $url = explode('://', rtrim($url,'/'));
        $url = array_pop($url);

        return $url;
    }

    public function getFont ()
    {
        return $this->getPluginAttributeByKey('font')->getData('data');
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return 'phi/socnet/facebook/plugins/recommendations.phtml';
    }
}
