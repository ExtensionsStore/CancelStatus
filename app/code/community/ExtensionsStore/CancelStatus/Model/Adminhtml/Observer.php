<?php

/**
 * 
 *
 * @category    ExtensionsStore
 * @package     ExtensionsStore_CancelStatus
 * @author      Extensions Store <admin@extensions-store.com>
 */
class ExtensionsStore_CancelStatus_Model_Adminhtml_Observer {
	/**
	 * Change sales order cancel button
	 *
	 * @see adminhtml_block_html_before
	 * @param Varien_Event_Observer $observer        	
	 * @return Varien_Event_Observer
	 */
	public function adminhtmlBlockHtmlBefore(Varien_Event_Observer $observer) {
		$block = $observer->getBlock ();
		
		if ($block->getNameInLayout () == 'sales_order_edit') {
			$block->updateButton ( 'order_cancel', null, array (
					'label' => Mage::helper ( 'sales' )->__ ( 'Cancel' ),
					'onclick' => 'cancelStatus.showPopup()' 
			) );
		}
		
		return $observer;
	}
	
	/**
	 * Set order cancel status from submitted cancel reason
	 *
	 * @param Varien_Event_Observer $observer        	
	 * @return Varien_Event_Observer
	 */
	public function orderCancelAfter(Varien_Event_Observer $observer) {
		$order = $observer->getOrder ();
		$request = Mage::app ()->getRequest ();
		$cancelStatus = $request->getParam ( 'cancel_status' );
		$cancelledStatuses = Mage::helper('cancelstatus')->getCancelledStatuses();
		
		if ($cancelStatus && in_array ( $cancelStatus, array_keys ( $cancelledStatuses ) )) {
			if ($request->getParam ( 'cancel_comment' )) {
				$statusHistoryComment = $request->getParam ( 'cancel_comment' );
			} else {
				$cancelStatusLabel = $cancelledStatuses [$cancelStatus];
				$adminUser = Mage::getSingleton ( 'admin/session' )->getUser ();
				$firstname = $adminUser->getFirstname();
				$lastname = $adminUser->getLastname();
				$statusHistoryComment = Mage::helper('cancelstatus')->__('Cancel Reason: %s - cancelled by %s %s ', $cancelStatusLabel, $firstname, $lastname);
			}
			$order->addStatusHistoryComment ( $statusHistoryComment, $cancelStatus );
			$order->setStatus ( $cancelStatus );
		}
		
		return $observer;
	}
}