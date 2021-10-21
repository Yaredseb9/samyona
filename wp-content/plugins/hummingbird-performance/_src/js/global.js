/* global wphbGlobal */
/* global ajaxurl */

( function () {
	'use strict';

	const WPHBGlobal = {
		ajaxurl: null,
		menuButton: document.querySelector(
			'#wp-admin-bar-wphb-clear-cache > a'
		),
		menuButtonNetworkWide: document.querySelector(
			'#wp-admin-bar-wphb-clear-cache-network-wide > a'
		),
		noticeButton: document.getElementById(
			'wp-admin-notice-wphb-clear-cache'
		),

		init() {
			if ( wphbGlobal ) {
				this.ajaxurl = wphbGlobal.ajaxurl;
			} else {
				this.ajaxurl = ajaxurl;
			}

			if ( this.menuButton ) {
				this.menuButton.addEventListener( 'click', () =>
					this.post( WPHBGlobal.ajaxurl, 'wphb_front_clear_cache' )
				);
			}

			if ( this.menuButtonNetworkWide ) {
				this.menuButtonNetworkWide.addEventListener( 'click', () => {
					if ( 'undefined' === typeof window.WPHB_Admin ) {
						window.location.href =
							'/wp-admin/network/admin.php?page=wphb-caching&update=open-ccnw';
						return;
					}

					window.SUI.openModal(
						'ccnw-modal',
						'wpbody',
						'ccnw-clear-now'
					);
				} );
			}

			if ( this.noticeButton ) {
				this.noticeButton.addEventListener( 'click', () =>
					this.post( WPHBGlobal.ajaxurl, 'wphb_global_clear_cache' )
				);
			}
		},

		post: ( url, action ) => {
			const xhr = new XMLHttpRequest();
			xhr.open( 'POST', url + '?action=' + action );
			xhr.onload = function () {
				if ( xhr.status === 200 ) {
					location.reload();
				}
			};
			xhr.send();
		},
	};

	document.addEventListener( 'DOMContentLoaded', function () {
		WPHBGlobal.init();
	} );
} )();
