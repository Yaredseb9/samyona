import Fetcher from '../utils/fetcher';

( function ( $ ) {
	WPHB_Admin.cloudflare = {
		module: 'cloudflare',

		init() {
			const self = this,
				cfSetExpiryButton = $( '#set-cf-expiry-button' ),
				cfSelector = $( '#set-expiry-all' );

			/** @member {Array} wphb */
			if ( wphb.cloudflare.is.connected ) {
				cfSetExpiryButton.on( 'click', ( e ) => {
					e.preventDefault();
					self.setExpiry.call( self, cfSelector );
				} );
			}

			return this;
		},

		setExpiry( selector ) {
			const spinner = $( '.wphb-expiry-changes .spinner' );
			const button = $( '.wphb-expiry-changes input[type="submit"]' );

			spinner.addClass( 'visible' );
			button.addClass( 'disabled' );

			Fetcher.cloudflare
				.setExpiration( $( selector ).val() )
				.then( ( response ) => {
					//window.location.reload();
					$( '#wphb-expiry-change-notice' ).hide();
					spinner.removeClass( 'visible' );
					button.removeClass( 'disabled' );

					if ( 'undefined' !== typeof response && response.success ) {
						WPHB_Admin.notices.show();
					} else {
						WPHB_Admin.notices.show(
							wphb.strings.errorSettingsUpdate,
							'error'
						);
					}
				} );
		},
	};
} )( jQuery );
