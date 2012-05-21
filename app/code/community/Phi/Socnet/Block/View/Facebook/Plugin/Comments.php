<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Comments
    extends Phi_Socnet_Block_View_Facebook_Abstract
{

    public function getPluginKey() {
        return 'comments';
    }

    public function getScheme ()
    {
        return $this->getPluginAttributeByKey('colorscheme')->getData('data');
    }

    public function getNumPosts ()
    {
        return $this->getPluginAttributeByKey('num_posts')->getData('data');
    }

    public function getWidth ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
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

    /**
     * (non-PHPdoc)
     * @override
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/comments.phtml";
    }
}
