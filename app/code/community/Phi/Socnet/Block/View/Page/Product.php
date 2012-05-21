<?php

class Phi_Socnet_Block_View_Page_Product
extends Phi_Socnet_Block_View_Page_Abstract
{

    public function getMetaTags ()
    {
        $metas = null;
        if ($this->getConfig()->getGraph()) {
            $metas = $this->getProductPageMetas();
        }
         return new ArrayObject($metas);
    }

    /**
     * Gets the meta tags based on the product.
     *
     * @todo Refactor this to handle configuration through admin
     *
     * @return array
     */
    protected function getProductPageMetas ()
    {
        $metas = $this->getMetasCollection();
        /* @var Mage_Catalog_Model_Product */
        $product = $this->getProduct();
        $metas['description']['data'] = $product->getMetaDescription();
        $metas['title']['data'] = $product->getMetaTitle();
        if (empty($metas['title']['data'])) {
            $metas['title']['data'] = $this->getProduct()->getName();
        }
        $metas['type']['data'] = Phi_Socnet_Helper_Data::FACEBOOK_PRODUCT;
        $metas['appid']['data'] = $this->getConfig()->getId();
        $metas['name']['data'] = Mage::app()->getStore()->getFrontendName();
        $metas['image']['data'] = rtrim('/', Mage::getBaseUrl()) .
        $product->getImageUrl();
        $metas['url']['data'] = $product->getProductUrl();

        return $metas;
    }

    /**
     * Retrieve current product model
     *
     * @return Mage_Catalog_Model_Product
     */
    protected function getProduct() {
        return $this->getBlock()->getProduct();
    }
}
