/**
 * 
 * @category    ExtensionsStore
 * @package     ExtensionsStore_CancelStatus
 * @author      Extensions Store <admin@extensions-store.com>
 */

var CancelStatus = function($) {

	return {

		closePopup : function() {
			$('#message-popup-window-mask, #cancelstatus-popup-window').hide();
		},

		showPopup : function() {

			$('#message-popup-window-mask, #cancelstatus-popup-window').show();
		}

	}

};

if (!window.jQuery){
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">\x3C/script><script>jQuery.noConflict();</script>');	
	document.write('<script>var cancelStatus = new CancelStatus(jQuery);</script>');	
} else {
	var cancelStatus = new CancelStatus(jQuery);
}