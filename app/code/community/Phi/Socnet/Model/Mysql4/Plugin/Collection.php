<?php

/**
 * Description of Collection
 *
 * @author Rodrigo Cervone <chervox@gmail.com>
 */
class Phi_Socnet_Model_Mysql4_Plugin_Collection
    extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('socnet/plugin');
    }

    /**
     * Filter by network key and network status.
     *
     * @param string network The key of the network.
     * @param integer status If it is null will not filter against the current
     * status of the network.
     * Defaults to null.
     *
     * @return Phi_Socnet_Model_Mysql4_Plugin_Collection
     */
    public function addNetworkFilter($network, $status = null) {
        $this->addJoinNetwork();
        $this->getSelect()->where('network:key=?',$network);

        if($status !== null) {
            $this->addNetworkStatusFilter($status);
        }
        return $this;
    }

    /**
     * Retrieve all plugins filtered by network status.
     *
     * @param boolean $status
     * @return Phi_Socnet_Model_Mysql4_Plugin_Collection
     */

    public function addNetworkStatusFilter($status) {
        $status = ($status) ? '1' : '0';
        $this->addJoinNetwork()
            ->getSelect()->where('network:status',$status);
        return $this;
    }

    /**
     * Retrieve all plugins joined with their networks.
     *
     * @param string $network
     * @return Phi_Socnet_Model_Mysql4_Plugin_Collection
     */
    public function addJoinNetwork() {
        $this->getSelect()->joinInner(
                array('network'=>$this->getTable('socnet/network')),
                'main_table.network_key=network.key',
                array(
                        'network.title as network:title',
                        'network.description as network:description',
                        'network.key as network:key',
                        'network.status as network:status',
                ));
        return $this;
    }

    /**
     * Retrieve plugins with the given status.
     *
     * @param bool $status
     * @return Phi_Socnet_Model_Mysql4_Plugin_Collection
     */
    public function addStatusFilter($status) {
        $this->getSelect()->where('main_table.status=?',(($status)?'1':'0'));
        return $this;
    }
}