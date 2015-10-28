<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 10/7/15
 * Time: 7:59 PM
 */
class Magecom_First_Adminhtml_OrderController extends Mage_Adminhtml_Controller_Action {

    public  function indexAction(){
//        $this->loadLayout();
//        $block = Mage::app()->getLayout()
//            ->createBlock('core/text', 'example')
//            ->setText('Julia');
//        $this->_addContent($block)->renderLayout();
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
}