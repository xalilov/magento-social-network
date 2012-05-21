<?php

class Phi_Socnet_Page_Homepage extends Phi_Socnet_Page_Abstract
{
    /**
     * Gets the description of the site provided in the admin.
     *
     * @return string
     */
    protected function getMetaDescription() {
        return Mage::getStoreConfig('design/head/default_description');
    }

    protected function getPageMetas ()
    {
        $view = $this->getView();
        $metas = $this->getMetasCollection();
        $head = $this->getLayout()->getBlock('head');
        if(!$head) { return false; }
        $metas['title']['data'] = $head->getTitle();
        if (empty($metas['title']['data'])) {
            $metas['title']['data'] = Mage::app()->getWebsite()->getName();
        }
        $metas['description']['data'] = $head->getDescription();
        if (empty($metas['description']['data'])) {
            $metas['description']['data'] = $this->getMetaDescription();
        }
        $metas['type']['data'] = Phi_Socnet_Helper_Data::FACEBOOK_SITE;
        $metas['appid']['data'] = $this->getConfig()->getId();
        $metas['name']['data'] = Mage::app()->getStore()->getFrontendName();
        $metas['image']['data'] = $this->_getLogoFile();
        $metas['url']['data'] = rtrim(Mage::getBaseUrl(), '/');

        return $metas;
    }

    /**
     * Find the url for the logo uploaded in the admin.
     * @return string
     */
    protected function _getLogoFile()
    {
        $url = null;
        $folderName =
            Phi_Socnet_Model_System_Config_Source_Facebook_Backend_Logo::UPLOAD_DIR;
        $storeConfig = Mage::getStoreConfig('phi_socnet/facebook/logo_src');
        $url = rtrim(Mage::getBaseUrl('media'),'/') . '/' . $folderName . '/' .
                $storeConfig;

        if(is_null($url)) {
            Mage::log("There's no file to upload to Facebook.");
        }
        return $url;
    }

}