(function($) {
	"use strict";
	var THEMEMASCOT = {};

	/* ---------------------------------------------------------------------- */
	/* -------------------------- Declare Variables ------------------------- */
	/* ---------------------------------------------------------------------- */
	var $document = $(document);
	var $document_body = $(document.body);
	var $window = $(window);
	var $html = $('html');
	var $body = $('body');
	var $wrapper = $('#wrapper');
	var $header = $('#header');
	var $header_nav = $('#header .header-nav');
	var $header_navbar_scrolltofixed = $('body.tm-enable-navbar-scrolltofixed');
	var $footer = $('#footer');
	var $sections = $('.vc_row.vc-row-tm-parent-section');
	var windowHeight = $window.height();

	var $gallery_isotope = $(".isotope-layout");

	var gallery_isotope_filter_string = ".isotope-layout-filter";
	var $gallery_isotope_filter_parent = $( gallery_isotope_filter_string );
	var gallery_isotope_filter = gallery_isotope_filter_string + " a";
	var $gallery_isotope_filter_first_child = $( gallery_isotope_filter + ":eq(0)");

	var gallery_isotope_sorter_string = ".isotope-layout-sorter";
	var $gallery_isotope_sorter_parent = $( gallery_isotope_sorter_string );
	var gallery_isotope_sorter = ".isotope-layout-sorter a";

	THEMEMASCOT.isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (THEMEMASCOT.isMobile.Android() || THEMEMASCOT.isMobile.BlackBerry() || THEMEMASCOT.isMobile.iOS() || THEMEMASCOT.isMobile.Opera() || THEMEMASCOT.isMobile.Windows());
		}
	};

	function admin_bar_height() {
		var admin_bar_height = 0;
		if( $body.hasClass('admin-bar') ) {
			admin_bar_height = $('#wpadminbar').height();
		}
		return admin_bar_height;
	}

	THEMEMASCOT.isRTL = {
		check: function() {
			if( $( "html" ).attr("dir") === "rtl" ) {
				return true;
			} else {
				return false;
			}
		}
	};

	THEMEMASCOT.isLTR = {
		check: function() {
			if( $( "html" ).attr("dir") !== "rtl" ) {
				return true;
			} else {
				return false;
			}
		}
	};

	THEMEMASCOT.urlParameter = {
		get: function(sParam) {
			var sPageURL = decodeURIComponent(window.location.search.substring(1)),
				sURLVariables = sPageURL.split('&'),
				sParameterName,
				i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');

				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : sParameterName[1];
				}
			}
		}
	};

	THEMEMASCOT.initialize = {

		init: function() {
			THEMEMASCOT.initialize.TM_yith_wcwl();
			THEMEMASCOT.initialize.TM_navbar_scrolltofixed_hide();
			THEMEMASCOT.initialize.TM_toggleNavSearchIcon();
			THEMEMASCOT.initialize.TM_fixedFooter();
			THEMEMASCOT.initialize.TM_ddslick();
			THEMEMASCOT.initialize.TM_sliderRange();
			THEMEMASCOT.initialize.TM_platformDetect();
			THEMEMASCOT.initialize.TM_customDataAttributes();
			THEMEMASCOT.initialize.TM_parallaxBgInit();
			THEMEMASCOT.initialize.TM_resizeFullscreen();
			THEMEMASCOT.initialize.TM_CustomColumnsHolderResponsiveStyler();
			THEMEMASCOT.initialize.TM_equalHeightDivs();
			THEMEMASCOT.initialize.TM_wow();
		},


		/* ---------------------------------------------------------------------- */
		/* ----------------------- Hide Navbar on Scroll Down  ------------------ */
		/* ---------------------------------------------------------------------- */
		TM_yith_wcwl: function() {
			$('.yith-wcwl-add-to-wishlist').each(function(){
				var $this = $(this);
				var $yithWcwlAddButton            = $this.find('.yith-wcwl-add-button');
				var $yithWcwlWishlistaddedbrowse  = $this.find('.yith-wcwl-wishlistaddedbrowse');
				var $yithWcwlWishlistexistsbrowse = $this.find('.yith-wcwl-wishlistexistsbrowse');

				var $yithWcwlAddButtonLink = $yithWcwlAddButton.find('a');
				$yithWcwlAddButtonLink.attr('title',$yithWcwlAddButtonLink.text().trim());

				$yithWcwlWishlistaddedbrowse.find('a').attr('title',$yithWcwlWishlistaddedbrowse.find('.feedback').text().trim());
				$yithWcwlWishlistexistsbrowse.find('a').attr('title',$yithWcwlWishlistexistsbrowse.find('.feedback').text().trim());

				$this.find('a').on('click',function(){
					var $self = $(this);
					$self.toggleClass('active');
					setTimeout(function(){
						$self.toggleClass('active');
					},1000);
				});
			});
		},


		/* ---------------------------------------------------------------------- */
		/* ----------------------- Hide Navbar on Scroll Down  ------------------ */
		/* ---------------------------------------------------------------------- */
		TM_navbar_scrolltofixed_hide: function() {
			if( !$header_navbar_scrolltofixed.hasClass("tm-enable-navbar-always-visible-on-scroll") ) {
				var $navbar_scrolltofixed = $header_navbar_scrolltofixed.find('.navbar-scrolltofixed');
				if( $navbar_scrolltofixed.length > 0 ){
					var prevScrollpos  = $window.scrollTop();
					var $header_height = $header.height();
					var $navbar_height = $navbar_scrolltofixed.height();
					$window.on( 'scroll', function() {
						var currentScrollPos = $window.scrollTop();
						if (prevScrollpos > currentScrollPos) {
							$navbar_scrolltofixed.css('top', 0);
						} else {
							if( $document.scrollTop() > $header_height + 200 ) {
								$navbar_scrolltofixed.css('top', '-' + $navbar_height + 'px');
							}
						}
						prevScrollpos = currentScrollPos;
					});
				}
			}
		},



		/* ---------------------------------------------------------------------- */
		/* ------------------------ portfolio-sticky-side  --------------------- */
		/* ---------------------------------------------------------------------- */
		TM_portfolioStickyScrollMagic: function() {
			//Sticky Side Text in Shop Single Product Page
			var portfolio_sticky_parent_div = '.portfolio-sticky-side-text';
			var scroll_magic_controller = null;
			var width = $window.width();

			function initScrollMagic(){
				// init controller
				scroll_magic_controller = new ScrollMagic.Controller();
				var pinned_obj = ( portfolio_sticky_parent_div + ' .portfolio-details');
				var start_from = $(portfolio_sticky_parent_div).offset().top - $header_nav.outerHeight(true) - 30;
				var duration = $('.portfolio-container').outerHeight(true) - $(pinned_obj).outerHeight(true);
				var scene = new ScrollMagic.Scene({
					offset: start_from,
					duration: duration // pin the element for a total of 400px
				})
				.setPin(pinned_obj); // the element we want to pin
				// Add Scene to ScrollMagic Controller
				scroll_magic_controller.addScene(scene);
			}

			if( $(portfolio_sticky_parent_div).length > 0 ) {
				//767 is bootstrap mobile breakpoint
				if( width >= 768) {
					setTimeout(initScrollMagic, 2000);
				}
				$window.resize(function(){
					//reset values when page size changes
					//my scroll magic is used on multiple pages, duration depends on item heights
					width = $window.width();

					if( width < 768 ) {
						//you can just use 'controller' here as it will return true or false, you dont need all the conditionals
						if (scroll_magic_controller) {
							scroll_magic_controller = scroll_magic_controller.destroy(true)
						}
					} else if ( width > 767 ) {
						//same here 
						if ( !scroll_magic_controller ) {
							initScrollMagic()
						}
					}
				});
			}
		},

		/* ---------------------------------------------------------------------------- */
		/* -------------------------------- ScrollMagic ------------------------------- */
		/* ---------------------------------------------------------------------------- */
		TM_shopSingleStickyScrollMagic: function() {
			//Sticky Side Text in Shop Single Product Page
			var single_product_sticky_parent_div = '.single-product-sticky-side-text';
			var scroll_magic_controller = null;
			var width = $window.width();

			function initScrollMagic(){
				// init controller
				scroll_magic_controller = new ScrollMagic.Controller();
				var pinned_obj = ( single_product_sticky_parent_div + ' .summary.entry-summary');
				var start_from = $(single_product_sticky_parent_div).offset().top - $header_nav.outerHeight(true) - 30;
				var duration = $('.woocommerce-product-gallery').outerHeight(true) - $(pinned_obj).outerHeight(true);
				var scene = new ScrollMagic.Scene({
					offset: start_from,
					duration: duration // pin the element for a total of 400px
				})
				.setPin(pinned_obj); // the element we want to pin
				// Add Scene to ScrollMagic Controller
				scroll_magic_controller.addScene(scene);
			}

			if( $(single_product_sticky_parent_div).length > 0 ) {
				//767 is bootstrap mobile breakpoint
				if( width >= 768) {
					setTimeout(initScrollMagic, 2000);
				}
				$window.resize(function(){
					//reset values when page size changes
					//my scroll magic is used on multiple pages, duration depends on item heights
					width = $window.width();

					if( width < 768 ) {
						//you can just use 'controller' here as it will return true or false, you dont need all the conditionals
						if (scroll_magic_controller) {
							scroll_magic_controller = scroll_magic_controller.destroy(true)
						}
					} else if ( width > 767 ) {
						//same here 
						if ( !scroll_magic_controller ) {
							initScrollMagic()
						}
					}
				});
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ------------------------ Toggle Nav Search Icon  --------------------- */
		/* ---------------------------------------------------------------------- */
		TM_toggleNavSearchIcon: function() {

			$document_body.on('click', '#top-nav-search-btn', function(e) {
				$('#top-nav-search-form').stop(true,true).fadeIn(100).find('input[type=text]').focus();
				return false;
			});
			$document_body.on('click', '#close-search-btn', function(e) {
				$('#top-nav-search-form').stop(true,true).fadeOut(100);
				return false;
			});
		},

		/* ---------------------------------------------------------------------- */
		/* ------------------------------ Fixed Footer  ------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_fixedFooter: function() {
			var $fixed_footer = $('.fixed-footer');
			var $boxed_layout = $('body.tm-boxed-layout');
			var margin_bottom = $fixed_footer.height();

			if( $fixed_footer.length > 0 ){
				if( $window.width() >= 1200 ) {
				} else {
					margin_bottom = 0;
				}

				if( $boxed_layout.length > 0 ) {
					var boxed_layout_padding_bottom = $boxed_layout.css('padding-bottom');
					$fixed_footer.css('bottom', boxed_layout_padding_bottom );
				}
				$('body.has-fixed-footer .main-content').css('margin-bottom', margin_bottom);
			}
		},


		/* ---------------------------------------------------------------------- */
		/* -------------------------------- ddslick  ---------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_ddslick: function() {
			var $ddslick = $("select.ddslick");
			if( $ddslick.length > 0 ) {
				$ddslick.each(function(){
					var name =  $(this).attr('name');
					var id = $(this).attr('id');
					$("#"+id).ddslick({
						width: '100%',
						imagePosition: "left",
						onSelected: function(selectedData){
							$("#"+id+ " .dd-selected-value").prop ('name', name);
						 }  
					});
				});
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ----------------------------- slider range  -------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_sliderRange: function() {
			var $slider_range = $(".slider-range");
			if( $slider_range.length > 0 ) {
				$slider_range.each(function(){
					var id = $(this).attr('id');
					var target_id = $(this).data('target');
					$( "#" + target_id ).slider({
					  range: "max",
					  min: 2001,
					  max: 2016,
					  value: 2010,
					  slide: function( event, ui ) {
						$( "#" + id ).val( ui.value );
					  }
					});
					$( "#" + id ).val( $( "#" + target_id ).slider( "value" ) );
				});
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ------------------------------ Preloader  ---------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_preLoaderClickDisable: function() {
			var $preloader = $('#preloader');
			$preloader.children('#disable-preloader').on('click', function(e) {
				$preloader.fadeOut();
				return false;
			});
		},

		TM_preLoaderOnLoad: function() {
			var $preloader = $('#preloader');
			if( $preloader.length > 0 ) {
				$preloader.delay(200).fadeOut('slow');
			}
		},


		/* ---------------------------------------------------------------------- */
		/* ------------------------------- Platform detect  --------------------- */
		/* ---------------------------------------------------------------------- */
		TM_platformDetect: function() {
			if (THEMEMASCOT.isMobile.any()) {
				$html.addClass("mobile");
			} else {
				$html.addClass("no-mobile");
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ------------------------------ Hash Forwarding  ---------------------- */
		/* ---------------------------------------------------------------------- */
		TM_hashForwarding: function() {
			if (window.location.hash) {
				var hash_offset = $(window.location.hash).offset().top;
				$("html, body").animate({
					scrollTop: hash_offset
				});
			}
		},


		/* ---------------------------------------------------------------------- */
		/* ----------------------- Background image, color ---------------------- */
		/* ---------------------------------------------------------------------- */
		TM_customDataAttributes: function() {
			$('[data-tm-bg-color]').each(function() {
				$(this).css("cssText", "background: " + $(this).data("tm-bg-color") + " !important;");
			});
			$('[data-tm-bg-img]').each(function() {
				$(this).css('background-image', 'url(' + $(this).data("tm-bg-img") + ')');
			});
			$('[data-tm-text-color]').each(function() {
				$(this).css('color', $(this).data("tm-text-color"));
			});
			$('[data-tm-font-size]').each(function() {
				$(this).css('font-size', $(this).data("tm-font-size"));
			});
			$('[data-tm-opacity]').each(function() {
				$(this).css('opacity', $(this).data("tm-opacity"));
			});
			$('[data-tm-height]').each(function() {
				$(this).css('height', $(this).data("tm-height"));
			});
			$('[data-tm-width]').each(function() {
				$(this).css('width', $(this).data("tm-width"));
			});
			$('[data-tm-border]').each(function() {
				$(this).css('border', $(this).data("tm-border"));
			});
			$('[data-tm-margin-top]').each(function() {
				$(this).css('margin-top', $(this).data("tm-margin-top"));
			});
			$('[data-tm-margin-right]').each(function() {
				$(this).css('margin-right', $(this).data("tm-margin-right"));
			});
			$('[data-tm-margin-bottom]').each(function() {
				$(this).css('margin-bottom', $(this).data("tm-margin-bottom"));
			});
			$('[data-tm-margin-left]').each(function() {
				$(this).css('margin-left', $(this).data("tm-margin-left"));
			});
		},



		/* ---------------------------------------------------------------------- */
		/* -------------------------- Background Parallax ----------------------- */
		/* ---------------------------------------------------------------------- */
		TM_parallaxBgInit: function() {
			if (!THEMEMASCOT.isMobile.any() && $window.width() >= 800 ) {
				$('.parallax').each(function() {
					var data_parallax_ratio = ( $(this).data("parallax-ratio") === undefined ) ? '0.5': $(this).data("parallax-ratio");
					$(this).parallax("50%", data_parallax_ratio);
				});
			} else {
				$('.parallax').addClass("mobile-parallax");
			}
		},

		/* ---------------------------------------------------------------------- */
		/* --------------------------- Home Resize Fullscreen ------------------- */
		/* ---------------------------------------------------------------------- */
		TM_resizeFullscreen: function() {
			var $fullscreen = $('.section-fullscreen');
			if ( $window.width() >= 991 ) {
				var windowHeight = $window.height();
				$fullscreen.height( windowHeight );
			} else {
				$fullscreen.css('height', 'auto');
			}
		},

		
		/* ---------------------------------------------------------------------- */
		/* ---------------------------- Wow initialize  ------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_wow: function() {
			var wow = new WOW({
				mobile: false // trigger animations on mobile devices (default is true)
			});
			wow.init();
		},

	
		/* ---------------------------------------------------------------------- */
		/* --------------- Custom Columns Holder Responsive Style --------------- */
		/* ---------------------------------------------------------------------- */
		TM_CustomColumnsHolderResponsiveStyler: function() {

			var customColumnsHolder = $('.tm-sc-custom-columns-holder');

			if(customColumnsHolder.length){
				customColumnsHolder.each(function() {
					var thisElementsHolder = $(this),
						customColumnsHolderItem = thisElementsHolder.children('.tm-sc-custom-columns-holder-item'),
						style = '',
						responsiveStyle = '';

					customColumnsHolderItem.each(function() {
						var thisItem = $(this),
							itemClass = '',

							down_1199 = '',
							down_991 = '',
							down_767 = '',
							down_575 = '',

							only_992_1199 = '',
							only_768_991 = '',
							only_576_767 = '',
							
							up_1200 = '',
							up_992 = '',
							up_768 = '',
							up_576 = '';

						if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
							itemClass = thisItem.data('item-class');
						}


						//media-breakpoint-down
						if (typeof thisItem.data('1199-down') !== 'undefined' && thisItem.data('1199-down') !== false) {
							down_1199 = thisItem.data('1199-down');
						}
						if (typeof thisItem.data('991-down') !== 'undefined' && thisItem.data('991-down') !== false) {
							down_991 = thisItem.data('991-down');
						}
						if (typeof thisItem.data('767-down') !== 'undefined' && thisItem.data('767-down') !== false) {
							down_767 = thisItem.data('767-down');
						}
						if (typeof thisItem.data('575-down') !== 'undefined' && thisItem.data('575-down') !== false) {
							down_575 = thisItem.data('575-down');
						}


						//media-breakpoint-only
						if (typeof thisItem.data('992-1199') !== 'undefined' && thisItem.data('992-1199') !== false) {
							only_992_1199 = thisItem.data('992-1199');
						}
						if (typeof thisItem.data('768-991') !== 'undefined' && thisItem.data('768-991') !== false) {
							only_768_991 = thisItem.data('768-991');
						}
						if (typeof thisItem.data('576-767') !== 'undefined' && thisItem.data('576-767') !== false) {
							only_576_767 = thisItem.data('576-767');
						}


						//media-breakpoint-up
						if (typeof thisItem.data('1200-up') !== 'undefined' && thisItem.data('1200-up') !== false) {
							up_1200 = thisItem.data('1200-up');
						}
						if (typeof thisItem.data('992-up') !== 'undefined' && thisItem.data('992-up') !== false) {
							up_992 = thisItem.data('992-up');
						}
						if (typeof thisItem.data('768-up') !== 'undefined' && thisItem.data('768-up') !== false) {
							up_768 = thisItem.data('768-up');
						}
						if (typeof thisItem.data('576-up') !== 'undefined' && thisItem.data('576-up') !== false) {
							up_576 = thisItem.data('576-up');
						}



						if(down_1199.length || down_991.length || down_767.length || down_575.length || only_992_1199.length || only_768_991.length || only_576_767.length|| up_1200.length || up_992.length || up_768.length || up_576.length) {

							if(down_1199.length) {
								responsiveStyle += "@media (max-width: 1199.98px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+down_1199+" !important; } }";
							}
							if(down_991.length) {
								responsiveStyle += "@media (max-width: 991.98px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+down_991+" !important; } }";
							}
							if(down_767.length) {
								responsiveStyle += "@media (max-width: 767.98px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+down_767+" !important; } }";
							}
							if(down_575.length) {
								responsiveStyle += "@media (max-width: 575.98px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+down_575+" !important; } }";
							}



							if(only_992_1199.length) {
								responsiveStyle += "@media (min-width: 992px) and (max-width: 1199.98px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+only_992_1199+" !important; } }";
							}
							if(only_768_991.length) {
								responsiveStyle += "@media (min-width: 768px) and (max-width: 991.98px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+only_768_991+" !important; } }";
							}
							if(only_576_767.length) {
								responsiveStyle += "@media (min-width: 576px) and (max-width: 767.98px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+only_576_767+" !important; } }";
							}



							if(up_1200.length) {
								responsiveStyle += "@media (min-width: 1200px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+up_1200+" !important; } }";
							}
							if(up_992.length) {
								responsiveStyle += "@media (min-width: 992px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+up_992+" !important; } }";
							}
							if(up_768.length) {
								responsiveStyle += "@media (min-width: 768px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+up_768+" !important; } }";
							}
							if(up_576.length) {
								responsiveStyle += "@media (min-width: 576px) {.tm-sc-custom-columns-holder-item .item-content."+itemClass+" { padding: "+up_576+" !important; } }";
							}
						}
					});

					if(responsiveStyle.length) {
						style = '<style type="text/css" data-type="mascot_style_handle_shortcodes_custom_css">'+responsiveStyle+'</style>';
					}

					if(style.length) {
						$('head').append(style);
					}
				});
			}
		},

	
		/* ---------------------------------------------------------------------- */
		/* ---------------------------- equalHeights ---------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_equalHeightDivs: function() {
			/* equal heigh */
			var $equal_height = $('.equal-height');
			if( $equal_height.length > 0 ) {
				$equal_height.children('div').css('min-height', 'auto');
				if ( $window.width() >= 768 ) {
					$equal_height.equalHeights();
				} else {
					$equal_height.css('height', 'auto');
				}
			}

			/* equal heigh inner div */
			var $equal_height_inner = $('.equal-height-inner');
			if( $equal_height_inner.length > 0 ) {
				$equal_height_inner.children('div').css('min-height', 'auto');
				$equal_height_inner.children('div').children('div').css('min-height', 'auto');
				$equal_height_inner.equalHeights();
				$equal_height_inner.children('div').each(function() {
					if ( $window.width() >= 768 ) {
						$(this).children('div').css('min-height', $(this).css('min-height'));
					} else {
						$(this).children('div').css('height', 'auto');
					}
				});
			}

			/* pricing-table equal heigh*/
			var $equal_height_pricing_table = $('.equal-height-pricing-table');
			if( $equal_height_pricing_table.length > 0 ) {
				$equal_height_pricing_table.children('div').css('min-height', 'auto');
				$equal_height_pricing_table.children('div').children('div').css('min-height', 'auto');
				$equal_height_pricing_table.equalHeights();
				$equal_height_pricing_table.children('div').each(function() {
					$(this).children('div').css('min-height', $(this).css('min-height'));
				});
			}
		}

	};


	THEMEMASCOT.header = {

		init: function() {

			var t = setTimeout(function() {
				THEMEMASCOT.header.TM_VC_RTL();
				THEMEMASCOT.header.TM_VC_Vertical();
				THEMEMASCOT.header.TM_VC_Boxed_Fullwidth_Fit_Container();
				THEMEMASCOT.header.TM_verticalNavHeaderPadding();
				THEMEMASCOT.header.TM_Memuzord_Megamenu();
				THEMEMASCOT.header.TM_TopNav_Dropdown_Position();
				THEMEMASCOT.header.TM_fullscreenMenu();
				THEMEMASCOT.header.TM_sidePanelReveal();
				THEMEMASCOT.header.TM_scroolToTopOnClick();
				THEMEMASCOT.header.TM_scrollToFixed();
				THEMEMASCOT.header.TM_topnavAnimate();
				THEMEMASCOT.header.TM_scrolltoTarget();
				THEMEMASCOT.header.TM_navLocalScorll();
				THEMEMASCOT.header.TM_menuCollapseOnClick();
				THEMEMASCOT.header.TM_homeParallaxFadeEffect();
			}, 0);

		},


		/* ---------------------------------------------------------------------- */
		/* ------------------------- VC RTL Support ---------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_VC_RTL: function() {
			if( jQuery('html').attr('dir') == 'rtl' ){
				jQuery('[data-vc-full-width="true"]').each( function(i,v){
					var $this = jQuery(this);
					setTimeout(function(){
						//$this.css('right' , $this.css('left') ).css( 'left' , 'auto');
					},1000);
				});
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ----------------------- VC Vertical Support -------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_VC_Vertical: function() {
			if ( $body.hasClass("tm-vertical-nav") && $window.width() >= 1200 ) {
				$window.off("resize.vcRowBehaviour");
				jQuery('[data-vc-stretch-content="true"]').each( function(i,v){
					var $el = jQuery(this);
					setTimeout(function(){
						var $el_full = $el.next(".vc_row-full-width");
						if ($el_full.length || ($el_full = $el.parent().next(".vc_row-full-width")), $el_full.length) {
							var padding, paddingRight, el_margin_left = parseInt($el.css("margin-left"), 10),
								el_margin_right = parseInt($el.css("margin-right"), 10),
								offset = 0 - $el_full.offset().left - el_margin_left,
								width = $(window).width();
							
							var header_width = $header.css('width');
							header_width = parseInt(header_width, 10);
							header_width = Math.abs(header_width);

							//now fix width for vertical nav
							width = width - header_width;
							offset = offset + header_width;
							
							if ("rtl" === $el.css("direction") && (offset -= $el_full.width(), offset += width, offset += el_margin_left, offset += el_margin_right), 
								$el.css({
									position: "relative",
									left: offset,
									"box-sizing": "border-box",
									width: width
								}), !$el.data("vcStretchContent")) "rtl" === $el.css("direction") ? ((padding = offset) < 0 && (padding = 0), (paddingRight = offset) < 0 && (paddingRight = 0)) : ((padding = -1 * offset) < 0 && (padding = 0), (paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right) < 0 && (paddingRight = 0)), $el.css({
								"padding-left": padding + "px",
								"padding-right": paddingRight + "px"
							});
						}
					}, 1000);
				});
			}
		},


		/* ---------------------------------------------------------------------- */
		/* ------------------------- VC BOXED full-width Support ---------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_VC_Boxed_Fullwidth_Fit_Container: function() {
			if ($body.hasClass("tm-boxed-layout")) {
				jQuery('[data-vc-stretch-content="true"]').each( function(i,v){
					var $this = jQuery(this);
					var padding_left_right = 15;
					var left = $this.css('left');
					left = parseInt(left, 10);
					left = Math.abs(left) - padding_left_right;
					$this.css('padding-left' , left + 'px').css( 'padding-right' , left + 'px');
				});
			}
		},


		/* ---------------------------------------------------------------------- */
		/* ------------------------- menufullpage ---------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_fullscreenMenu: function() {
			var $menufullpage = $('.menu-full-page .fullpage-nav-toggle');
			if( $menufullpage.length > 0 ) {
				$menufullpage.menufullpage();
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ------------------------- Side Push Panel ---------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_sidePanelReveal: function() {
			if( $('.side-panel-trigger').length > 0 ) {
				$body.addClass("has-side-panel side-panel-right");
			}
			$('.side-panel-trigger').on('click', function(e) {
				$body.toggleClass("side-panel-open");
				if ( THEMEMASCOT.isMobile.any() ) {
					$body.toggleClass("overflow-hidden");
				}
				return false;
			});

			$('.has-side-panel .side-panel-body-overlay').on('click', function(e) {
				$body.toggleClass("side-panel-open");
				return false;
			});

			//sitebar tree
			$('.side-panel-nav .nav .tree-toggler').on('click', function(e) {
				$(this).parent().children('ul.tree').toggle(300);
			});
		},

		/* ---------------------------------------------------------------------- */
		/* ------------------------------- scrollToTop  ------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_scroolToTop: function() {
			if ($window.scrollTop() > 600) {
				$('.scrollToTop').fadeIn();
			} else {
				$('.scrollToTop').fadeOut();
			}
		},

		TM_scroolToTopOnClick: function() {
			$document_body.on('click', '.scrollToTop', function(e) {
				$('html, body').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		},


		/* ---------------------------------------------------------------------------- */
		/* --------------------------- One Page Nav close on click -------------------- */
		/* ---------------------------------------------------------------------------- */
		TM_menuCollapseOnClick: function() {
			$document.on('click', '.onepage-nav a', function(e) {
				if (/#/.test(this.href)) {
					if($(this).find('.indicator').length == 0) {
						$('.showhide').trigger('click');
					}
				}
			});
		},

		/* ---------------------------------------------------------------------- */
		/* ----------- Active Menu Item on Reaching Different Sections ---------- */
		/* ---------------------------------------------------------------------- */
		TM_activateMenuItemOnReach: function() {
			var $onepage_nav = $('.onepage-nav');
			if( $onepage_nav.length > 0 ) {
				var cur_pos = $window.scrollTop() + 2;
				var nav_height = $onepage_nav.outerHeight();
				$sections.each(function() {
					var top = $(this).offset().top - nav_height - 80,
						bottom = top + $(this).outerHeight();

					if (cur_pos >= top && cur_pos <= bottom) {
						$onepage_nav.find('a').parent().removeClass('current').removeClass('active');
						$sections.removeClass('current').removeClass('active');

						$onepage_nav.find('a[href="#' + $(this).attr('id') + '"]').parent().addClass('current').addClass('active');
					}

					if (cur_pos <= nav_height && cur_pos >= 0) {
						$onepage_nav.find('a').parent().removeClass('current').removeClass('active');
						$onepage_nav.find('a[href="#header"]').parent().addClass('current').addClass('active');
					}
				});
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ------------------- on click scrool to target with smoothness -------- */
		/* ---------------------------------------------------------------------- */
		TM_scrolltoTarget: function() {
			//jQuery for page scrolling feature - requires jQuery Easing plugin
			$('.smooth-scroll-to-target, .fullscreen-onepage-nav a').on('click', function(e) {
				e.preventDefault();

				var $anchor = $(this);
				
				var $hearder_top = $('.header .header-nav');
				var hearder_top_offset = 0;
				if ($hearder_top[0]){
					hearder_top_offset = $hearder_top.outerHeight(true);
				} else {
					hearder_top_offset = 0;
				}

				// if adminbar exist
				var $wpAdminBar = $('#wpadminbar');
				var wpAdminBar_height = 0;
				if( $wpAdminBar.length ) {
					wpAdminBar_height = $wpAdminBar.height();
				}

				//for vertical nav, offset 0
				if ($body.hasClass("tm-vertical-nav")){
					hearder_top_offset = 0;
				}

				var top = $($anchor.attr('href')).offset().top - hearder_top_offset - wpAdminBar_height;
				$('html, body').stop().animate({
					scrollTop: top
				}, 1500, 'easeInOutExpo');

			});
		},

		/* ---------------------------------------------------------------------- */
		/* -------------------------- Scroll navigation ------------------------- */
		/* ---------------------------------------------------------------------- */
		TM_navLocalScorll: function() {
			var data_offset = -60;
			var $local_scroll = $("#header .onepage-nav");
			if( $local_scroll.length > 0 ) {
				$local_scroll.localScroll({
					target: "body",
					duration: 400,
					offset: data_offset,
					easing: "easeInOutExpo"
				});
			}

			var $local_scroll_other = $("#menuzord-side-panel .menuzord-menu, #menuzord-verticalnav .menuzord-menu, #fullpage-nav");
			if( $local_scroll_other.length > 0 ) {
				$local_scroll_other.localScroll({
					target: "body",
					duration: 400,
					offset: 0,
					easing: "easeInOutExpo"
				});
			}
		},

		/* ---------------------------------------------------------------------------- */
		/* ------------------------------- scroll to fixed ---------------------------- */
		/* ---------------------------------------------------------------------------- */
		TM_scrollToFixed: function() {
			$('.navbar-scrolltofixed').scrollToFixed();
			$('.scrolltofixed').scrollToFixed({
				marginTop: $header.find('.header-nav').outerHeight(true) + 10,
				limit: function() {
					var limit = $('#footer').offset().top - $(this).outerHeight(true);
					return limit;
				}
			});
			$('.sidebar-scrolltofixed').scrollToFixed({
				marginTop: $header.find('.header-nav').outerHeight() + 20,
				limit: function() {
					var limit = $('#footer').offset().top - $('#sidebar').outerHeight() - 20;
					return limit;
				}
			});
		},

		/* ---------------------------------------------------------------------------- */
		/* ------------------------------- Vertical Nav ------------------------------- */
		/* ---------------------------------------------------------------------------- */
		TM_verticalNavHeaderPadding: function() {
			if( $body.hasClass("tm-vertical-nav") ) {
				var $header_nav_wrapper = $('#header .header-nav-wrapper');
				var $header_nav_wrapper_menuzordmenu  = $('#header .header-nav-wrapper .menuzord-menu');
				if ( $header_nav_wrapper.css("position") === "fixed" && $window.width() <= 1199 ) {

					var header_nav_wrapper_menuzordmenu_height = 0;
					if( $($header_nav_wrapper_menuzordmenu).is(":visible") ) {
						header_nav_wrapper_menuzordmenu_height = $header_nav_wrapper_menuzordmenu.height();
					}

					$body.css('padding-top', $header_nav_wrapper.height() - header_nav_wrapper_menuzordmenu_height - admin_bar_height() );

				} else {
					$body.css('padding-top', 0);
				}
			}
		},

		/* ----------------------------------------------------------------------------- */
		/* --------------------------- Menuzord - Responsive Megamenu ------------------ */
		/* ----------------------------------------------------------------------------- */
		TM_menuzord: function() {

			var $menuzord = $("#menuzord");
			if( $menuzord.length > 0 ) {
				$menuzord.menuzord({
					align: "left",
					effect: "slide",
					animation: "none",
					indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
					indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
				});
			}

			var $menuzord_right = $("#menuzord-right");
			if( $menuzord_right.length > 0 ) {
				$menuzord_right.menuzord({
					align: "right",
					effect: "slide",
					animation: "none",
					indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
					indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
				});
			}

			var $menuzord_side_panel = $("#menuzord-side-panel");
			if( $menuzord_side_panel.length > 0 ) {
				$menuzord_side_panel.menuzord({
					align: "right",
					effect: "slide",
					animation: "none",
					indicatorFirstLevel: "",
					indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
				});
			}
			
			var $menuzord_vertical_nav = $("#menuzord-verticalnav");
			if( $menuzord_vertical_nav.length > 0 ) {
				$menuzord_vertical_nav.menuzord({
					align: "right",
					effect: "slide",
					animation: "none",
					indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
					indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
				});
			}
			
			//Main Top Primary Nav
			var $menuzord_top_main_nav = $("#top-primary-nav");
			var $menuzord_top_main_nav_menuzord_menu = $menuzord_top_main_nav.find('.menuzord-menu');
			if( $menuzord_top_main_nav.length > 0 && $menuzord_top_main_nav_menuzord_menu.length ) {
				var effect = ( $menuzord_top_main_nav.data("effect") === undefined ) ? "slide": $menuzord_top_main_nav.data("effect");
				var animation = ( $menuzord_top_main_nav.data("animation") === undefined ) ? "none": $menuzord_top_main_nav.data("animation");
				var align = ( $menuzord_top_main_nav.data("align") === undefined ) ? "right": $menuzord_top_main_nav.data("align");
				$menuzord_top_main_nav.menuzord({
					align: align,
					effect: effect,
					animation: animation,
					indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
					indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
				});
			}
			
			var $nav_items = $('#top-primary-nav  #main-nav').clone();
			$('#top-primary-nav-clone #main-nav-clone').append($nav_items);

			//Clone Top Primary Nav
			var $menuzord_top_main_nav_clone = $("#top-primary-nav-clone");
			var $menuzord_top_main_nav_clone_menuzord_menu = $menuzord_top_main_nav_clone.find('.menuzord-menu');
			if( $menuzord_top_main_nav_clone.length > 0 && $menuzord_top_main_nav_clone_menuzord_menu.length ) {
				var effect = ( $menuzord_top_main_nav_clone.data("effect") === undefined ) ? "slide": $menuzord_top_main_nav_clone.data("effect");
				var animation = ( $menuzord_top_main_nav_clone.data("animation") === undefined ) ? "none": $menuzord_top_main_nav_clone.data("animation");
				var align = ( $menuzord_top_main_nav_clone.data("align") === undefined ) ? "right": $menuzord_top_main_nav_clone.data("align");
				$menuzord_top_main_nav_clone.menuzord({
					align: align,
					effect: effect,
					animation: animation,
					indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
					indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
				});
			}

			//If click on Top Primary Nav Show Hide => it will show clone mobile nav
			$menuzord_top_main_nav.on('click', '.showhide', function(e) {
				$menuzord_top_main_nav_clone.find('.showhide').trigger('click');
			});


		},


		/* ----------------------------------------------------------------------------- */
		/* ------------------------- Menuzord -  Megamenu Dynamic Left ----------------- */
		/* ----------------------------------------------------------------------------- */
		TM_Memuzord_Megamenu: function() {
			if ( $window.width() >= 1200 ) {
				$('.menuzord-menu').children('.menu-item').find('.megamenu').each(function () {
					var $item = $(this);
					if( $item.length > 0 ) {

						$item.css('left', 0);
						$item.css('right', 'auto');
						
						if( $item.closest('.container').length ) {
							var $container = $item.closest('.container');
						} else if( $item.closest('.container-fluid').length ) {
							var $container = $item.closest('.container-fluid');
						} else {
							var $container = $item.closest('.header-nav-container');
						}
						
						var container_width = $container.width(),
							container_padding_left = parseInt($container.css('padding-left')),
							container_padding_right = parseInt($container.css('padding-right')),
							parent_width = $item.closest('.menuzord-menu').outerWidth();
						
						var megamenu_width = $item.outerWidth();

						if (megamenu_width > parent_width) {
							var left = -(megamenu_width - parent_width) * 0.5;
						} else {
							var left = 0;
						}

						var container_offset = $container.offset();
						var megamenu_offset = $item.offset();

						left = -(megamenu_offset.left - container_offset.left - container_padding_left);

						if( $item.hasClass('megamenu-three-quarter-width') ) {
							container_width = container_width * 0.75;
							left = $item.css('left');
						} else if( $item.hasClass('megamenu-half-width') ) {
							container_width = container_width * 0.5;
						} else if( $item.hasClass('megamenu-quarter-width') ) {
							container_width = container_width * 0.25;
							left = $item.css('left');
						}

						if( $item.hasClass('megamenu-fullwidth') ) {
							//do nothing
						} else if( $item.hasClass('megamenu-position-left') ) {
							left = 0;
						} else if( $item.hasClass('megamenu-position-center') ) {
							parent_width = $item.closest('.menu-item-has-children').outerWidth();
							left = - (megamenu_width - parent_width) * 0.5;
							$item.css('right', 'auto');
						} else if( $item.hasClass('megamenu-position-right') ) {
							left = 'auto';
							$item.css('right', 0);
						}


						$item.css('width', container_width);
						$item.css('left', left);
					}
				});
			}
		},


		/* ---------------------------------------------------------------------- */
		/* --------------------------- Waypoint Top Nav Sticky ------------------ */
		/* ---------------------------------------------------------------------- */
		TM_TopNav_Dropdown_Position: function() {
			if ( $window.width() >= 1200 ) {
				var $top_primary_nav = $('#top-primary-nav');
				var menuItems = $top_primary_nav.find(".menuzord-menu > .menu-item.menu-item-has-children");
				menuItems.each( function(i) {
					var $this = $(this);

					var browserWidth = $top_primary_nav.find(".menuzord-menu").width(); // 16 is width of scroll bar
					var menuItemPosition = $this.position().left;
					var dropdownMenuWidth = $this.find('.dropdown').width();

					var menuItemFromLeft = 0;
					if ($body.hasClass("tm-boxed-layout")) {
						menuItemFromLeft = qodef.boxedLayoutWidth  - (menuItemPosition - (browserWidth - qodef.boxedLayoutWidth )/2);
					} else {
						menuItemFromLeft = browserWidth - menuItemPosition;
					}

					var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true
					if($this.find('li.menu-item-has-children').length > 0){
						dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
					}

					if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
						$(this).find('.dropdown').addClass('dropdown-right-zero');
						$this.find('li.menu-item-has-children').find('.dropdown').addClass('dropdown-left');
					}

				});
			}
		},

		/* ---------------------------------------------------------------------- */
		/* --------------------------- Waypoint Top Nav Sticky ------------------ */
		/* ---------------------------------------------------------------------- */
		TM_topnavAnimate: function() {
			if ($window.scrollTop() > (50)) {
				$(".navbar-sticky-animated").removeClass("animated-active");
			} else {
				$(".navbar-sticky-animated").addClass("animated-active");
			}

			if ($window.scrollTop() > (50)) {
				$(".navbar-sticky-animated .header-nav-wrapper .container, .navbar-sticky-animated .header-nav-wrapper .container-fluid").removeClass("add-padding");
			} else {
				$(".navbar-sticky-animated .header-nav-wrapper .container, .navbar-sticky-animated .header-nav-wrapper .container-fluid").addClass("add-padding");
			}
		},

		/* ---------------------------------------------------------------------- */
		/* ---------------- home section on scroll parallax & fade -------------- */
		/* ---------------------------------------------------------------------- */
		TM_homeParallaxFadeEffect: function() {
			if ($window.width() >= 1200) {
				var scrolled = $window.scrollTop();
				$('.content-fade-effect .home-content .home-text').css('padding-top', (scrolled * 0.0610) + '%').css('opacity', 1 - (scrolled * 0.00120));
			}
		},

		
	};

	THEMEMASCOT.widget = {

		init: function() {

			var t = setTimeout(function() {
				THEMEMASCOT.widget.TM_shopClickEvents();
				THEMEMASCOT.widget.TM_masonryIsotop();
			}, 0);

		},

		/* ---------------------------------------------------------------------- */
		/* ------------------------------ Shop Plus Minus ----------------------- */
		/* ---------------------------------------------------------------------- */
		TM_shopClickEvents: function() {
			$document_body.on('click', '.quantity .plus', function(e) {
				var currentVal = parseInt($(this).parent().children(".qty").val(), 10);
				if (!isNaN(currentVal)) {
					$(this).parent().children(".qty").val(currentVal + 1);
				}
				$('.shop_table.cart').find('button[name="update_cart"]').removeAttr("disabled");
				return false;
			});

			$document_body.on('click', '.quantity .minus', function(e) {
				var currentVal = parseInt($(this).parent().children(".qty").val(), 10);
				if (!isNaN(currentVal) && currentVal > 0) {
					$(this).parent().children(".qty").val(currentVal - 1);
				}
				$('.shop_table.cart').find('button[name="update_cart"]').removeAttr("disabled");
				return false;
			});
		},

		/* ---------------------------------------------------------------------- */
		/* ----------------------------- Masonry Isotope ------------------------ */
		/* ---------------------------------------------------------------------- */
		TM_masonryIsotop: function() {
			//isotope firsttime loading
			if( $gallery_isotope.length > 0 ) {
				$gallery_isotope.each(function () {
					var $each_istope = $(this);
					$each_istope.imagesLoaded(function(){
						if ($each_istope.hasClass("masonry")){
							$each_istope.isotope({
								isOriginLeft: THEMEMASCOT.isLTR.check(),
								itemSelector: '.isotope-item',
								layoutMode: "masonry",
								masonry: {
									columnWidth: '.isotope-item-sizer'
								},
								getSortData : {
									name : function ( itemElem ) {
										return $( itemElem ).find('.title').text();
									},
									date : '[data-date]',
								},
								filter: "*"
							});
						} else{
							$each_istope.isotope({
								isOriginLeft: THEMEMASCOT.isLTR.check(),
								itemSelector: '.isotope-item',
								layoutMode: "fitRows",
								getSortData : {
									name : function ( itemElem ) {
										return $( itemElem ).find('.title').text();
									},
									date : '[data-date]',
								},
								filter: "*"
							});
						}
					});

					//search for isotope with single item and add a class to remove left right padding.
					var count = $each_istope.find('.isotope-item:not(.isotope-item-sizer)').length;
					if( count == 1 ) {
						$each_istope.addClass('isotope-layout-single-item');
					}
				});
			}
			
			//isotope filter
			$('.isotope-layout-filter').on('click', 'a', function(e) {
				var $this = $(this);
				var $this_parent = $this.parent('div');
				$this.addClass('active').siblings().removeClass('active');

				var fselector = $this.data('filter');
				var linkwith = $this_parent.data('link-with');
				if ( $('#'+linkwith).hasClass("masonry") ){
					$('#'+linkwith).isotope({
						isOriginLeft: THEMEMASCOT.isLTR.check(),
						itemSelector: '.isotope-item',
						layoutMode: "masonry",
						masonry: {
							columnWidth: '.isotope-item-sizer'
						},
						filter: fselector
					});
				} else {
					$('#'+linkwith).isotope({
						isOriginLeft: THEMEMASCOT.isLTR.check(),
						itemSelector: '.isotope-item',
						layoutMode: "fitRows",
						filter: fselector
					});
				}
				return false;
			});

			//isotope sorter
			$('.isotope-layout-sorter').on('click', 'a', function(e) {
				var $this = $(this);
				var $this_parent = $this.parent('div');
				$this.addClass('active').siblings().removeClass('active');

				var sortby = $this.data('sortby');
				var linkwith = $this_parent.data('link-with');
				if( sortby === "shuffle" ) {
					$('#'+linkwith).isotope('shuffle');
				} else {
					$('#'+linkwith).isotope({
						isOriginLeft: THEMEMASCOT.isLTR.check(),
						sortBy: sortby
					});
				}
				return false;
			});
			
		},


		TM_isotopeGridRearrange: function() {
			if ($gallery_isotope.hasClass("masonry")){
				$gallery_isotope.isotope({
					isOriginLeft: THEMEMASCOT.isLTR.check(),
					itemSelector: '.isotope-item',
					layoutMode: "masonry"
				});
			} else{
				$gallery_isotope.isotope({
					isOriginLeft: THEMEMASCOT.isLTR.check(),
					itemSelector: '.isotope-item',
					layoutMode: "fitRows"
				});
			}
		},

		TM_isotopeGridShuffle: function() {
			$gallery_isotope.isotope('shuffle');
		},

	};

	


	/* ---------------------------------------------------------------------- */
	/* ---------- document ready, window load, scroll and resize ------------ */
	/* ---------------------------------------------------------------------- */
	//document ready
	THEMEMASCOT.documentOnReady = {
		init: function() {
			THEMEMASCOT.initialize.init();
			THEMEMASCOT.header.init();
			THEMEMASCOT.widget.init();
			THEMEMASCOT.windowOnscroll.init();
		}
	};

	//window on load
	THEMEMASCOT.windowOnLoad = {
		init: function() {
			var t = setTimeout(function() {
				THEMEMASCOT.initialize.TM_preLoaderOnLoad();
				THEMEMASCOT.initialize.TM_parallaxBgInit();
				THEMEMASCOT.header.TM_VC_RTL();
				THEMEMASCOT.header.TM_VC_Vertical();
				THEMEMASCOT.header.TM_VC_Boxed_Fullwidth_Fit_Container();
				THEMEMASCOT.initialize.TM_portfolioStickyScrollMagic();
				THEMEMASCOT.initialize.TM_shopSingleStickyScrollMagic();
			}, 0);
			$window.trigger("scroll");
			$window.trigger("resize");
		}
	};

	//window on scroll
	THEMEMASCOT.windowOnscroll = {
		init: function() {
			$window.on( 'scroll', function(){
				THEMEMASCOT.header.TM_scroolToTop();
				THEMEMASCOT.header.TM_activateMenuItemOnReach();
				THEMEMASCOT.header.TM_topnavAnimate();
			});
		}
	};

	//window on resize
	THEMEMASCOT.windowOnResize = {
		init: function() {
			var t = setTimeout(function() {
				THEMEMASCOT.initialize.TM_equalHeightDivs();
				THEMEMASCOT.initialize.TM_resizeFullscreen();
				THEMEMASCOT.header.TM_Memuzord_Megamenu();
				THEMEMASCOT.header.TM_TopNav_Dropdown_Position();
				THEMEMASCOT.header.TM_verticalNavHeaderPadding();
				THEMEMASCOT.header.TM_VC_RTL();
				THEMEMASCOT.header.TM_VC_Vertical();
				THEMEMASCOT.header.TM_VC_Boxed_Fullwidth_Fit_Container();
				THEMEMASCOT.header.TM_navLocalScorll();
				THEMEMASCOT.initialize.TM_fixedFooter();
			}, 400);
		}
	};


	THEMEMASCOT.header.TM_menuzord();
	

	/* ---------------------------------------------------------------------- */
	/* ---------------------------- Call Functions -------------------------- */
	/* ---------------------------------------------------------------------- */
	$document.ready(
		THEMEMASCOT.documentOnReady.init
	);
	$window.on('load',
		THEMEMASCOT.windowOnLoad.init
	);
	$window.on('resize', 
		THEMEMASCOT.windowOnResize.init
	);

	//call function before document ready
	THEMEMASCOT.initialize.TM_preLoaderClickDisable();

})(jQuery);