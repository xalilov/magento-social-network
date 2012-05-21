<?php
abstract class Phi_Socnet_Block_View_Plugin_Abstract
    extends Mage_Core_Block_Template
{

    /**
     * @var Phi_Socnet_Model_Plugin
     */
    protected $_model_plugin;

    public function _construct() {
        parent::_construct();
        $this->_model_plugin = Mage::getModel('socnet/plugin')
            ->loadByKey($this->getPluginKey());
        return $this;
    }

    /**
     * Retrieves the all the attributes.
     *
     * @return Phi_Socnet_Model_Mysql4_Attribute_Collection
     */
    public function getPluginAttributes() {
        return $this->getModelPlugin()->getAttributes();
    }

    /**
     * Retrieves the attribute by the key name.
     * @param string $key
     *
     * @return array
     */
    public function getPluginAttributeByKey($key) {
        return $this->getModelPlugin()->getAttributeByKey($key);
    }

    /**
     * Retrieves the model of the current plugin.
     *
     * @return Phi_Socnet_Model_Plugin
     */
    public function getModelPlugin() {
        return $this->_model_plugin;
    }

    /**
     * Retrieves the network configuration.
     *
     * @return stdClass
     */
    public function getConfig ()
    {
        $config = Mage::getModel('socnet/network')
            ->getConfigByNetworkKey($this->getNetworkKey());
        return $config;
    }

    /**
     * Getter for the plugin key.
     *
     * @return string
     */
    abstract function getPluginKey();

    /**
     * Answer if this plugin is enabled.
     * @return boolean
     */
    public function isActive() {
        return $this->getModelPlugin()->isActive($this->getPluginKey());
    }

    /**
     * Retrieve this network key.
     * Getter.
     *
     * @return string
     */
    public function getNetworkKey ()
    {
        return $this->getModelPlugin()->getNetworkKey();
    }

    public function setLayout(Mage_Core_Model_Layout $layout) {
        $out = parent::setLayout($layout);
        $view = new Phi_Socnet_Block_View($this->getNetworkKey());
        Mage::dispatchEvent(Phi_Socnet_Helper_Data::EVENT_LOADED_PLUGIN,
                array('view'=>$view)
        );
        return $out;
    }
}