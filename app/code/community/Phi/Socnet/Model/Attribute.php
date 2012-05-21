<?php

class Phi_Socnet_Model_Attribute extends Mage_Core_Model_Abstract
{

    public function _construct ()
    {
        parent::_construct();
        $this->_init('socnet/attribute');
    }

}