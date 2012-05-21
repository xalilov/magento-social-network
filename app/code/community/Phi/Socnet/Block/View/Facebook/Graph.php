<?php

class Phi_Socnet_Block_View_Facebook_Graph extends Mage_Core_Block_Template
{

    private $metas;

    /**
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return "phi/socnet/facebook/graph.phtml";
    }

    public function setMetaTags(ArrayObject $metas) {
        if(!$metas->count()) {
            Mage::log(__METHOD__ . ": Meta tags is empty.", Zend_Log::ERR);
        }
        $this->metas = $metas;
        return $this;
    }

    public function getMetaTags() {
        return $this->metas;
    }
}
