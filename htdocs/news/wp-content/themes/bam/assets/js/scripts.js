jQuery(document).ready( function() {

	// Tabs Widget
	if ( typeof jQuery.fn.tabs === "function" ) {
		jQuery( ".bm-tabs-wdt" ).tabs();
	}

	// FitVids
	if ( typeof jQuery.fn.fitVids !== 'undefined' ) {
		jQuery(".fitvids-video").fitVids();
	}

});