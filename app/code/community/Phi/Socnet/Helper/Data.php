<?php

class Phi_Socnet_Helper_Data extends Mage_Core_Helper_Abstract
{
    const PHI_PREFIX = 'phi';

    const FACEBOOK_CHANNEL = 'socnet/facebook/channel.html';
    const FACEBOOK_XFBML_MODE = 'xfbml';
    const FACEBOOK_HTML5_MODE = 'html5';
    const FACEBOOK_IFRAME_MODE = 'iframe';
    const FACEBOOK_PRODUCT = 'product';
    const FACEBOOK_CATEGORY = 'article';
    const FACEBOOK_SITE = 'website';

    const PRODUCT = 'Product';
    const CATEGORY = 'Category';
    const HOMEPAGE = 'Homepage';

    const EVENT_LOADED_PLUGIN = 'phi_socnet_event_plugin_loaded';

    public function getFbmlNs ()
    {
        return <<< NS
xmlns:fb="https://www.facebook.com/2008/fbml"
NS;
    }

    public function getOpenGraphNs ()
    {
        return <<< NS
xmlns:og="http://ogp.me/ns#"
NS;
    }

    public function getValidNetworks() {
        return Mage::getModel('socnet/network')->getKeys();
    }

    public function getCreateAccountFields($network) {
        $validKeys = $this->getValidNetworks();
        if(in_array($network,$validKeys->getData())) {
            $collection =
                Mage::getModel('socnet/system_config_source_facebook_account_field')
                ->asJson();
        }
        return $collection;
    }

    public function getFacebookLibConfig() {
        $c = Mage::getModel('socnet/network')->getConfigByNetworkKey('facebook');
        $config = array();
        $config['appId'] = $c->getId();
        $config['secret'] = $c->getSecret();
        $config['fileUpload'] = $c->getFileUpload();
        return $config;
    }

    public function responseFromFacebook() {
        $config = $this->getFacebookLibConfig();
        $lib = Phi_Socnet_Lib_Factory::getInstance()->getLib('facebook', $config);
        $response = $lib->getSignedRequest();
        if($this->verifyFacebookResponse($response)) {
            return $response;
        }
        return null;
    }

    public function isValidNetwork($networkKey) {
        return (bool) in_array($networkKey, $this->getValidNetworks()->getData());
    }

    private function verifyFacebookResponse($response) {
        if(!Mage::app()->getRequest()->isPost()) {
            return true;
        }
        $fields =
            Mage::getModel('socnet/system_config_source_facebook_account_field')
            ->toOptionArray();
        $resp = json_decode($response['registration_metadata']['fields']);
        return (serialize($resp) === serialize(array_values($fields)));
    }

    public function normalizeData($response) {
        $fields =
        Mage::getModel('socnet/system_config_source_facebook_account_field')
        ->toOptionArray();
        foreach($fields as $key=>$field) {
            if(isset($response[$field->name])) {
                $data[$key] = $response[$field->name];
            }
        }

        return $data;
    }

}