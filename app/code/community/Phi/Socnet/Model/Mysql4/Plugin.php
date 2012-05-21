<?php

class Phi_Socnet_Model_Mysql4_Plugin extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * @var array
     */
    private $_plugins;

    public function getNetwork($plugin_key) {
        return $this->_plugins[$plugin_key]['network'];
    }

    /**
     * Getter
     *
     * @return Phi_Socnet_Model_Network
     */
    public function getAttributes($plugin_key) {
        return $this->_plugins[$plugin_key]['attributes'];
    }

    public function getAttributeByKey($plugin_key, $key) {
        foreach($this->getAttributes($plugin_key) as $att) {
            if($key == $att->getKey()) {
                return $att;
            }
        }
        Mage::log(__METHOD__ .
                ":  Attribute with key $key not found for plugin $plugin_key.",
                Zend_Log::ERR);
        return FALSE;
    }

    public function _construct ()
    {
        // Note that the socnet_id refers to the key field in your database
        // table.
        $this->_init('socnet/plugin', 'plugin_id');
    }

    public function saveAttributes($plugin_key, array $data) {
        $atts = $this->getAttributes($plugin_key);
        $this->_getWriteAdapter()->beginTransaction();

        /* @var Phi_Socnet_Model_Plugin */
        $model = Mage::getModel('socnet/plugin')
            ->load($this->loadByKey($plugin_key));
        $model->setData('status',$data['status'])->save();

        /* @var Phi_Socnet_Model_Plugin_Attribute_Value */
        $model = Mage::getModel('socnet/plugin_attribute_value');
        unset($data['status']);
        try {
            foreach($data as $key => $new) {
                if($att = $this->getAttributeByKey($plugin_key, $key)) {
                    $model->loadByAttributePluginKey($key, $plugin_key);
                    $model->setData(
                        array(
                            'value_id' => $model->getId(),
                            'data' => $new,
                        )
                    );

                    if ($model->getCreatedAt() == NULL) {
                        $model->setCreatedAt(now());
                    }
                    $model->setUpdatedAt(now());
                    $model->save();
                }
            }
            return $this->_getWriteAdapter()->commit();
        } catch (Exception $e) {
            $this->_getWriteAdapter()->rollBack();
            Mage::logException($e);
        }

        return false;
    }

    public function _afterLoad(Mage_Core_Model_Abstract $object) {
        $atts = Mage::getModel('socnet/attribute')->getCollection()
                ->addPluginFilter($object->getKey());
        $network = Mage::getModel('socnet/network')
                ->load($object->getNetworkKey());
        $this->_plugins[$object->getKey()]['plugin'] = $object;
        $this->_plugins[$object->getKey()]['attributes'] = $atts;
        $this->_plugins[$object->getKey()]['network'] = $network;
        return parent::_afterLoad($object);

   }

    public function loadByKey($plugin_key) {
        $select = $this->_getReadAdapter()->select()
            ->from($this->getMainTable())
            ->where('`key`=?',$plugin_key);
        $id = $this->_getReadAdapter()->fetchOne($select);
        return ($id) ? $id : FALSE;
    }

    public function isActive($plugin_key) {
        $select = "SELECT status FROM ".
                $this->getMainTable(). " WHERE `key` = '$plugin_key'";
//         Mage::log(__FILE__. " => " .$select);
        $rsp = $this->_getReadAdapter()->fetchOne($select);
        return (bool)$rsp;
    }

}