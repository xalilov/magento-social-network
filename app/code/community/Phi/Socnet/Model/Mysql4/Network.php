<?php

/**
 * Description of Network
 *
 * @author Rodrigo Cervone <chervox@gmail.com>
 */
class Phi_Socnet_Model_Mysql4_Network extends Mage_Core_Model_Mysql4_Abstract {

    protected function _construct() {
        $this->_init('socnet/network', 'network_id');
    }

    /**
     * Fetchs all active keys.
     *
     * @return Varien_Object
     */
    public function getKeys() {
        $select = $this->_getReadAdapter()->select()
        ->from($this->getMainTable());
       $networks = $this->_getReadAdapter()->fetchAll($select);
       $keys = array();
       foreach ($networks as $n) {
           if($n['status']) {
               $keys[] = $n['key'];
           }
       }

       return new Varien_Object($keys);
    }
}