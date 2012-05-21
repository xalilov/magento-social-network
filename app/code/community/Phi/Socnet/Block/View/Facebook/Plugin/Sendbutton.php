<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Sendbutton
extends Phi_Socnet_Block_View_Facebook_Abstract
{
    public function getPluginKey() {
        return 'send_button';
    }

    public function getScheme ()
    {
        // return "light";
        return "dark";
    }

    public function getFont ()
    {
        // return "segoe ui";
        // return "arial";
        // return "tahoma";
        // return "trebuchet ms";
        return "verdana";
    }

    public function getCurrentUrl ()
    {
        $urlRequest = Mage::app()->getFrontController()->getRequest();
        $urlPart = $urlRequest->getServer('ORIG_PATH_INFO');
        if (is_null($urlPart)) {
            $urlPart = $urlRequest->getServer('PATH_INFO');
        }
        $urlPart = substr($urlPart, 1);
        return $this->getUrl($urlPart);
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/plugins/send-button.phtml";
    }
}
