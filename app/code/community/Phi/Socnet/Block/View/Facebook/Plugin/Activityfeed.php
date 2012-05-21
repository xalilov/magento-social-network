<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Activityfeed
    extends Phi_Socnet_Block_View_Facebook_Abstract
{

    public function getPluginKey() {
        return 'activity_feed';
    }

    public function getShowHeader ()
    {
        return ($this->getPluginAttributeByKey('header')->getData('data'))
            ? "true" : "false";
    }

    public function getBorderColor ()
    {
        return $this->getPluginAttributeByKey('border_color')->getData('data');
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

    public function getScheme ()
    {
        return $this->getPluginAttributeByKey('colorscheme')->getData('data');
    }

    public function getLinkTarget ()
    {
        return $this->getPluginAttributeByKey('linktarget')->getData('data');
    }

    public function getShowFilters ()
    {
        $f = $this->getFilter();
        return (! empty($f));
    }

    public function getFilter()
    {
        return $this->getPluginAttributeByKey('filter')->getData('data');
    }

    public function getShowRecomendations ()
    {
        return $this->getPluginAttributeByKey('recommendations')
            ->getData('data');
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

    /**
     * (non-PHPdoc)
     * @override
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/activity-feed.phtml";
    }

    public function getAppId() {
        return $this->getConfig()->getId();
    }
}
