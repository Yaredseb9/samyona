/* global WPHB_Admin */
/* global wphbDashboardStrings */
/* global wphbPerformanceStrings */

import Fetcher from '../utils/fetcher';

( function ( $ ) {
	WPHB_Admin.dashboard = {
		module: 'dashboard',

		init() {
			if ( wphbDashboardStrings ) this.strings = wphbDashboardStrings;

			$( '.wphb-performance-report-item' ).click( function () {
				const url = $( this ).data( 'performance-url' );
				if ( url ) {
					location.href = url;
				}
			} );

			return this;
		},

		/**
		 * Skip quick setup.
		 *
		 * @param {boolean} reload  Reload the page after skipping setup.
		 */
		skipSetup( reload = true ) {
			Fetcher.common.call( 'wphb_dash_skip_setup' ).then( () => {
				if ( reload ) {
					window.location.reload();
				}
			} );
		},

		/**
		 * Run performance test after quick setup.
		 */
		runPerformanceTest() {
			window.SUI.closeModal(); // Hide tracking-modal.
			// Show performance test modal
			window.SUI.openModal(
				'run-performance-onboard-modal',
				'wpbody-content',
				undefined,
				false
			);

			window.WPHB_Admin.Tracking.track( 'plugin_scan_started', {
				score_mobile_previous:
					wphbPerformanceStrings.previousScoreMobile,
				score_desktop_previous:
					wphbPerformanceStrings.previousScoreDesktop,
			} );

			this.skipSetup( false );

			// Run performance test
			window.WPHB_Admin.getModule( 'performance' ).scanner.start();
		},

		hideUpgradeSummary: () => {
			window.SUI.closeModal();
			Fetcher.common.call( 'wphb_hide_upgrade_summary' );
		},
	};
} )( jQuery );
