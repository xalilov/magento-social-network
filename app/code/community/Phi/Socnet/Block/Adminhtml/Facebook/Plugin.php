<?php

class Phi_Socnet_Block_Adminhtml_Facebook_Plugin extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function _prepareLayout ()
    {
        parent::_prepareLayout();
    }

    public function __construct ()
    {
        $this->_blockGroup = 'socnet';
        $this->_controller = 'adminhtml_facebook_plugin';
        $this->_headerText = Mage::helper('adminhtml')
            ->__('Social Plugins from Facebook');
        $this->_addButtonLabel = Mage::helper('socnet')->__('Save config');
        parent::__construct();
    }
}
