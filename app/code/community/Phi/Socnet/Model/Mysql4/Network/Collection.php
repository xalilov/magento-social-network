<?php

/**
 * Description of Collection
 *
 * @author Rodrigo Cervone <chervox@gmail.com>
 */
class Phi_Socnet_Model_Mysql4_Network_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct ()
    {
        parent::_construct();
        $this->_init('socnet/plugin_network');
    }
}