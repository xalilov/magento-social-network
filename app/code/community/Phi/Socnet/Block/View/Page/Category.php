<?php

class Phi_Socnet_Block_View_Page_Category
    extends Phi_Socnet_Block_View_Page_Abstract
{

    public function getMetaTags ()
    {
        $metas = null;
        if ($this->getConfig()->graph) {
            $metas = $this->getCategoryPageMetas();
        }
         return new ArrayObject($metas);
    }

    /**
     * Gets the meta tags based on the category.
     *
     * @todo Refactor this to handle configuration through admin
     *
     * @return array
     */
    protected function getCategoryPageMetas ()
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

    /**
     * Retrieve current category model object
     *
     * @return Mage_Catalog_Model_Category
     */
    protected function getCurrentCategory()
    {
        return $this->getBlock()->getCurrentCategory();
    }
}
