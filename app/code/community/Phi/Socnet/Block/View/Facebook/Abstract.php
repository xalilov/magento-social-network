<?php

abstract class Phi_Socnet_Block_View_Facebook_Abstract
    extends Phi_Socnet_Block_View_Plugin_Abstract
{
    /**
     * Retrieves the mode in what we will use the plugins.
     * Possible values are: xfbml, html5, iframe.
     *
     * @return string
     */
    public function getMode ()
    {
        return Mage::getStoreConfig('phi_socnet/facebook/mode');
    }

    public function isCustomerLoggedIn() {
        return (bool)Mage::getSingleton('customer/session')->isLoggedIn();
    }
}
