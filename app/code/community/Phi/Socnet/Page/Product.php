<?php

class Phi_Socnet_Page_Product
extends Phi_Socnet_Page_Abstract
{
    protected function getPageMetas ()
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
}
