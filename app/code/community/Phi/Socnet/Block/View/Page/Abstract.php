<?php
abstract class Phi_Socnet_Block_View_Page_Abstract {

    /**
     * Configuration for this network block.
     *
     * @var stdClass
     */
    private $config;

    /**
     * Block
     * @var Phi_Socnet_Block_View
     */
    private $block;

    /**
     * Setter.
     * @param Varien_Object $config
     */
    public function setConfig (Varien_Object $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * Getter.
     * @return Varien_Object
     */
    public function getConfig ()
    {
        return $this->config;
    }

    /**
     * Retrieve the meta tags for describing the current page
     * on the social network.
     *
     * @return ArrayObject
     */
    abstract public function getMetaTags ();

    /**
     * Retrieve the array of metas needed for Open Graph.
     *
     * @see Phi_Socnet_Model_System_Config_Source_Facebook_Graph_Meta::toOptionArray()
     * @return ArrayObject
     */
    protected function getMetasCollection ()
    {
        return new ArrayObject(Mage::getSingleton(
                'socnet/system_config_source_facebook_graph_meta')
                ->toOptionArray());
    }

    /**
     * Retrieve the current category if any.
     * Getter.
     * @return Mage_Catalog_Model_Category
     */
    public function getCurrentCategory() {
        return Mage::registry('current_category');
    }

    /**
     * Retrieve the current product if any.
     * Getter.
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct() {
        return Mage::registry('product');
    }

    /**
     * Retrieve the external application id.
     * Getter.
     *
     * @return string
     */
    public function getExternalAppId () {
        return $this->getNetworkConfig()->getId();
    }

    /**
     * Retrieve the application preferred locale.
     * Getter.
     *
     * @return string
     */
    public function getAppLang () {
        return $this->getNetworkConfig()->getLocale();
    }

    /**
     * Retrieve the config for this network.
     *
     * @throws Mage_Core_Exception
     * @return Varien_Object
     */
    public function getNetworkConfig ()
    {
        $config = Mage::getModel('socnet/network')
        ->getConfigByNetworkKey($this->getNetworkKey());
        if (is_null($config)) {
            throw new Mage_Core_Exception(
                    __METHOD__ . ": Configuration is null");
        }

        return $config;
    }

}