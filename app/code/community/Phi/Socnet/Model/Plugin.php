<?php

class Phi_Socnet_Model_Plugin extends Mage_Core_Model_Abstract {

    /**
     * @var Phi_Socnet_Model_Network
     */
    private $_network;

    /**
     * @var Phi_Socnet_Model_Mysql4_Attribute_Collection
     */
    private $_attributes;

    /**
     * Getter
     *
     * @return Phi_Socnet_Model_Network
     */
    public function getNetwork() {
        return $this->getResource()->getNetwork($this->getKey());
    }

    /**
     * Getter
     *
     * @return Phi_Socnet_Model_Mysql4_Attribute_Collection
     */
    public function getAttributes() {
        return $this->getResource()->getAttributes($this->getKey());
    }

    /**
     * Getter
     * @param string $key
     *
     * @return array
     */
    public function getAttributeByKey($key) {
        return $this->getResource()->getAttributeByKey($this->getKey(), $key);
    }

    public function _construct() {
        parent::_construct();
        $this->_init('socnet/plugin');
    }

    /**
     * Return name for row column
     *
     * @param string $field
     *            Field name in row model
     * @return string
     */
    public function getFieldLabel($field) {
        switch ($field) {
            case 'plugin_id':
                return Mage::helper('socnet')->__('ID');
            case 'title':
                return Mage::helper('socnet')->__('Title');
            case 'plugin':
                return Mage::helper('socnet')->__('Social Plugin');
            case 'network':
                return Mage::helper('socnet')->__('Network');
            case 'description':
                return Mage::helper('socnet')->__('Description');
            default:
                return $field;
        }
    }

    public function saveAttributes(array $data) {
        return $this->getResource()->saveAttributes($this->getKey(), $data);
    }

    public function loadByKey($key) {
        $id = $this->_getResource()->loadByKey($key);
        if(!$id) {
            Mage::exception('Mage_Core', 'Not plugin found with this keys '
            	 . $key);
        }

        return $this->load($id);
    }

    /**
     * Answer if the plugin identified by key is active.
     *
     * @param string $key
     * @return boolean
     */
    public function isActive($key) {
        return $this->getResource()->isActive($key);
    }

    public function getActivePlugins() {
        return $this->getCollection()->addStatusFilter(TRUE)->load();
    }
}