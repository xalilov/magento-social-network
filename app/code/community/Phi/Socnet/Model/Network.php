<?php

class Phi_Socnet_Model_Network extends Mage_Core_Model_Abstract
{

    const FACEBOOK_NETWORK_KEY = 'facebook';
    const GOOGLE_NETWORK_KEY = 'google';
    const TWITTER_NETWORK_KEY = 'twitter';

    private static $config = array(
            'facebook' => array(
                    'enabled' => 'phi_socnet/facebook/enabled',
                    'id' => 'phi_socnet/facebook/appid',
                    'secret' => 'phi_socnet/facebook/appsecret',
                    'locale' => 'phi_socnet/facebook/locale',
                    'graph' => 'phi_socnet/facebook/graph'
            ),
    );

    public function _construct ()
    {
        parent::_construct();
        $this->_init('socnet/network');
    }

    /**
     * Retrieves all configuration.
     * @return Varien_Object
     */
    public function getConfig() {
        if(!$config = Mage::registry('Phi.Socnet.Config')) {
            $config = $this->_buildConfig(self::$config);
            Mage::register('Phi.Socnet.Config', $config);
        }
        return Mage::registry('Phi.Socnet.Config');
    }

    /**
     * Retrieves a configuration object based on the network key.
     * @param string $network_key
     * @return Varien_Object
     */
    public function getConfigByNetworkKey($networkKey) {
        $type = ucfirst(strtolower($networkKey));

        if(!$config = Mage::registry('Phi.Socnet.Config')) {
            $config = $this->getConfig();
        }
        $method = 'get'.$type;

        return $config->{$method}();
    }

    /**
     * Recursive function to build a config object based on Varien_Object.
     *
     * @param array $data
     * @param Varien_Object $config
     * @return Varien_Object
     */
    private function _buildConfig($data) {
        $config = new Varien_Object;
        foreach($data as $key=>$value){
            if (is_array($value)){
                $config->setData($key,$this->_buildConfig($value));
            }else{
                $config->setData($key,Mage::getStoreConfig($value));
            }
        }
        return $config;
    }

    /**
     * Retrieve all active network keys.
     * @return Varien_Object
     */
    public function getKeys() {
        return $this->getResource()->getKeys();
    }
}