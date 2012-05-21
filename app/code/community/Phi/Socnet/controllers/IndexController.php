<?php

class Phi_Socnet_IndexController extends Mage_Core_Controller_Front_Action
{
    public function channelAction() {
        Mage::log("Called channel action.");
        $protocol = (Mage::app()->getStore()->isCurrentlySecure())
            ? 'https' : 'http';
        $cache_expire = 60*60*24*365;
        $this->getResponse()->setHeader("Pragma", "public");
        $this->getResponse()->setHeader("Cache-Control: max-age",$cache_expire);
        $this->getResponse()->setHeader('Expires',
                gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
        $this->getResponse()->setBody('<script src="'.$protocol
            .'://connect.facebook.net/en_US/all.js"></script>');
    }

    public function getUserAction() {
        if ($this->getRequest()->isAjax()) {
            $url = Mage::helper('core/http')->getHttpReferer();

            $response = new stdClass;
            $response->loggedin = false;
            $response->referer = false;
            $user = $this->getUser();
            if ($this->_isUrlInternal($url)
                    && $url !== Mage::helper('customer')->getLogoutSuccessUrl()) {
                $response->referer = $url;
            } else {
                $response->referer = Mage::helper('customer')->getDashboardUrl();
            }
            if(!is_null($user)) {
                $response->loggedin = true;
            }
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode($response,true));
        } else {
            $this->getResponse()->setRedirect('/no-route.html');
        }
    }

    private function getUser() {
        $user = null;
        if (Mage::app()->isInstalled() &&
                Mage::getSingleton('customer/session')->isLoggedIn()) {
            $user =
                Mage::getSingleton('customer/session')->getCustomer();
        }
        return $user;
    }
}