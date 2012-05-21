<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Collection
 *
 * @author chervox
 */
class Phi_Socnet_Model_Mysql4_Attribute_Collection
    extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct ()
    {
        parent::_construct();
        $this->_init('socnet/attribute');
    }


    public function addPluginFilter($plugin_key) {
        $select = $this->getSelect()
             ->join(
                array('v'=>$this->getTable('socnet/plugin_attribute_value')),
                     'main_table.key=v.attribute_key')
             ->where('v.plugin_key=?',$plugin_key)
        ;
//         Mage::log(__METHOD__ . ": ". (string)$select);
        return $this;
    }


}
