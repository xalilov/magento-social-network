<?php
class Phi_Socnet_Block_View
{
    /**
     * The key for the network I'm working with.
     * Implemented keys:
     * - facebook
     * - google
     * - twitter
     *
     * @var string
     */
    private $network_key;

    /**
     * Constructor.
     * @param string $networkKey
     */
    public function __construct($networkKey) {
        $this->network_key = $networkKey;
    }

    /**
     * Tells if we are in home or not.
     * The code is duplicated.
     * @todo find a better way.
     *
     * @see Mage_Page_Block_Html_Header return bool
     */
    public function isHomePage ()
    {
        $page = Mage::app()->getFrontController()->getRequest()->getRouteName();
        $homePage = false;

        if($page =='cms'){
            $cmsSingletonIdentifier = Mage::getSingleton('cms/page')->getIdentifier();
            $homeIdentifier = Mage::app()->getStore()->getConfig('web/default/cms_home_page');
            if($cmsSingletonIdentifier === $homeIdentifier){
                $homePage = true;
            }
        }

        return $homePage;
    }

    /**
     * Tells if we are on a category page or not.
     * (if we have a current category and we don't have a
     * a product THEN we assumed that we are in a category page)
     *
     * @return bool
     */
    public function isCategoryPage ()
    {
        return (bool) (Mage::registry('current_category')
        && !Mage::registry('current_product')
        && !Mage::registry('product'));
        $name = Mage::app()->getFrontController()
        ->getRequest()
        ->getControllerName();
        return (bool) ($name == 'category');
    }

    /**
     * Tells if we are on a product page or not.
     * (if we have a current category and a
     * a product THEN we assumed that we are in a product page)
     *
     * @return bool
     */
    public function isProductPage ()
    {
        $name = Mage::app()->getFrontController()
            ->getRequest()
            ->getControllerName();
        return (bool) ($name == 'product');

    }

    /**
     * Tells if we are on the root category.
     * (we assume that the root category has not parent id)
     *
     * @return bool
     */
    public function isRootCategory ()
    {
        $out = FALSE;
        $cat = Mage::registry('current_category');
        if ($cat->getParentId()) {
            $out = TRUE;
        }

        return $out;
    }

    /**
     * Setter.
     * @param string $network
     * @throws Mage_Core_Exception
     *
     * @return Phi_Socnet_Block_Socnet
     */
    public function setNetworkKey ($network)
    {
        if (!$this->checkNetworkKey($network)) {
            throw new Mage_Core_Exception("Not a valid network key");
        }
        $this->network_key = $network;
        return $this;
    }

    /**
     * Getter.
     * @return string
     */
    public function getNetworkKey() {
        return $this->network_key;
    }

    /**
     * Verify the network against the active networks.
     * A key may be invalid if is not a key or if its disabled.
     *
     * @param string $key
     * @return boolean
     */
    protected function checkNetworkKey($key) {
        return Mage::helper('socnet')->isValidNetwork($key);
    }

    /**
     * Retrieves the valid network keys.
     * Getter.
     * @return Varien_Object
     */
    public function getNetworkKeys() {
        return Mage::helper('socnet')->getValidNetworks();
    }

    /**
     * Gets the block that we request.
     * Depends on the network and the page we are.
     *
     * return Phi_Socnet_Block_View_Facebook_Abstract
     */
    public function getCurrentPage ()
    {
           /**
            * @todo
            * Create blocks for head a create
            */
            // Order matters for this
            // because in different customizations
            // we may have a product or a category
            // at the homepage.

            if ($this->isProductPage()) {
                return $this->getProductPage();
            } else if ($this->isCategoryPage()) {
                return $this->getCategoryPage();
            } else if ($this->isHomePage()) {
                return $this->getHomePage();
            } else {
                return null;
            }
    }

    /**
     * Gets a product block.
     * @return Mage_Core_Block_Template
     */
    private function getProductPage()
    {
        $block = Phi_Socnet_Helper_Data::PRODUCT;
        return $this->pageFactory($block);
    }

    /**
     * Gets a home page block.
     * @return Mage_Core_Block_Template
     */
    private function getHomePage()
    {
        $class = Phi_Socnet_Helper_Data::HOMEPAGE;
        return $this->pageFactory($class);
    }

    /**
     * Gets a category block.
     * @return Mage_Core_Block_Template
     */
    private function getCategoryPage()
    {
        $class = Phi_Socnet_Helper_Data::CATEGORY;
        return $this->pageFactory($class);
    }

    /**
     * Returns an instance of the social page based on what we have
     * on the key.
     *
     * @param string $key
     * @throws Mage_Core_Exception
     *
     * @return Phi_Socnet_Page_Abstract
     */
    private function pageFactory ($key)
    {
        $class = 'Phi_Socnet_Page_' . ucfirst(strtolower($key));
        /* @var Phi_Socnet_Page_Abstract */
        $obj = Mage::getSingleton($class);
        $obj->setNetworkKey($this->getNetworkKey());
        $obj->setView($this);
        return $obj;
    }
}