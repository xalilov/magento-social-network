<?php
abstract class Phi_Socnet_Page_Abstract {

    /**
     * @var string
     */
    private $networkKey;

    /**
     * @var Phi_Socnet_Block_View
     */
    private $view;

    /**
     * Setter.
     * @param string $config
     * @return Phi_Socnet_Page_Abstract
     */
    public function setNetworkKey($key) {
        $this->networkKey = $key;
        return $this;
    }

    /**
     * Getter.
     * @return string
     */
    public function getNetworkKey () {
        return $this->networkKey;
    }

    /**
     * Getter.
     * @return Varien_Object
     */
    public function getConfig ()
    {
        $config = Mage::getModel('socnet/network')
        ->getConfigByNetworkKey($this->getNetworkKey());
        if (is_null($config)) {
            throw new Mage_Core_Exception(
                    __METHOD__ . ": Configuration is null");
        }

        return $config;
    }

    /**
     * Setter.
     * @param Phi_Socnet_Block_View $block
     * @return Phi_Socnet_Page_Abstract
     */
    public function setView(Phi_Socnet_Block_View $view) {
        $this->view = $view;
        return $this;
    }

    /**
     * Getter.
     * @return Phi_Socnet_Block_View
     */
    public function getView() {
        return $this->view;
    }

    /**
     * Getter.
     * @return Model_Core_Model_Layout
     */
    public function getLayout() {
        return Mage::app()->getLayout();
    }

    /**
     * Retrieve the meta tags for describing the current page
     * on the social network.
     *
     * @return ArrayObject
     */
    public function getMetaTags () {
        $metas = $this->getPageMetas();
        return new ArrayObject($metas);
    }

    /**
     * Gets the meta tags for the page.
     *
     * @return array
     */
    abstract protected function getPageMetas();

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

}