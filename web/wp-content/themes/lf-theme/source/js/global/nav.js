
/**
 * Navigation
 *
 * @package WordPress
 * @since 1.0.0
 */

/* eslint-disable no-lonely-if */
/* eslint-disable no-mixed-operators */
// phpcs:ignoreFile.

jQuery( document ).ready(
	function( $ ) {
		let isMobile = checkMobile();

		function checkMobile() {
			return ( ( $( window ).width() < 1000 ) );
		}

		// Mobile Menu (hidden on desktop).
		$( '.hamburger' ).click(
			function( e ) {
				e.preventDefault();
				if ( ! isMobile ) {
					return;
				}
				$( this ).toggleClass( 'is-active' );
				$( 'body' ).toggleClass( 'menu-is-active' );
				$( '.menu-container-with-search' ).toggleClass( 'is-active' );
			},
		);

		// Desktop Search (hidden on mobile).
		$( '.search-button' ).click(
			( e ) => {
				e.preventDefault();
				if ( isMobile ) {
					return;
				}
				$( '.search-bar' ).toggleClass( 'is-active' );
				$( '.search-input' ).focus();
			},
		);

		$( 'li.menu-item-has-children > a' ).click(
			function( e ) {
				e.preventDefault();
				if ( isMobile ) {
					$( this ).toggleClass( 'is-open' );
					$( this ).parent().children( '.sub-menu:first' ).slideToggle( 500 );
				} else {
					// Stop empty menu parents jumping to top of screen on click.
					if ( $( this ).attr( 'href' ) === '#' ) {
						e.preventDefault();
					}
				}
			},
		);

		// add is-current class to control arrow state.
		$( '.main-navigation > li.menu-item-has-children' ).hover(
			function() {
				if ( ! isMobile ) {
					$( this ).removeClass( 'is-current' );
					$( this ).addClass( 'is-current' );
				}
			}, function() {
				if ( ! isMobile ) {
					$( this ).removeClass( 'is-current' );
				}
			}
		);

		// Keep menu inside viewport.
		$( '.sub-menu li.menu-item-has-children' ).on(
			'mouseenter mouseleave',
			function() {
				if ( $( 'ul', this ).length ) {
					const ul = $( 'ul:first', this ); // pick first ul after el.

					// testing for menu off-screen at right.
					const r = this.getBoundingClientRect().right; // menu from the edge of screen.
					const w = ul.width(); // menu element size.
					const docW = $( '.site-header' ).width(); // size of header / screen.
					const docWidthPadding = docW - 5; // padding value from edge of screen.

					const isOutsideWidth = ( ( r + w ) >= docWidthPadding );

					if ( isOutsideWidth ) {
						$( this ).addClass( 'is-off-right-edge' );
					} else {
						$( this ).removeClass( 'is-off-right-edge' );
					}

					// testing for menu off-screen at bottom.
					const position = $( this ).position();
					const t = position.top;
					const h = ul.height();
					const docH = window.innerHeight;
					const outsideHeight = ( t + h + 100 <= docH );

					if ( ! outsideHeight ) {
					// compare half height again plus buffer.
						if ( ( h / 2 + h + 100 ) >= docH ) {
						// if submenu fits in middle of screen.
							$( this ).addClass( 'is-middle' );
						} else {
						// will be bottom aligned.
							$( this ).addClass( 'is-bottom' );
						}
					} else {
						$( this ).removeClass( 'is-bottom' );
						$( this ).removeClass( 'is-middle' );
					}
				}
			},
		);

		// Resize check for is mobile.
		function resizeHandle() {
			isMobile = checkMobile();
		}

		// Update on resize.
		$( window ).on( 'resize', throttle( resizeHandle, 200, true ) );

		// Generic throttle function.
		// window.throttle = function throttle( callback, wait, immediate = false ) {
		function throttle( callback, wait, immediate = false ) {
			let timeout = null;
			let initialCall = true;
			return function() {
				const callNow = immediate && initialCall;
				const next = () => {
					callback.apply( this, arguments );
					timeout = null;
				};
				if ( callNow ) {
					initialCall = false;
					next();
				}
				if ( ! timeout ) {
					timeout = setTimeout( next, wait );
				}
			};
		}

		// END.
	},
);
