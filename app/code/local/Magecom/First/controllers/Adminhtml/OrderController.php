<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 10/7/15
 * Time: 7:59 PM
 */
class Magecom_First_Adminhtml_OrderController extends Mage_Adminhtml_Controller_Action {

    public  function indexAction(){

        $this->_title($this->__('Sales'))->_title($this->__('Orders Magecom'));
        $this->loadLayout();
        $this->_setActiveMenu('sales/sales');
        $this->_addContent($this->getLayout()->createBlock('magecom_first/adminhtml_sales_order'));
        $this->renderLayout();
    }
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magecom_first/adminhtml_sales_order_grid')->toHtml()
        );
    }

    public function newAction()
    {
        $this->_forward('edit');
    }
    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('posts_data', Mage::getModel('magecom_first/posts')->load($id));
        $this->loadLayout()->_setActiveMenu('order');
        $this->_addContent($this->getLayout()->createBlock('magecom_first/adminhtml_sales_order_edit_form'));
        $this->renderLayout();
    }
    public function saveAction()
    {
        $id = $this->getRequest()->getParam('id');

            try {
                $helper = Mage::helper('magecom_first');
                $model = Mage::getModel('magecom_first/posts');
                $model->setData($data)->setId($id);
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Post was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;

        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('magecom_first/posts')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Post was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

}