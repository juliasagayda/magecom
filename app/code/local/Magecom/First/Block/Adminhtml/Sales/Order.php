<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 10/5/15
 * Time: 9:18 PM
 */
class Magecom_First_Block_Adminhtml_Sales_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'magecom_first';
        $this->_controller = 'adminhtml_sales_order';
        $this->_headerText = Mage::helper('magecom_first')->__('Orders - Magecom');

        parent::__construct();
        $this->_removeButton('add');
    }
}