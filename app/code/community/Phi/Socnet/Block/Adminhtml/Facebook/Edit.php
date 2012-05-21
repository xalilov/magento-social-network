<?php

/**
 * @category    Phi
 * @package     Phi_Socnet_Block_Adminhtml
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Facebook Plugins details
 *
 * @category Phi
 * @package Phi_Socnet
 * @author Rodrigo Cervone <chervox@gmail.com>
 */
class Phi_Socnet_Block_Adminhtml_Facebook_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected $_blockGroup = 'socnet';
    protected $_controller = 'adminhtml_facebook';
    /**
     * Block construction
     * Initialize titles, buttons
     */
    public function __construct ()
    {
        parent::__construct();
        $this->_removeButton('delete');

        $this->_headerText =
                Mage::helper('socnet')->__('Edit Plugin Details') . ': ' .
                Mage::registry('socnet_plugin_data')->getTitle();
    }
}
