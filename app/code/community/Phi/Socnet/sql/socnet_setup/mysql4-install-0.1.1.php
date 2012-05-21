<?php
$installer = $this;
try {
    $installer->startSetup();

    $tables[] = $installer->getConnection()
            ->newTable($installer->getTable('socnet/attribute'))
            ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
                    array('identity' => true, 'unsigned' => true,
                        'nullable' => false,'primary' => true), 'Attribute ID')
            ->addColumn('key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Attribute Key')
            ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Title')
            ->addColumn('description', Varien_Db_Ddl_Table::TYPE_VARCHAR, 1024,
                    array('nullable' => true,), 'Attribute Description')
            ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1,
                    array('nullable' => false, 'default' => '0'), 'Is enabled')
            ->addIndex('IDX_PHI_SOCNET_ATTRIBUTE_KEY', array('key'),
                    array('type'=>Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE));

    $tables[] = $installer->getConnection()
            ->newTable($installer->getTable('socnet/socialcustomer'))
            ->addColumn('social_id', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50,
                    array('nullable' => false, 'primary' => true),
                    'Social Customer ID')
            ->addColumn('network_key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Network Key')
            ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
                    array('nullable' => false,'unsigned' => true,),
                    'Customer Magento Id')
            ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null,
                    array(), 'Creation Time')
            ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null,
                    array(), 'Update Time')
            ->addIndex('IDX_PHI_SOCNET_NETWORK_KEY', array('network_key'),
                    array('type'=>Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX))
            ->addIndex('IDX_PHI_SOCNET_CUSTOMER_NETWORK',
                    array('customer_id','network_key'),
                    array('type'=>Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE));

    $tables[] = $installer->getConnection()
            ->newTable(
                    $installer->getTable('socnet/plugin_attribute_value'))
            ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
                    array('identity' => true, 'unsigned' => true, 'nullable' => false,
                'primary' => true), 'Value ID')
            ->addColumn('plugin_key', Varien_Db_Ddl_Table::TYPE_CHAR, 32,
                    array('unsigned' => true, 'nullable' => false,), 'Plugin ID')
            ->addColumn('attribute_key', Varien_Db_Ddl_Table::TYPE_CHAR, 32,
                    array('unsigned' => true, 'nullable' => false,), 'Attribute ID')
            ->addColumn('data', Varien_Db_Ddl_Table::TYPE_VARCHAR, 1024,
                    array('nullable' => false, 'default' => ''), 'Attribute Value')
            ->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Data Type in the form')
            ->addColumn('class', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => true), 'Data Class in the form')
            ->addColumn('required', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null,
                    array('nullable' => false), 'Is required field in the form')
            ->addColumn('class_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 10,
                    array('nullable' => false), 'Class name in the form')
            ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null,
                    array(), 'Creation Time')
            ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null,
                    array(), 'Update Time')
            ->addIndex('IDX_PHI_SOCNET_PLUGIN_ATTRIBUTE_VALUE_ATTRIBUTE_KEY_PLUGIN_KEY',
                    array('attribute_key','plugin_key'),
                    array('type'=>Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE));

    $tables[] = $installer->getConnection()
            ->newTable($installer->getTable('socnet/network'))
            ->addColumn('network_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
                    array('identity' => true, 'unsigned' => true,
                    'nullable' => false, 'primary' => true),
                    'Supported Network ID')
            ->addColumn('key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Network Key')
            ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Title')
            ->addColumn('description', Varien_Db_Ddl_Table::TYPE_VARCHAR, 1024,
                    array('nullable' => true), 'Netowrk Description')
            ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1,
                    array('nullable' => false, 'default' => '0'), 'Is enabled')
            ->addIndex('IDX_PHI_SOCNET_NETWORK_KEY', array('key'),
                    array('type'=>Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE));


    $tables[] = $installer->getConnection()
            ->newTable($installer->getTable('socnet/plugin'))
            ->addColumn('plugin_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
                    array('identity' => true, 'unsigned' => true,
                        'nullable' => false, 'primary' => true), 'Plugin ID')
            ->addColumn('key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Plugin Key')
            ->addColumn('network_key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Network Name')
            ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => false), 'Title')
            ->addColumn('description', Varien_Db_Ddl_Table::TYPE_VARCHAR, 1024,
                    array('nullable' => true), 'Plugin Description')
            ->addColumn('template', Varien_Db_Ddl_Table::TYPE_VARCHAR, 32,
                    array('nullable' => true), 'Plugin Description')
            ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, 1,
                    array('nullable' => false, 'default' => '0'), 'Is enabled')
            ->addIndex('IDX_PHI_SOCNET_PLUGIN_KEY', array('key'),
                    array('type'=>Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
            ->addIndex('IDX_PHI_SOCNET_PLUGIN_NETWORK_KEY', array('network_key'));

    foreach ($tables as $table) {
        $installer->getConnection()->createTable($table);
    }

    $installer->endSetup();
} catch (Zend_Db_Statement_Exception $e) {
    Mage::logException($e);
    throw $e;
}
