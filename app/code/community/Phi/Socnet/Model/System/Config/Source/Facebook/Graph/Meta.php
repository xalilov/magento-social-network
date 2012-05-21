<?php
class Phi_Socnet_Model_System_Config_Source_Facebook_Graph_Meta
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        return array(
                'title' => array('value' => 'og:title',
                        'label' => Mage::helper('socnet')->__('Title')),
                'type' => array('value' => 'og:type',
                        'label' => Mage::helper('socnet')->__('Type')),
                'image' => array('value' => 'og:image',
                        'label' => Mage::helper('socnet')->__('Image')),
                'url' => array('value' => 'og:url',
                        'label' => Mage::helper('socnet')->__('Url')),
                'name' => array('value' => 'og:site_name',
                        'label' => Mage::helper('socnet')->__('Site Name')),
                'admins' => array('value' => 'fb:admins',
                        'label' => Mage::helper('socnet')->__('Admin')),
                'appid' => array('value' => 'fb:app_id',
                        'label' => Mage::helper('socnet')->__('App ID')),
                'description' => array('value' => 'og:description',
                        'label' => Mage::helper('socnet')->__('Description')),
       );
    }
}