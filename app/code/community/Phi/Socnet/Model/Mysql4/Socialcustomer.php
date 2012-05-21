<?php

/**
 * Description of Socialcustomer
 *
 * @author Rodrigo Cervone <chervox@gmail.com>
 */
class Phi_Socnet_Model_Mysql4_Socialcustomer
    extends Mage_Core_Model_Mysql4_Abstract {

    protected $_isPkAutoIncrement = false;

    protected function _construct() {
        $this->_init('socnet/socialcustomer', 'social_id');
    }

    public function loadByNetwork($network_key, $social_id) {
        $read = $read = Mage::getSingleton('core/resource')
            ->getConnection('core_read');
        $select = $read->select()
            ->from($this->getMainTable())
            ->where('`social_id`=?',$social_id)
            ->where('`network_key`=?', $network_key);
        $result = $read->fetchAll($select);
        $result = array_shift($result);
        return ($result['customer_id']) ? $result['customer_id'] : FALSE;
    }
}