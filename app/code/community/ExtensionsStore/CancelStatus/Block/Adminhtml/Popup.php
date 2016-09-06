<?php
/**
 *
 * @category    ExtensionsStore
 * @package     ExtensionsStore_CancelStatus
 * @author      Extensions Store <admin@extensions-store.com>
 */
class ExtensionsStore_CancelStatus_Block_Adminhtml_Popup extends Mage_Adminhtml_Block_Template {
	
	/**
	 *
	 * @return array
	 */
	public function getCancelledStatuses() {
		$cancelledStatuses = $this->helper('cancelstatus')->getCancelledStatuses();
		return $cancelledStatuses;
	}
	public function getFormAction() {
		$orderId = $this->getOrder ()->getId ();
		return Mage::helper ( 'adminhtml' )->getUrl ( '*/*/cancel', array (
				'order_id' => $orderId 
		) );
	}
	public function getOrder() {
		return Mage::registry ( 'current_order' );
	}
}