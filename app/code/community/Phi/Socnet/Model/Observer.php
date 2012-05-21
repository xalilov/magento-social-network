<?php
class Phi_Socnet_Model_Observer {

    /**
     * @var Varien_Event
     */
    private $_event;

    /**
     * Adds the blocks that will handle the meta tags and the create.
     *
     * @param Varien_Event_Observer $observer
     * @return Phi_Socnet_Model_Observer
     */
    public function handler(Varien_Event_Observer $observer) {
        $this->_event = $observer->getEvent();

        /* @var Mage_Core_Model_Layout */
        $layout = Mage::app()->getLayout();

        if(!$layout->getBlock('phi.socnet.view.create')) {
            /* @var Phi_Socnet_Block_View_Facebook_Create */
            $createBlock = $layout
                ->createBlock($this->getBlockType('create'),'phi.socnet.view.create');
            $layout->getBlock('after_body_start')->append($createBlock);
            $page = $this->getView()->getCurrentPage();
            // Page can be null if we are for example in a customer view.
            // so we dont have meta tags for the networks.
            if($page && $page->getConfig()->getGraph()) {
                /* var Phi_Socnet_Block_View_Facebook_Graph */
                $graphBlock = $layout
                    ->createBlock(
                            $this->getBlockType('graph'),'phi.socnet.view.graph');

                $graphBlock->setMetaTags(
                            $this->getView()->getCurrentPage()->getMetaTags()
                        );
                $layout->getBlock('head')->append($graphBlock);
            }
        }

        return $this;
    }

    /**
     * Retrieve the plugin.
     * @return Phi_Socnet_Block_View
     */
    protected function getView() {
        return $this->_event->getData('view');
    }

    /**
     * Retrieves the key for this network.
     *
     * Getter.
     * @return string
     */
    protected function getNetworkKey() {
        return $this->getView()->getNetworkKey();
    }

    /**
     * @param string $type
     * @return string
     */
    protected function getBlockType($type) {
        return strtolower('socnet/view_'.$this->getNetworkKey().'_'.$type);
    }
}