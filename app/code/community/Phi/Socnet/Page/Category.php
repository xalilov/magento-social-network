<?php

class Phi_Socnet_Page_Category
    extends Phi_Socnet_Page_Abstract
{

    protected function getPageMetas ()
    {
        $metas = $this->getMetasCollection();
        /* @var Mage_Catalog_Model_Category */
        $category = $this->getCurrentCategory();

        $metas['description']['data'] = $category->getDescription();
        $metas['title']['data'] = $category->getMetaTitle();
        if (empty($metas['title']['data'])) {
            $metas['title']['data'] = $category->getName();
        }
        $metas['type']['data'] = Phi_Socnet_Helper_Data::FACEBOOK_CATEGORY;
        $metas['appid']['data'] = $this->getConfig()->getId();
        $metas['name']['data'] = Mage::app()->getStore()->getFrontendName();
        $metas['image']['data'] = trim('/', Mage::getBaseUrl()) .
        $category->getImageUrl();
        $metas['url']['data'] = $category->getUrl();

        return $metas;
    }
}
