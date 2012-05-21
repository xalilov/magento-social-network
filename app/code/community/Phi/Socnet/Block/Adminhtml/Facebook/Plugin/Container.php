<?php

/**
 * @category Phi
 * @package Phi_Socnet
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Rodrigo Cervone <chervox@gmail.com>
 */

class Phi_Socnet_Block_Adminhtml_Facebook_Plugin_Container
    extends Mage_Adminhtml_Block_Widget_Grid_Container {

    protected $_blockGroup = 'socnet';
    protected $_controller = 'adminhtml_facebook_plugin';

    public function __construct()
    {
        parent::__construct();
        $this->_headerText =
            Mage::helper('socnet')->__('Plugin List');
        $this->_removeButton('add')->_removeButton('save');
    }
}