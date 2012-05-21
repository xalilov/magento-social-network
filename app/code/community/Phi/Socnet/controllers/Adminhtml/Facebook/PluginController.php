<?php

class Phi_Socnet_Adminhtml_Facebook_PluginController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction ()
    {
        $this->loadLayout()
        ->_setActiveMenu('phi/socnet/facebook_plugins')
        ->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Social Plugins from Facebook'),
                Mage::helper('adminhtml')->__('Social Plugins from Facebook'));

        return $this;
    }

    public function indexAction ()
    {
        $this->_initAction()
            ->renderLayout();
    }

    public function editAction ()
    {
        $rowId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('socnet/plugin')->load($rowId);
        Mage::register('socnet_plugin_data', $model);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (! empty($data)) {
                $model->setData($data);
            }

            $this->loadLayout();
            $this->_setActiveMenu('phi/socnet/facebook_plugins');
            $this->_addBreadcrumb(
                    Mage::helper('socnet')->__('Plugin Manager'),
                    Mage::helper('socnet')->__('Plugin Manager'));
            $this->_addContent(
                    $this->getLayout()
                    ->createBlock('socnet/adminhtml_facebook_edit'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('socnet')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction ()
    {
        $this->_forward('edit');
    }

    public function saveAction ()
    {
        $data = $this->getRequest()->getPost();
        if ($data) {
            $plugin_id = $this->getRequest()->getParam('id');
            $plugin = Mage::getModel('socnet/plugin')
                ->load($plugin_id);
            if(isset($data['form_key'])) {
                unset($data['form_key']);
            }
            $result = $plugin->saveAttributes($data);

            if($result) {
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')
                            ->__('Item was successfully saved'));
            } else {
                Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('socnet')
                            ->__('Unable to find item to save'));
            }
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction ()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('socnet/socnet');

                $model->setId(
                        $this->getRequest()
                        ->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                        $e->getMessage());
                $this->_redirect('*/*/edit',
                        array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction ()
    {
        $socnetIds = $this->getRequest()->getParam('socnet');
        if (! is_array($socnetIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('adminhtml')->__(
                            'Please select item(s)'));
        } else {
            try {
                foreach ($socnetIds as $socnetId) {
                    $socnet = Mage::getModel('socnet/socnet')->load(
                            $socnetId);
                    $socnet->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted',
                                count($socnetIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                        $e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction ()
    {
        $socnetIds = $this->getRequest()->getParam('socnet');
        if (! is_array($socnetIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                    $this->__('Please select item(s)'));
        } else {
            try {
                foreach ($socnetIds as $socnetId) {
                    $socnet = Mage::getSingleton(
                            'socnet/socnet')->load($socnetId)
                            ->setStatus(
                                    $this->getRequest()
                                    ->getParam('status'))
                                    ->setIsMassupdate(true)
                                    ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__(
                                'Total of %d record(s) were successfully updated',
                                count($socnetIds)));
            } catch (Exception $e) {
                $this->_getSession()->addError(
                        $e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction ()
    {
        $fileName = 'socnet.csv';
        $content = $this->getLayout()
        ->createBlock('socnet/adminhtml_socnet_grid')
        ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction ()
    {
        $fileName = 'socnet.xml';
        $content = $this->getLayout()
        ->createBlock('socnet/adminhtml_socnet_grid')
        ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse ($fileName, $content,
            $contentType = 'application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control',
                'must-revalidate, post-check=0, pre-check=0',
                true);
        $response->setHeader('Content-Disposition',
                'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length',
                strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die();
    }
}