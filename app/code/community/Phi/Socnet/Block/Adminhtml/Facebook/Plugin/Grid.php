<?php

class Phi_Socnet_Block_Adminhtml_Facebook_Plugin_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Constructor
     * Set main configuration of grid
     */
    public function __construct ($attributes=array())
    {
        parent::__construct($attributes);
        $this->setId('pluginGrid');
//         $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection for grid
     *
     * @return Phi_Socnet_Block_Adminhtml_Facebook_Plugin_Grid
     */
    protected function _prepareCollection ()
    {
        $collection = Mage::getModel('socnet/plugin')->getCollection()
            ->addJoinNetwork();

        $this->setCollection($collection);
        if (! $this->getParam($this->getVarNameSort())) {
            $collection->setOrder('main_table.title', Varien_Data_Collection::SORT_ORDER_ASC);
        }
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return Phi_Socnet_Block_Adminhtml_Facebook_Plugin_Grid
     */
    protected function _prepareColumns ()
    {
        $plugin = Mage::getSingleton('socnet/plugin');
        $this->setCollection($plugin->getCollection()->addJoinNetwork());
        /* @var Phi_Socnet_Model_Plugin */
        $this->addColumn('plugin_id',
                array('header' => $plugin->getFieldLabel('plugin_id'),
                        'index' => 'plugin_id'));
        $this->addColumn('main_table.title',
                array('header' => $plugin->getFieldLabel('plugin'),
                        'index' => 'title', 'type' => 'text'));
        $this->addColumn('main_table.description',
                array('header' => $plugin->getFieldLabel('description'),
                        'index' => 'description', 'type' => 'text'));
        $this->addColumn('network:title',
                array('header' => $plugin->getFieldLabel('network'),
                        'index' => 'network:title', 'type' => 'text'));
        return parent::_prepareColumns();
    }

    /**
     * Return grid URL
     *
     * @return string
     */
    public function getGridUrl ()
    {
        return $this->getUrl('*/*/index');
    }

    /**
     * Return item view URL
     *
     * @return string
     */
    public function getRowUrl ($item)
    {
        return $this->getUrl('*/*/edit', array('id' => $item->getId()));
    }

}