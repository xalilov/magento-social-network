<?php

class Phi_Socnet_Model_Socialcustomer extends Mage_Core_Model_Abstract
{

    public function _construct ()
    {
        parent::_construct();
        $this->_init('socnet/socialcustomer');
    }

    public function loadByNetwork($network_key, $social_id) {
        $id = $this->getResource()->loadByNetwork($network_key, $social_id);
        $customer = null;
        if($id) {
            $customer = Mage::getModel('customer/customer')->load($id);
        }
        return $customer;
    }
}