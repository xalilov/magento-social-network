<?php
/**
 * Phi Socnet account controller
 *
 * @category   Phi
 * @package    Phi_Socnet
 * @author     Rodrigo Cervone <chervox@gmail.com>
 */
require_once("Mage/Customer/controllers/AccountController.php");

class Phi_Socnet_AccountController extends Mage_Customer_AccountController
{
    public function loginPostAction()
    {
        if($this->getRequest()->isAjax()) {
            $session = $this->_getSession();
            $params = $this->getRequest()->getParams();
            if(isset($params['social_id']) && isset($params['network'])) {
                $social_id = $params['social_id'];
                $network_key = $params['network'];
                $customer = Mage::getModel('socnet/socialcustomer')
                    ->loadByNetwork($network_key,$social_id);
                if(!$session->isLoggedIn()) {
                    $customer_id = false;
                    if($customer) {
                        $session
                            ->setCustomerAsLoggedIn($customer);
                        $redirect = Mage::getSingleton('customer/session')
                            ->getData('referer');
                        Mage::log($redirect);
                        $response = array('success'=>true,'redirect'=>$redirect);

                        $this->getResponse()->setBody(json_encode($response));
                    } else {
                        Mage::log("The User Id $social_id claim the login ".
                          "action but I couldn't find it.", Zend_Log::ERR);
                    }
                }
            }
        } else {
            return parent::loginPostAction();
        }
    }

    /**
     * Create customer account action
     */
    public function createPostAction()
    {
        $params = $this->getRequest()->getParams();
        if(isset($params['network'])) {
            $response = $this->getResponseFromNetwork($params['network']);
            if(isset($response['registration'])) {
                $data = Mage::helper('socnet')
                    ->normalizeData($response['registration']);
                $data['confirmation'] = $data['password'];
                var_dump($response);
                $this->getRequest()->setPost($data);
                $result = parent::createPostAction();
                $soc_data['social_id'] = $response['user_id'];
                $soc_data['network_key'] = $params['network'];
                $soc_data['customer_id'] = $this->_getSession()->getCustomer()->getId();
                $soc_data['created_at'] = now();
                $soc_data['updated_at'] = null;
                $soc_customer = Mage::getModel('socnet/socialcustomer')
                    ->setId(null)
                    ->setData($soc_data);
                Mage::log($soc_customer);
                $soc_customer->save();


                return $result;
            }
        }
        return parent::createPostAction();
    }

    /**
     * Retrieves the response from the network.
     *
     * @param string $networkKey
     * @return array
     */
    private function getResponseFromNetwork($network) {
        $response = array();
        if(Mage::helper('socnet')->isValidNetwork($network)) {
            $method = 'responseFrom'.ucfirst(strtolower($network));
            $response = Mage::helper('socnet')->{$method}();
        }

        return $response;
    }

}
