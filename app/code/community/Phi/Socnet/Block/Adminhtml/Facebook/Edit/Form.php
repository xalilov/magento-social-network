<?php
/**
 * Facebook Plugins details
 *
 * @category Phi
 * @package Phi_Socnet
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Rodrigo Cervone <chervox@gmail.com>
 */

class Phi_Socnet_Block_Adminhtml_Facebook_Edit_Form
extends Mage_Adminhtml_Block_Widget_Form
{

    public function getFormValues()
    {
        /* @var $model Phi_Socnet_Model_Plugin */
        $model = Mage::registry('socnet_plugin_data');
        return $model->getAttributes()->getData();
    }

    /**
     * Prepare read-only data and group it by fieldsets
     *
     * @return Mage_Paypal_Block_Adminhtml_Settlement_Details_Form
     */
    protected function _prepareForm ()
    {
        $model = Mage::registry('socnet_plugin_data');
        /* @var $model Phi_Socnet_Model_Plugin */
        $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset($model->getKey(), array(
                'legend' =>Mage::helper('socnet')->__($model->getTitle()) . ": " .
                Mage::helper('socnet')->__($model->getDescription())
        ));
        $status = array(
                'label' => Mage::helper('socnet')->__('Status'),
                'class' => 'yesno',
                'name' => 'status',
                'required' => false,
                'options' => array(
                        0=> Mage::helper('socnet')->__('Disable'),
                        1=> Mage::helper('socnet')->__('Enable'),
                ),
                'note' => Mage::helper('socnet')->__("Enable/Disables this plugin.")
        );

        $fieldset->addField('status', 'select', $status);
        $data = $model->getAttributes()->getData();
        foreach($data as $attribute) {
            $options = array(
                    'label'     => Mage::helper('socnet')->__($attribute['title']),
                    'class'     => $attribute['class_name'],
                    'required'  => $attribute['required'],
                    'name'      => $attribute['key'],
                    'options'   => (($attribute['type'] == 'select') ?
                            $this->_getWidgetSelectOptions($attribute) : null),
                    'values'    => (($attribute['type'] == 'radios') ?
                            $this->_getRadioValues($attribute) : null),
                    'note'      =>
                    Mage::helper('socnet')->__($attribute['description']),
            );
            $fieldset->addField($attribute['key'], $attribute['type'], $options);
        }
        $form->setValues($model->getAttributes()->getData());

        return parent::_prepareForm();
    }

    protected function _initFormValues() {
        $model = Mage::registry('socnet_plugin_data');
        $data = array();
        foreach($model->getAttributes()->getData() as $attribute) {
            $data[$attribute['key']] = $attribute['data'];
        }
        $data['status'] = $model->getStatus();
        $this->getForm()->addValues($data);
        return parent::_initFormValues();
    }

    /**
     * Prepare options for widgets HTML select
     *
     * @return array
     */
    protected function _getWidgetSelectOptions($attribute)
    {
        $options = Mage::getModel('socnet/system_config_source_facebook_form')
                        ->toOptionArray($attribute['class']);
        $opt = array();
        foreach ($options as $data) {
            $opt[$data['value']] = $data['label'];
        }
        return $opt;
    }

    protected function _getRadioValues($attribute) {
        $opt = array();
        switch ($attribute['class']) {
            case 'yesno':
                $opt =Mage::getModel('adminhtml/system_config_source_yesno')
                                    ->toOptionArray();
                break;
            case 'boolean':
                $opt = Mage::getModel('socnet/system_config_source_facebook_form')
                        ->toOptionArray('boolean');
                break;
        }

        return $opt;
    }
}