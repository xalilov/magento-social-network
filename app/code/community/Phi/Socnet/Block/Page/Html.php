<?php

class Phi_Socnet_Block_Page_Html extends Mage_Page_Block_Html
{

    protected function getNs ($key)
    {
        $out = '';
        switch ($key) {
            case 'fb':
                $out = Mage::Helper('socnet')->getFbmlNs();
                break;
            case 'graph':
                $out = Mage::Helper('socnet')->getOpenGraphNs();
                break;
        }
        return $out;
    }

    /**
     * Overrides the start html tag to include
     * the different namespaces.
     *
     * (non-PHPdoc)
     *
     * @see Mage_Core_Block_Template::_toHtml()
     */
    public function _toHtml ()
    {
        $html = parent::_toHtml();
        if (Mage::getStoreConfig('phi_socnet/facebook/enabled')) {
            $xmlns = $this->getNs('fb');
            if (strpos($html, $xmlns) === FALSE) {
                $html = str_replace('<html', '<html ' . $xmlns, $html);
            }
        }

        if (Mage::getStoreConfig('phi_socnet/facebook/graph')) {
            $xmlns = $this->getNs('graph');
            if (strpos($html, $xmlns) === FALSE) {
                $html = str_replace('<head', '<head ' . $xmlns, $html);
            }
        }

        return $html;
    }
}