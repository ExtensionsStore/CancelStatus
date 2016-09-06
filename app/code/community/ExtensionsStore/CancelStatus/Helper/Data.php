<?php

/**
 * Standard helper
 *
 * @category    ExtensionsStore
 * @package     ExtensionsStore_CancelStatus
 * @author      Extensions Store <admin@extensions-store.com>
 */

class ExtensionsStore_CancelStatus_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Get array of cancelled statuses codes and labels
	 * @return array
	 */
	public function getCancelledStatuses(){
		$cancelledState = Mage_Sales_Model_Order::STATE_CANCELED;
		$stateStatuses = $this->getOrder()->getConfig ()->getStateStatuses ( $cancelledState );
		$cancelledStatuses = array();
		ksort($stateStatuses);
		$cancelledStatuses = $stateStatuses;
		//remove fraud_order status per KC 8/9
		unset($cancelledStatuses['fraud_order']);
		//make default canceled last
		unset($cancelledStatuses['canceled']);
		$cancelledStatuses['canceled'] = $stateStatuses['canceled'];
		return $cancelledStatuses;
	}
	
	/**
	 * 
	 * @return Mage_Sales_Model_Order
	 */
	public function getOrder(){
		return Mage::registry('current_order');
	}
}