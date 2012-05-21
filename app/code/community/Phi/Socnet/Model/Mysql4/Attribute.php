<?php

/**
 * Description of Network
 *
 * @author Rodrigo Cervone <chervox@gmail.com>
 */
class Phi_Socnet_Model_Mysql4_Attribute extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct ()
    {
        $this->_init('socnet/attribute','attribute_id');
    }
}