<?php
/**
 * Layout model
 *
 * @category   Phi
 * @package    Phi_Socnet
 */
class Phi_Socnet_Model_Layout extends Mage_Core_Model_Layout
{
    /**
     * Holds the blocks values for isActive.
     *
     * @var array
     */
    private $_types;

    /**
     * @todo Find a better way to check for enabled plugins.
     * (non-PHPdoc)
     * @see Mage_Core_Model_Layout::addBlock()
     */
    public function addBlock($block, $blockName)
    {
        $rsp = false;
        $pattern = '/^socnet\/(.)+_plugin_/';
        if($this->getArea() == 'frontend' && preg_match($pattern,$block)) {
            if($this->isEnabledBlock($block)) {
                $rsp = parent::addBlock($block, $blockName);
                Mage::log("Added " . $rsp->getPluginKey() . " plugin.");
            }
        } else {
            $rsp = parent::addBlock($block, $blockName);
        }
        return $rsp;
    }

    /**
     * Retrieve if the block is active.
     *
     * @param string $block
     * @return boolean
     */
    private function isEnabledBlock($type) {
        $className = Mage::getConfig()->getBlockClassName($type);
        Mage::log("Class found for $type: $className");
        if(!isset($this->_types[$className])) {
            $class = new $className;
            $this->_types[$className] = $class->isActive();
        } else {
            Mage::log("Using the registry for $type.");
        }
        return $this->_types[$className];
    }
}
