/**
 * Tab Container JS
 *
 * @package WordPress
 * @since 1.0.0
 */

/* eslint-disable no-undef */
/* eslint-disable no-unused-vars */
/* eslint-disable array-callback-return */
/* eslint-disable no-var */

jQuery( document ).ready(
	function( $ ) {
		// activate sticky-js.
		var sticky = new Sticky( '.sticky-element' );
		// if changes.
		sticky.update();

		let topMenu = $( '.tab-container-nav' );

		if ( topMenu.length > 0 ) {
			let lastId;
			let menuItems = topMenu.find( 'a' );
			let scrollItems = menuItems.map(
				function() {
					let item = $( $( this ).attr( 'href' ) );
					if ( item.length ) {
						return item;
					}
				}
			);

			let spaceForHeader;
			if ( $( window ).height() < 616 && $( window ).width() > 514 ) {
				spaceForHeader = 10;
			} else if ( $( window ).width() < 800 ) {
				spaceForHeader = 80;
			} else {
				spaceForHeader = 125;
			}

			let spaceForAdmin;
			var $wpAdminBar = $( '#wpadminbar' );
			if ( $wpAdminBar.length ) {
				spaceForAdmin = 32;
			} else {
				spaceForAdmin = 0;
			}

			// Bind click handler to menu items so we can get a fancy scroll animation.
			menuItems.click(
				function( e ) {
					let href = $( this ).attr( 'href' );
					let offsetTop = href === '#' ? 0 : $( href ).offset()
						.top - spaceForHeader - spaceForAdmin;
					$( 'html, body' )
						.stop()
						.animate(
							{
								scrollTop: offsetTop,
							},
							300
						);
					e.preventDefault();
				}
			);

			// Bind to scroll.
			$( window ).scroll(
				function() {
					let fromTop = $( this ).scrollTop();

					// Get id of current scroll item, add 20 for padding.
					let cur = scrollItems.map(
						function() {
							if ( $( this ).offset().top < fromTop + spaceForHeader + spaceForAdmin + 20 ) {
								return this;
							}
						}
					);

					// Get the id of the current element.
					cur = cur[ cur.length - 1 ];
					let id = cur && cur.length ? cur[ 0 ].id : '';

					if ( lastId !== id ) {
						lastId = id;
						// Set/remove active class.
						menuItems
							.parent()
							.removeClass( 'is-active' )
							.end()
							.filter( "[href='#" + id + "']" )
							.parent()
							.addClass( 'is-active' );
						if ( id ) {
							if ( history.pushState ) {
								window.history.replaceState(
									null,
									null,
									'#' + id
								);
							} else {
								// IE9, IE8, etc.
								window.location.hash = '#!' + id;
							}
						} else {
							removeHash();
						}
					}
				}
			);

			function removeHash() {
				let scrollV, scrollH,
					loc = window.location;
				if ( 'pushState' in history ) {
					history.pushState( '', document.title, loc.pathname + loc.search );
				} else {
					// Prevent scrolling by storing the page's current scroll offset.
					scrollV = document.body.scrollTop;
					scrollH = document.body.scrollLeft;

					loc.hash = '';

					// Restore the scroll offset, should be flicker free.
					document.body.scrollTop = scrollV;
					document.body.scrollLeft = scrollH;
				}
			}
		}

		// looks for nav item and checks its in view.
		function navInView() {
			var currentItem = $( '.tab-container-nav-item.is-active' );
			if ( currentItem.length ) {
				currentItem[ 0 ].scrollIntoView(
					{
						block: 'nearest',
					}
				);
			}
		}

		// Bind to scroll. TODO: Throttle.
		$( window ).scroll(
			function() {
				navInView();
			}
		);
	}
);
