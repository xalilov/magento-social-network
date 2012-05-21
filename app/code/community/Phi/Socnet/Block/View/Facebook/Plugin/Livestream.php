<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Livestream
    extends Phi_Socnet_Block_View_Facebook_Abstract
{
    private $_xid;

    public function getPluginKey() {
        return 'live_stream';
    }

    /**
     * @param string Id of the rendered plugin.
     */
    public function setXid($xid) {
        $this->_xid = $xid;
    }

    /**
     * @return string
     */
    public function getXid ()
    {
        if($this->_xid) {
            return $this->_xid;
        }
        return md5(Mage::getBaseUrl());
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
        $url = $this->getPluginAttributeByKey('via_url')->getData('data');
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

    public function getAlwaysPostToFriends ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/live-stream.phtml";
    }
}
