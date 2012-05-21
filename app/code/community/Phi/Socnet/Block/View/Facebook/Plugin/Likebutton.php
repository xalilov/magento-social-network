<?php

class Phi_Socnet_Block_View_Facebook_Plugin_Likebutton
    extends Phi_Socnet_Block_View_Facebook_Abstract
{
    public function getPluginKey() {
        return 'like_button';
    }

    public function getSendData ()
    {
        return $this->getPluginAttributeByKey('send')->getData('data');
    }

    public function getFbLayout ()
    {
        return $this->getPluginAttributeByKey('layout')->getData('data');
    }

    public function getWidth ()
    {
        return $this->getPluginAttributeByKey('width')->getData('data');
    }

    public function getShowRef ()
    {
        $r = $this->getRef();
        return (bool) (! empty($r));
    }

    public function getRef ()
    {
        return $this->getPluginAttributeByKey('ref')->getData('data');
    }

    public function getFont ()
    {
        return $this->getPluginAttributeByKey('font')->getData('data');
    }

    public function getShowFaces ()
    {
        return (($this->getPluginAttributeByKey('show_faces')
            ->getData('data')) ? "yes" : "no");
    }

    /**
     * @override
     * (non-PHPdoc)
     * @see Mage_Core_Block_Template::getTemplate()
     */
    public function getTemplate() {
        return 'phi/socnet/facebook/plugins/like-button.phtml';
    }
}
