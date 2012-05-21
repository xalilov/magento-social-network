<?php
/**
 * Customer register form block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Phi_Socnet_Block_Customer_Form_Register
    extends Mage_Customer_Block_Form_Register
{
    /**
     * Retrieve form data
     *
     * @return Varien_Object
     */
    public function getFormData()
    {

        $data = $this->getResponseInfo();
        if(!empty($data)) {
            $this->setFormData(new Varien_Object($data));
        }
        return parent::getFormData();
    }

//     protected function getLibConfig() {
//         return Mage::helper('socnet')->getLibConfig($this->getNetworkKey());
//     }

    protected function getResponseInfo() {
        $response = Mage::helper('socnet')->responseFromFacebook();
        $data = array();
        if(isset($response['registration'])) {
            $data = Mage::helper('socnet')
                ->normalizeData($response['registration']);
        }

        return $data;
    }
}
