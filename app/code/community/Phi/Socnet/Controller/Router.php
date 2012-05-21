<?php
class Phi_Socnet_Controller_Router
    extends Mage_Core_Controller_Varien_Router_Standard {

    /**
     * Initialize Controller Router
     *
     * @param Varien_Event_Observer $observer
     */
    public function initControllerRouters($observer)
    {
        /* @var $front Mage_Core_Controller_Varien_Front */
        $front = $observer->getEvent()->getFront();
        $front->addRouter('phi_socnet', $this);
    }

    /**
     * Validate and Match the channel file and modify request
     *
     * @param Zend_Controller_Request_Http $request
     * @return bool
     */
    public function match(Zend_Controller_Request_Http $request)
    {
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }

        $path = trim($request->getPathInfo(), '/');
        switch($path) {
            case Phi_Socnet_Helper_Data::FACEBOOK_CHANNEL:
                return $this->_routeFacebookChannel($request);
            default:
                return false;
        }
    }

    private function _routeFacebookChannel($request) {
        // Define initial values for controller initialization
        $module = 'socnet';
        $realModule = 'Phi_Socnet';
        $controller = 'index';
        $action = 'channel';
        $controllerClassName = $this->_validateControllerClassName(
                $realModule,
                $controller
        );

        // If controller was not found
        if (!$controllerClassName) {
            return false;
        }
        // Instantiate controller class
        $controllerInstance = Mage::getControllerInstance(
                $controllerClassName,
                $request,
                $this->getFront()->getResponse()
        );

        // If action is not found
        if (!$controllerInstance->hasAction($action)) {
            return false;
        }

        // Set request data
        $request->setModuleName($module);
        $request->setControllerName($controller);
        $request->setActionName($action);
        $request->setControllerModule($realModule);

        // dispatch action
        $request->setDispatched(true);
        $controllerInstance->dispatch($action);

        // Indicate that our route was dispatched
        return true;
    }
}