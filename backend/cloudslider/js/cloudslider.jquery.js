
/**************************************************************************
 * Cloud Slider jQuery Plugin
 * @version: 2.1
 * @requires jQuery 1.7 or later
 * @author WebuddySoft
 * @Licenses: http://codecanyon.net/licenses/
**************************************************************************/

(function ($) {

	$.fn.extend({

		cloudSlider : function(param) {
			return this.each(function() {
				new cloudSlider(this, param);
			});
		},
		
		cloudData: function() {
			return $(this).data('instance').options;
		},

		cloudResume : function() {
			var cloudInstance = $(this).data('instance');
			if (!cloudInstance.options.isBusy) {
				cloudInstance.options.onResume();
				cloudInstance.resume();
			}
		},

		cloudPause : function() {
			var cloudInstance = $(this).data('instance');
			cloudInstance.pause();
		},

		cloudKill : function() {
			var cloudInstance = $(this).data('instance');
			cloudInstance.kill();
		},

		cloudPrev : function() {
			var cloudInstance = $(this).data('instance');
			if (cloudInstance && !cloudInstance.options.isBusy) {
				cloudInstance.flowTo('left');
				cloudInstance.options.onPrev();
			}
		},

		cloudNext : function() {
			var cloudInstance = $(this).data('instance');
			if (cloudInstance && !cloudInstance.options.isBusy) {
				cloudInstance.flowTo('right');
				cloudInstance.options.onNext();
			}
		},
		
		cloudTo : function(slideNo) {
			slideNo--;
			var cloudInstance = $(this).data('instance');
			if (cloudInstance && typeof slideNo == 'number' && !cloudInstance.options.isBusy) {
				if (slideNo >= 0 && slideNo < cloudInstance.options.numberOfSlides && slideNo != cloudInstance.options.currentSkyNo) {
					cloudInstance.flowTo(slideNo);
					cloudInstance.options.onSlideTo();
				}
			}
		},

		cloudIn : function(cloud) {
			var cloudInstance = $(this).data('instance');
			if (cloud.hasClass('kr-cloud') && !cloudInstance.options.isBusy) {
				cloudInstance.cloudIn(cloud);				
			}
		},

		cloudOut : function(cloud) {
			var cloudInstance = $(this).data('instance');
			if (cloud.hasClass('kr-cloud') && !cloudInstance.options.isBusy) {
				cloudInstance.cloudOut(cloud);
			}
		},

		cloudAnimate : function(cloud, toVars) {
			var cloudInstance = $(this).data('instance');
			if (cloud.hasClass('kr-cloud') && !cloudInstance.options.isBusy) {
				cloudInstance.cloudAnimate(cloud, toVars);
			}
		}

	});

	var cloudSlider = function(cloud_container, param_options) {

		var selfUri = get_self_url();

		var skins = [];

		skins['light_iron'] = {
			containerBgColor 	: '#CCC',
			containerBorder		: '5px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/light_iron/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/light_iron/left_arrow.png',
									imgNext					: selfUri + 'skins/light_iron/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/light_iron/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/light_iron/right_arrow_activated.png',
									positionOffset			: -7,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: -7,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/light_iron/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/light_iron/bullet_item_activated.png',
									imgContainerLeft		: selfUri + 'skins/light_iron/bullet_left.png',
									imgContainerRight		: selfUri + 'skins/light_iron/bullet_right.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: '#AAA',
									itemOpacity				: 0.4,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/light_iron/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['dark_iron'] = {
			containerBgColor 	: '#666',
			containerBorder		: '5px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/dark_iron/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/dark_iron/left_arrow.png',
									imgNext					: selfUri + 'skins/dark_iron/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/dark_iron/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/dark_iron/right_arrow_activated.png',
									positionOffset			: -7,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: -7,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/dark_iron/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/dark_iron/bullet_item_activated.png',
									imgContainerLeft		: selfUri + 'skins/dark_iron/bullet_left.png',
									imgContainerRight		: selfUri + 'skins/dark_iron/bullet_right.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: '#444',
									itemOpacity				: 0.4,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#333',
									activatedBorderColor 	: '#333',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/dark_iron/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['light_glass'] = {
			containerBgColor 	: '#FFF',
			containerBorder		: '6px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/light_glass/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/light_glass/left_arrow.png',
									imgNext					: selfUri + 'skins/light_glass/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/light_glass/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/light_glass/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 20,
									itemOpacity				: 1,
									itemMargin				: '0px 5px',
									imgItem					: selfUri + 'skins/light_glass/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/light_glass/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(255, 255, 255, 0.5)',
									itemOpacity				: 0.5,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/light_glass/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['dark_glass'] = {
			containerBgColor 	: '#333',
			containerBorder		: '6px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/dark_glass/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/dark_glass/left_arrow.png',
									imgNext					: selfUri + 'skins/dark_glass/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/dark_glass/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/dark_glass/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 20,
									itemOpacity				: 1,
									itemMargin				: '0px 5px',
									imgItem					: selfUri + 'skins/dark_glass/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/dark_glass/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(0, 0, 0, 0.5)',
									itemOpacity				: 0.5,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#333',
									activatedBorderColor 	: '#333',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/dark_glass/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['light_rounded_bar'] = {
			containerBgColor 	: '#AAA',
			containerBorder		: '5px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/light_rounded_bar/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/light_rounded_bar/left_arrow.png',
									imgNext					: selfUri + 'skins/light_rounded_bar/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/light_rounded_bar/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/light_rounded_bar/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 10,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/light_rounded_bar/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/light_rounded_bar/bullet_item_activated.png',
									imgContainerLeft		: selfUri + 'skins/light_rounded_bar/bullet_left.png',
									imgContainerRight		: selfUri + 'skins/light_rounded_bar/bullet_right.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: '#AAA',
									itemOpacity				: 0.7,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#333',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/light_rounded_bar/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['dark_rounded_bar'] = {
			containerBgColor 	: '#333',
			containerBorder		: '5px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/dark_rounded_bar/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/dark_rounded_bar/left_arrow.png',
									imgNext					: selfUri + 'skins/dark_rounded_bar/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/dark_rounded_bar/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/dark_rounded_bar/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 10,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/dark_rounded_bar/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/dark_rounded_bar/bullet_item_activated.png',
									imgContainerLeft		: selfUri + 'skins/dark_rounded_bar/bullet_left.png',
									imgContainerRight		: selfUri + 'skins/dark_rounded_bar/bullet_right.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: '#333',
									itemOpacity				: 0.7,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#000',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/dark_rounded_bar/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['light_bar'] = {
			containerBgColor 	: '#FFF',
			containerBorder		: '5px 5px 20px 5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/light_bar/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/light_bar/left_arrow.png',
									imgNext					: selfUri + 'skins/light_bar/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/light_bar/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/light_bar/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 3,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/light_bar/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/light_bar/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(256, 256, 256, 0.5)',
									itemOpacity				: 0.7,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#000',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/light_bar/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['dark_bar'] = {
			containerBgColor 	: '#333',
			containerBorder		: '5px 5px 20px 5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/dark_bar/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/dark_bar/left_arrow.png',
									imgNext					: selfUri + 'skins/dark_bar/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/dark_bar/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/dark_bar/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 3,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/dark_bar/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/dark_bar/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(0, 0, 0, 0.5)',
									itemOpacity				: 0.7,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#000',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/dark_bar/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['light_tab'] = {
			containerBgColor 	: '#FFF',
			containerBorder		: '5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/light_tab/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/light_tab/left_arrow.png',
									imgNext					: selfUri + 'skins/light_tab/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/light_tab/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/light_tab/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 5,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/light_tab/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/light_tab/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(200, 200, 200, 0.7)',
									itemOpacity				: 0.7,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#000',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/light_tab/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['dark_tab'] = {
			containerBgColor 	: '#000',
			containerBorder		: '5px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/dark_tab/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/dark_tab/left_arrow.png',
									imgNext					: selfUri + 'skins/dark_tab/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/dark_tab/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/dark_tab/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 5,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/dark_tab/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/dark_tab/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(30, 30, 30, 0.7)',
									itemOpacity				: 0.7,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#000',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/dark_tab/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['light_outline'] = {
			containerBgColor 	: '#fff',
			containerBorder		: '5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/light_outline/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/light_outline/left_arrow.png',
									imgNext					: selfUri + 'skins/light_outline/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/light_outline/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/light_outline/right_arrow_activated.png',
									positionOffset			: 30,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_right',
									horizontalOffset		: 30,
									verticalOffset			: 20,
									itemOpacity				: 1,
									itemMargin				: 2,
									imgItem					: selfUri + 'skins/light_outline/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/light_outline/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.2
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(255, 255, 255, 0.8)',
									itemOpacity				: 0.3,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/light_outline/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};
		

		skins['dark_outline'] = {
			containerBgColor 	: '#000',
			containerBorder		: '5px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/dark_outline/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/dark_outline/left_arrow.png',
									imgNext					: selfUri + 'skins/dark_outline/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/dark_outline/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/dark_outline/right_arrow_activated.png',
									positionOffset			: 30,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_right',
									horizontalOffset		: 30,
									verticalOffset			: 20,
									itemOpacity				: 1,
									itemMargin				: 5,
									imgItem					: selfUri + 'skins/dark_outline/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/dark_outline/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.2
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '2px',
									containerBgColor		: '#333',
									itemOpacity				: 1,
									itemMargin				: '2px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#000',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/dark_outline/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['stroke'] = {
			containerBgColor 	: '#FFF',
			containerBorder		: '5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/stroke/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/stroke/left_arrow.png',
									imgNext					: selfUri + 'skins/stroke/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/stroke/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/stroke/right_arrow_activated.png',
									positionOffset			: 40,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 20,
									itemOpacity				: 1,
									itemMargin				: 3,
									imgItem					: selfUri + 'skins/stroke/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/stroke/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'transparent',
									itemOpacity				: 0.5,
									itemMargin				: '5px',
									itemBorderWidth 		: '4px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/stroke/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['pierced'] = {
			containerBgColor 	: '#FFF',
			containerBorder		: '5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/pierced/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/pierced/left_arrow.png',
									imgNext					: selfUri + 'skins/pierced/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/pierced/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/pierced/right_arrow_activated.png',
									positionOffset			: -11,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: -12,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/pierced/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/pierced/bullet_item_activated.png',
									imgContainerLeft		: selfUri + 'skins/pierced/bullet_left.png',
									imgContainerRight		: selfUri + 'skins/pierced/bullet_right.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'transparent',
									itemOpacity				: 1,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#333',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/pierced/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['polygon'] = {
			containerBgColor 	: '#CCC',
			containerBorder		: '0px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/polygon/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/polygon/left_arrow.png',
									imgNext					: selfUri + 'skins/polygon/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/polygon/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/polygon/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 10,
									itemOpacity				: 1,
									itemMargin				: 1,
									imgItem					: selfUri + 'skins/polygon/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/polygon/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(255, 255, 255, 0.5)',
									itemOpacity				: 0.5,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/polygon/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['embossed'] = {
			containerBgColor 	: '#AAA',
			containerBorder		: '5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/embossed/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/embossed/left_arrow.png',
									imgNext					: selfUri + 'skins/embossed/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/embossed/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/embossed/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 20,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/embossed/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/embossed/bullet_item_activated.png',
									imgContainerLeft		: selfUri + 'skins/embossed/bullet_left.png',
									imgContainerRight		: selfUri + 'skins/embossed/bullet_right.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: '#CCC',
									itemOpacity				: 0.5,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#000',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/embossed/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['dark_short_bar'] = {
			containerBgColor 	: '#333',
			containerBorder		: '5px',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/dark_short_bar/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/dark_short_bar/left_arrow.png',
									imgNext					: selfUri + 'skins/dark_short_bar/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/dark_short_bar/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/dark_short_bar/right_arrow_activated.png',
									positionOffset			: 20,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 20,
									itemOpacity				: 1,
									itemMargin				: 0,
									imgItem					: selfUri + 'skins/dark_short_bar/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/dark_short_bar/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'rgba(0, 0, 0, 0.5)',
									itemOpacity				: 0.5,
									itemMargin				: '5px',
									itemBorderWidth 		: '1px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/dark_short_bar/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};

		skins['default'] = {
			containerBgColor 	: '#FFF',
			containerBorder		: '5px',
			containerBoxShadow	: '0px 2px 30px 0px #000',
			progressBarPosition	: 'top',
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',
			progressBarThick	: '3px',

			imgLoader			: selfUri + 'skins/default/loading.gif',

			arrow				: {
									imgPrev					: selfUri + 'skins/default/left_arrow.png',
									imgNext					: selfUri + 'skins/default/right_arrow.png',
									imgPrevActivated		: selfUri + 'skins/default/left_arrow_activated.png',
									imgNextActivated		: selfUri + 'skins/default/right_arrow_activated.png',
									positionOffset			: 30,
									responsiveLevel			: 1.5
								},

			bullet				: {
									position				: 'bottom_center',
									horizontalOffset		: 0,
									verticalOffset			: 15,
									itemOpacity				: 1,
									itemMargin				: '0px 5px',
									imgItem					: selfUri + 'skins/default/bullet_item.png',
									imgItemActivated		: selfUri + 'skins/default/bullet_item_activated.png',
									activatedOpacity		: 1,
									responsiveLevel			: 1.5
								},

			thumb				: {
									positionOffset			: -120,
									containerPadding 		: '5px',
									containerBgColor		: 'transparent',
									itemOpacity				: 0.7,
									itemMargin				: '5px',
									itemBorderWidth 		: '2px',
									itemBorderColor 		: '#FFF',
									activatedBorderColor 	: '#FFF',
									activatedOpacity		: 1,
									imgNoThumb				: selfUri + 'skins/default/no_thumb.png',
									responsiveLevel			: 1.3
								}
		};
		

		var cloud_options = {

			responsive			: true,													// Responsive Mode 		- true or false
			fullWidth			: false,												// Full Width Mode 		- true or false (If it's true, width option will be used for responsive mode switching under it)
			fullSize			: false,												// Full Size Mode 		- true or false

			autoSlide			: true,													// Slider will slide automatically 	- true or false
			onHoverPause		: true,													// Pause When Mouse Over 	- true or false
			startSlideNo		: 1,													// Slide Number To Start		- {number}
			shuffleMode			: false,												// Random SlideShow Mode 	- true or false
			
			autoSlideCarousel 	: 'slide',												// For only category carousel slider, what will slide automatically - 'slide', 'carousel', 'combine'

			progressBarPosition	: 'top',												// Progress Baar Position - top, bottom, hidden
			progressBarColor	: 'rgba(170, 170, 170, 0.5)',							// Progress Bar Color - {color}
			progressBarThick	: '3px',												// Progress Bar Thick - {number} or {px}

			imgLoader			: selfUri + 'img/loading.gif',							// Loading Gif src

			lazyImageLoad 		: is_lowerIE8() ? false : true,							// Lazy Image Load Mode
			keyNavigation		: true,													// Keyboard Navigation - true or false

			constant			: {
					navFadeDuration			: 200,										// Previous & Next Button Fade Effect Duration
					navThumbShiftDuration	: 0.5,										// Navigation Thumbnail Shift Duration
					defaultSlideDelay		: 6000,										// Default Slide Delay
					defaultTransition		: ['1', '2'],								// Default Transition (shift trans to left, right, top, bottom)

					carousel				: {
									position		  	: 'center',										// Top Position Of Carousel Container - 'top', 'center', 'bottom', {px}, {%}
									itemSize		  	: {},											// Width & Height of Each Carousel Item - {width: {number}, height: {number}}---------------------------------------------changed
									overlay 		  	: '20%',										// Overlay - {%}, {px}
									firstShow		  	: 1,											// Carousel Item Index to Firstly Show - {number}, 'random'
									easing 			  	: 'easeOutSine',								// Carousel Flow Easing
									perspective 	  	: 1000,											// Perspective for rotation of carousel items
									duration		  	: 700,											// Carousel Flow Speed
									delay 				: 6000,											// Carousel Flow Delay
									direction 			: 'right',										// Carousel Flow Direction
									arrow 			  	: {
										visibility 	  	: 'hover',										// Arrow visibility - 'hover', 'show', 'hide'
										position 	  	: 'auto',										// Arrow left position - {px}, {%}, 'auto' (fit for current showing carousel)
										imgPrev		  	: selfUri + 'img/left_carousel_arrow.png',		// Image src for left arrow
										imgNext			: selfUri + 'img/right_carousel_arrow.png',		// Image src for right arrow
										responsiveLevel: 2 												// responsive level for carousel arrow
									},
									level 			: [
										{											// Level 2
											opacity	: 1,							// Opacity - {number}
											scale 	: 1,							// Scale - {number}
											rotationX : 0,							// RotateX - {number}
											rotationY : 0,							// RotateY - {number}
											rotationZ : 0							// RotateZ - {number}
										},
										{											// Level 3
											opacity	: 1,							// Opacity - {number}
											scale 	: 1,							// Scale - {number}
											rotationX : 0,							// RotateX - {number}
											rotationY : 0,							// RotateY - {number}
											rotationZ : 0							// RotateZ - {number}
										},
										{											// Level 4
											opacity	: 1,							// Opacity - {number}
											scale 	: 1,							// Scale - {number}
											rotationX : 0,							// RotateX - {number}
											rotationY : 0,							// RotateY - {number}
											rotationZ : 0							// RotateZ - {number}
										},
										{											// Level 5
											opacity	: 1,							// Opacity - {number}
											scale 	: 1,							// Scale - {number}
											rotationX : 0,							// RotateX - {number}
											rotationY : 0,							// RotateY - {number}
											rotationZ : 0							// RotateZ - {number}
										}
									]
					}
			},

			arrow				: {
									visibility				: 'hover',									// hover, show, hide
									positionOffset			: 30,										// arrows' horizontal offset from left & right edge of the slider - 'inside', 'outside', {number}---------------------changed
									imgPrev					: selfUri + 'img/left_arrow.png',			// image src for left arrow--------------------------------------------------------changed
									imgNext					: selfUri + 'img/right_arrow.png',			// image src for right arrow-------------------------------------------------------changed
									imgPrevActivated		: selfUri + 'img/left_arrow_activated.png',	// image src for left arrow activated----------------------------------------------added
									imgNextActivated		: selfUri + 'img/right_arrow_activated.png',// image src for right arrow activated----------------------------------------------added
									///itemSize				: {},										// {width: {number}, height: {number}}---------------------------------------------changed									
									responsiveLevel			: 2											// responsive level for arrow
								},

			navType				: 'bullet',											// thumb, bullet, none

			bullet				: {
									visibility				: 'show',									// hover, show
									position				: 'bottom_center',							// top_left, top_center, top_right, bottom_left, bottom_center, bottom_right
									horizontalOffset		: 0,										// horizontal offset of the bullet container - {px}--------------------------------------------------added
									verticalOffset			: 10,										// vertical offset of the bullet container - {px}----------------------------------------------------added
									itemOpacity				: 1,										// opacity for not activated bullet item
									itemMargin				: 5,										// padding of each bullet
									imgItem					: selfUri + 'img/bullet_item.png',			// image src for bullet item
									imgItemActivated		: selfUri + 'img/bullet_item_activated.png',	// image src for activated bullet item------------------------------------------changed
									imgContainerLeft		: '',										// image src of left section of bullet container
									imgContainerRight		: '',										// image src of right section of bullet container
									activatedOpacity		: 1,										// opacity for activated bullet item
									///itemSize				: {},										// {width: {number}, height: {number}}----------------------------------------------------------------removed
									
									responsiveLevel			: 2											// responsive level for bullet
								},

			thumb				: {
									visibility				: 'hover',						// hover, show
									positionOffset			: 'outside',					// container's vertical offset from bottom of the slider - 'inside', 'outside', {number}---------------------changed
									containerWidth			: 'auto',						// thumb container width 'px' or '%' or 'auto'(auto fit)---------------------------changed
									containerPadding 		: '5px',						// thumb container padding - 'px'-------------------------------------------------------------added
									containerBgColor		: '#FFFFFF',					// background color of thumb ontainer----------------------------------------------changed
									itemSize				: {},							// {width: {number}, height: {number}}---------------------------------------------changed
									itemOpacity				: 0.6,							// opacity for not activated thumb item--------------------------------------------changed
									itemMargin				: '5px',						// padding of each thumb-----------------------------------------------------------changed
									itemBorderWidth 		: '3px',						// border width of each thumb---------------------------------------------------------------added
									itemBorderColor 		: '#AAA',						// border color of each thumb---------------------------------------------------------------added
									activatedBorderColor 	: '#AAA',						// border color of activated thumb----------------------------------------------------------added
									activatedOpacity		: 1,							// opacity for activated thumb item------------------------------------------------changed
									imgNoThumb				: selfUri + 'img/no_thumb.png',	// image src for no image thumb
									responsiveLevel			: 1.3							// responsive level for thumb
								},

			video 				: {
									autoPlay 		: false,						// Video Auto Play Option - true or false
									pauseWhilePlaying: true 						// Pause Slider Option While Video Playing - true or false
			},

			onInit				: function(){},										// When Slider Initialized
			onResume			: function(){},										// When Slider Resumed
			onPause				: function(){},										// When Slider Paused
			onPrev				: function(){},										// When Slider Slides to Prev (By Arrow Button)
			onNext				: function(){},										// When Slider Slides to Next (By Arrow Button)
			onSlideTo			: function(){},										// When Slider Slides to Any  (By Nav Buttons)
			onSlidingStart		: function(){},										// Before Sliding Started
			onSlidingComplete	: function(){},										// After Sliding Completed
			onCloudClick		: function(target){},								// When Cloud Clicked
			onCloudHover		: function(target, isOver){},						// When Cloud Hovered
			onCarouselTo		: function(){},										// When Carousel Flowed
			onRedraw			: function(){}										// When Slider Redrew

		};

		// Youtube Load & Define Youtube Listeners
		// Reference URL - https://developers.google.com/youtube/iframe_api_reference
		onYouTubeIframeAPIReady = function() {
			cloud_container.find('.kr-youtube-player').each(function() {
				var iframe = $(this).find('iframe');
				youtubeIframeLoad(iframe, $(this).attr('id'), iframe.data('videoId'));
			});
		};

		youtubeIframeLoad = function(iframe, id, videoId) {
			playerVars = {
				enablejsapi: 1,
				controls: 1,
				showinfo: 0,
				fs: 0,
				modestbranding: 1,
				wmode: "opaque"
			};
			if (!is_lowerIE8()) {
				playerVars['html5'] = 1;
			}
			if (iframe.attr('allowfullscreen') != 'undefined' || iframe.attr('mozallowfullscreen') != 'undefined'  || iframe.attr('webkitallowfullscreen') != 'undefined') {
				playerVars['fs'] = 1;
			}
			if (iframe.attr('src').substr(iframe.attr('src').indexOf('controls=') + 9, 1) == '0') {
				playerVars['controls'] = 0;
			}
			var player = new YT.Player(id, {
				width: '100%',
				height: '100%',
				videoId: videoId,
				playerVars: playerVars,
				events: {
					'onReady': onYoutubeReady,
					'onStateChange': onYoutubeStateChange
				}
			});

			var iframe = player.getIframe();
			$(iframe).data('id', id);
			$(iframe).data('videoid', videoId);
			var cloud = $(iframe).closest('.kr-cloud');

			if (!cloud.data('width') || !cloud.data('height')) {
				cloud.css({
					width: $(iframe).width(),
					height: $(iframe).height()
				});
				cloud.data('width', cloud.width());
				cloud.data('height', cloud.height());
			}
		};

		onYoutubeReady = function(event) {
			var iframe = event.target.getIframe();
			if (cloudInstance.options.slideTransitionNeeded) {
				$(iframe).show();
			}
			$(iframe).data('player', event.target);
			if (cloudInstance.options.video.autoPlay && $(iframe).is(':visible') && $(iframe).closest('.kr-sky').hasClass('sky-opened')) {
				event.target.playVideo();
			}
		};

		onYoutubeStateChange = function(event) {
			if (event.data == -1 || event.data == YT.PlayerState.PLAYING) {
				cloudInstance.options.isVideoPlaying = true;
				if (cloudInstance.options.video.pauseWhilePlaying) {					
					cloudInstance.pause();
				}
			} else if (event.data == YT.PlayerState.PAUSED) {
				cloudInstance.options.isVideoPlaying = false;
				if (cloudInstance.options.onHoverPause) {
					if (!cloudInstance.options.mouseEntered) {
						cloudInstance.resume();
					}
				} else {
					cloudInstance.resume();
				}
			}
		};

		// Vimeo Load & Define Vimeo Listeners
		onVimeoIframeAPIReady = function() {
			var vimeoLoadingTimer = setInterval(function() {
				if (typeof $f != 'undefined') {
					cloud_container.find('.kr-vimeo-player').each(function() {
						var iframe = $(this);
						var player = $f(iframe[0]);
						iframe.data('player', player);
						player.addEvent('ready', function() {
							if (cloudInstance.options.video.autoPlay && $(iframe).is(':visible') && $(iframe).closest('.kr-sky').hasClass('sky-opened')) {
								player.api('play');
							}
							player.addEvent('pause', onVimeoPause);
							player.addEvent('finish', onVimeoFinish);
							player.addEvent('play', onVimeoPlay);
						});
					});
					clearInterval(vimeoLoadingTimer);
				}
			}, 100);
		};

		onVimeoPause = function(event) {
			cloudInstance.options.isVideoPlaying = false;
			if (cloudInstance.options.currentSky.find('#' + event).length > 0) {
				if (cloudInstance.options.onHoverPause) {
					if (!cloudInstance.options.mouseEntered) {
						cloudInstance.resume();
					}
				} else {
					cloudInstance.resume();
				}
			}
		};

		onVimeoFinish = function(event) {
			cloudInstance.options.isVideoPlaying = false;
			if (cloudInstance.options.currentSky.find('#' + event).length > 0) {
				cloudInstance.resume();
			}
		};

		onVimeoPlay = function() {
			cloudInstance.options.isVideoPlaying = true;
			if (cloudInstance.options.video.pauseWhilePlaying) {
				cloudInstance.pause();
			}
		};

		// Video & Audio Load & Define Listeners
		onVidaudPause = function() {
			cloudInstance.options.isVideoPlaying = false;
			if (cloudInstance.options.currentSky.find($(this)).length > 0) {
				if (cloudInstance.options.onHoverPause) {
					if (!cloudInstance.options.mouseEntered) {
						cloudInstance.resume();
					}
				} else {
					cloudInstance.resume();
				}
			}
		};

		onVidaudEnded = function() {
			cloudInstance.options.isVideoPlaying = false;
			if (cloudInstance.options.currentSky.find($(this)).length > 0) {
				cloudInstance.resume();
			}
		};

		onVidaudPlay = function() {
			cloudInstance.options.isVideoPlaying = true;
			if (cloudInstance.options.video.pauseWhilePlaying) {
				cloudInstance.pause();
			}
		};

		var cloudInstance = this;

		var cloud_container = $(cloud_container).addClass('cloud-container').wrapInner('<div class="cloud-wrapper"></div>');
		var cloud_wrapper = cloud_container.find('.cloud-wrapper');
		var cloud_others = $('<div class="cloud-others" />').appendTo(cloud_container);

		cloudInstance.initialize = function() {

			var cloud_options_tmp;

			if (skins[param_options.skin]) {

				var skin = skins[param_options.skin];

				cloud_options_tmp = $.extend({}, cloud_options, skin);

				if (skin.arrow) {
					cloud_options_tmp.arrow = $.extend({}, cloud_options.arrow, skin.arrow);
				}
				if (skin.bullet) {
					cloud_options_tmp.bullet = $.extend({}, cloud_options.bullet, skin.bullet);
				}
				if (skin.thumb) {
					cloud_options_tmp.thumb = $.extend({}, cloud_options.thumb, skin.thumb);
				}
				if (skin.video) {
					cloud_options_tmp.video = $.extend({}, cloud_options.video, skin.video);
				}

				if ((cloud_container.attr('style') + '').indexOf('background-image') == -1 && skin.containerBgImgSrc && (/^url\((['"]?)(.*)\1\)$/.exec(cloud_container.css('background-image')) == null || /^url\((['"]?)(.*)\1\)$/.exec(cloud_container.css('background-image')) == "")) {
					cloud_container.css('background-image', 'url(' + skin.containerBgImgSrc + ')');
				}

				if (skin.containerBgColor && (cloud_container.attr('style') + '').indexOf('background-color') == -1 && (cloud_container.css('background-color') == "rgba(0, 0, 0, 0)" || cloud_container.css('background-color') == "transparent")) {
					cloud_container.css('background-color', skin.containerBgColor);
				}

				if (skin.containerBorder && (cloud_container.attr('style') + '').indexOf('padding') == -1 && (parseInt(cloud_container.css('padding-top')) == 0 && parseInt(cloud_container.css('padding-right')) == 0 && parseInt(cloud_container.css('padding-bottom')) == 0 && parseInt(cloud_container.css('padding-left')) == 0)) {
					cloud_container.css('padding', skin.containerBorder);
				}

				if (skin.containerBoxShadow && (cloud_container.attr('style') + '').indexOf('box-shadow') == -1 && cloud_container.css('box-shadow') == 'none') {
					cloud_container.css({
						'box-shadow': skin.containerBoxShadow,
						'-moz-box-shadow': skin.containerBoxShadow,
						'-webkit-box-shadow': skin.containerBoxShadow
					});
				}
			} else {
				cloud_options_tmp = cloud_options;
			}

			cloudInstance.options = $.extend({}, cloud_options_tmp, param_options);

			if (param_options.arrow) {
				cloudInstance.options.arrow = $.extend({}, cloud_options_tmp.arrow, param_options.arrow);
			}
			if (param_options.bullet) {
				cloudInstance.options.bullet = $.extend({}, cloud_options_tmp.bullet, param_options.bullet);
			}
			if (param_options.thumb) {
				cloudInstance.options.thumb = $.extend({}, cloud_options_tmp.thumb, param_options.thumb);
			}
			if (param_options.video) {
				cloudInstance.options.video = $.extend({}, cloud_options_tmp.video, param_options.video);
			}

			cloud_container.data('instance', cloudInstance);
			cloud_container.data('margin-bottom', cloud_container.css('margin-bottom'));

			if (cloudInstance.options.fullSize) cloudInstance.options.fullWidth = true;

			var cloud_container_style = cloud_container[0].style;

			if (!cloudInstance.options.width) {
				cloudInstance.options.width = cloud_container_style.width;
			}

			cloudInstance.options.responsiveWidth = cloudInstance.options.width;
			
			if (!cloudInstance.options.height) {
				cloudInstance.options.height = cloud_container_style.height;
			}

			cloudInstance.options.responsiveHeight = cloudInstance.options.height;

			if ($.isNumeric(cloudInstance.options.responsiveWidth)) {
				cloudInstance.options.responsiveWidth += 'px';
			}

			if ($.isNumeric(cloudInstance.options.responsiveHeight)) {
				cloudInstance.options.responsiveHeight += 'px';
			}

			if ((cloudInstance.options.width + '').indexOf('%') == -1) {
				cloudInstance.options.width = parseInt(cloudInstance.options.width);
			}
			if ((cloudInstance.options.height + '').indexOf('%') == -1) {
				cloudInstance.options.height = parseInt(cloudInstance.options.height);
			}

			cloudInstance.options.originalResponsive = cloudInstance.options.responsive;

			cloudInstance.options.containerPaddingLeft = parseInt(cloud_container.css('padding-left'));
			cloudInstance.options.containerPaddingRight = parseInt(cloud_container.css('padding-right'));
			cloudInstance.options.containerPaddingTop = parseInt(cloud_container.css('padding-top'));
			cloudInstance.options.containerPaddingBottom = parseInt(cloud_container.css('padding-bottom'));

			cloud_container.css({
				width: cloudInstance.options.responsiveWidth,
				height: cloudInstance.options.responsiveHeight,
				padding: 0
			});

			cloudInstance.options.width = cloud_container.width();
			cloudInstance.options.height = cloud_container.height();

			cloudInstance.options.numberOfSlides = cloud_container.find('.kr-sky').length;

			if (cloudInstance.options.numberOfSlides < 2) {
				if (cloudInstance.options.numberOfSlides == 0) {
					return false;
				}				
				cloudInstance.options.startSlideNo = 0;
				cloudInstance.options.navType = 'none';
				cloudInstance.options.shuffleMode = false;
				//cloudInstance.options.onHoverPause = false;
				cloudInstance.options.autoSlideCarousel = 'slide';				
				cloudInstance.options.keyNavigation = false;
				cloudInstance.options.arrow.visibility = 'hide';
				cloudInstance.options.video.pauseWhilePlaying = true;
			} else if (cloudInstance.options.shuffleMode && typeof param_options.startSlideNo == 'undefined') {
				cloudInstance.options.startSlideNo = Math.floor(Math.random() * cloudInstance.options.numberOfSlides) + 1;
			} else {
				cloudInstance.options.startSlideNo = Math.max(0, Math.min(cloudInstance.options.startSlideNo - 1, cloudInstance.options.numberOfSlides - 1));
			}
			// Prepare Current Sky Number and Current Sky Object
			cloudInstance.options.currentSkyNo = (cloudInstance.options.startSlideNo == 0) ? cloudInstance.options.numberOfSlides - 1 : cloudInstance.options.startSlideNo - 1;
			cloudInstance.options.currentSky = cloud_container.find('.kr-sky:eq(' + (cloudInstance.options.currentSkyNo) + ')');			

			// Prepare Timeouts Array
			cloudInstance.options.timeouts = [];

			var indPlayer = 0;
			var firstScriptElement = $('head').find('script').eq(0);

			// Youtube Iframes Initialization & Youtube API Loading if needed
			var needYoutubeAPI = false;
			var youtubeApiSrc = "https://www.youtube.com/iframe_api";
			
			cloud_container.find('.kr-cloud iframe[src*="youtu"]').each(function() {

				var iframe = $(this);
				var cloud = iframe.closest('.kr-cloud');
				
				if (cloud.width() <= 0) {
					cloud.css('width', iframe.width());
				}
				if (cloud.height() <= 0) {
					cloud.css('height', iframe.height());
				}

				if (!iframe.attr('width')) {
					 iframe.attr('width', iframe.parent().width());
				}
				if (!iframe.attr('height')) {
					 iframe.attr('height', iframe.parent().height());
				}

				var videoId = get_youtube_code(iframe.attr('src'));
				
				iframe.wrap('<div id="kr-player-' + (indPlayer++) + '" class="kr-youtube-player"></div>');
				
				iframe.data('videoId', videoId);
				
				needYoutubeAPI = true;
			});
			
			if (needYoutubeAPI && $('head').find('script[src*="www.youtube.com/iframe_api"]').length <= 0) {
				if (firstScriptElement) {
					$('<script src="' + youtubeApiSrc + '"></script>').insertBefore(firstScriptElement);
				} else {
					$('<script src="' + vimeoApiSrc + '"></script>').appendTo('head');
				}
			}

			// Vimeo Iframes Initialization & Vimeo API Loading if needed
			var needVimeoAPI = false;
			var vimeoApiSrc = "http://a.vimeocdn.com/js/froogaloop2.min.js";

			if (location.protocol === 'https:') {
				vimeoApiSrc = "https://a.vimeocdn.com/js/froogaloop2.min.js";
			}

			cloud_container.find('.kr-cloud iframe[src*="vimeo"]').each(function() {
									
				var iframe = $(this);
				var cloud = iframe.closest('.kr-cloud');
				
				if (cloud.width() <= 0) {
					cloud.css('width', iframe.width());
				}
				if (cloud.height() <= 0) {
					cloud.css('height', iframe.height());
				}

				if (!iframe.attr('width')) {
					 iframe.attr('width', iframe.parent().width());
				}
				if (!iframe.attr('height')) {
					 iframe.attr('height', iframe.parent().height());
				}

				var videoId = get_vimeo_code(iframe.attr('src'));
				var iframeId = 'kr-player-' + (indPlayer++);
				iframe.attr('id', iframeId);
				
				iframe.attr('src', 'http://player.vimeo.com/video/' + videoId + '?api=1&player_id=' + iframeId + '&amp;title=0&amp;byline=0&amp;portrait=0');

				iframe.data('src', iframe.attr('src'));
				iframe.addClass('kr-vimeo-player');

				needVimeoAPI = true;
			});

			if (needVimeoAPI) {
				if ($('head').find('script[src="' + vimeoApiSrc + '"]').length <= 0) {
					if (firstScriptElement) {
						$('<script src="' + vimeoApiSrc + '"></script>').insertBefore(firstScriptElement);
					} else {
						$('<script src="' + vimeoApiSrc + '"></script>').appendTo('head');
					}
				}
				onVimeoIframeAPIReady();
			}

			// HTML5 Video & Audio Initialization
			cloud_container.find('.kr-cloud video, .kr-cloud audio').each(function() {
				if (typeof document.createElement('video').canPlayType != 'undefined') {
					var vidaud = $(this);
					var cloud = vidaud.closest('.kr-cloud');
					if (parseInt(vidaud.attr('width')) > 0) {
						vidaud.css('width', parseInt(vidaud.attr('width')));
					}
					if (parseInt(vidaud.attr('height')) > 0) {
						vidaud.css('height', parseInt(vidaud.attr('height')));
					}
					if (vidaud.width() <= 0) {
						vidaud.attr('width', cloud.width());
					}
					if (vidaud.height() <= 0) {
						vidaud.attr('height', cloud.height());
					}

					cloud.css('width', vidaud.width()).data('width', vidaud.width());
					cloud.css('height', vidaud.height()).data('height', vidaud.height());

					vidaud.css('width', '100%').show();
					vidaud.css('height', '100%').show();

					vidaud.on('play', onVidaudPlay);
					vidaud.on('pause', onVidaudPause);
					vidaud.on('ended', onVidaudEnded);
				} else {
					$(this).closest('.kr-cloud').remove();
				}
			});

			cloud_container.find('img.sky-background').each(function() {
				var sky_background = $('<div class="sky-background" />');
				if ($(this).parent().is('a')) {
					var bg_link_target = (typeof $(this).parent().attr('target') != 'undefined') ? ' target="' + $(this).parent().attr('target') + '"' : '';
					$('<a class="kr-bg-link" href="' + $(this).parent().attr('href') + '"' + bg_link_target + '></a>').appendTo($(this).closest('.kr-sky'));
					$(this).unwrap();
				}
				$(this).removeClass('sky-background').wrap(sky_background);
			});

			// Prepare Loader Gif
			cloudInstance.options.loader = $('<img class="kr-loader" src="' + cloudInstance.options.imgLoader + '" />').appendTo(cloud_container);

			// Prepare Progress Bar
			cloudInstance.options.progressBar = $('<div class="kr-line-timer kr-' + cloudInstance.options.progressBarPosition + '">').appendTo(cloud_container);

			cloudInstance.options.progressBar.css({
				backgroundColor: cloudInstance.options.progressBarColor,
				height: parseInt(cloudInstance.options.progressBarThick)
			});
			
			// Count for showed carousel for autoSlideCarousel option
			if (cloudInstance.options.autoSlideCarousel == 'combine') {
				cloudInstance.options.carouselShowed = 0;
				cloudInstance.options.carouselRepeated = false;
			}

			cloud_container.find('.kr-sky').each(function() {
				var transitionStr = ($(this).data('transition') + '').toLowerCase();
				var transitions = transitionStr.split(',');
				var transitionList = [];
				var sky = $(this);

				if (!supports3d()) {

					if (transitionStr.indexOf('all') != -1 || transitionStr.indexOf('2d') != -1) {
						transitionList.push('2d');
					} else {
						for (var i = 0; i < transitions.length; i++) {
							var transitionId = transitions[i];

							if ($.isNumeric(transitionId)) {
								var transition = get_transitions(transitionId);
								if (transition) {
									if (transition.cellThick == 0) {
										transitionList.push(transitionId);
									}
								}
							}
						}
					}
				} else {
					if (transitionStr.indexOf('all') != -1 || (transitionStr.indexOf('2d') != -1 && transitionStr.indexOf('3d') != -1)) {
						transitionList.push('all');
					}  else {
						for (var i = 0; i < transitions.length; i++) {
							var transitionId = transitions[i];

							if ($.isNumeric(transitionId)) {
								var transition = get_transitions(transitionId);
								if (transition) {
									if (transition.cellThick == 0 && transitionStr.indexOf('2d') == -1) {
										transitionList.push(transitionId);
									} else if (transition.cellThick > 0 && transitionStr.indexOf('3d') == -1) {
										transitionList.push(transitionId);
									} 
								}
							} else if (transitionStr.indexOf('2d') != -1) {
								transitionList.push('2d');
							} else if (transitionStr.indexOf('3d') != -1) {
								transitionList.push('3d');
							}
						}
					}
				}

				if (transitionList.length == 0 || is_lowerIE8()) {
					transitionList = cloudInstance.options.constant.defaultTransition;
				}

				sky.data('transitionlist', transitionList);

				sky.find('.kr-cloud').wrapAll('<div class="kr-clouds" />');

				if (!sky.data('duration')) {
					sky.data('duration', cloudInstance.options.constant.defaultSlideDelay);
				}

				// Ken Burn Prepare
				if (typeof $(this).data('ken') != 'undefined') {
					var kenData = ($(this).data('ken') + '').split(';');
					for (var i = 0; i < kenData.length; i++) {
						var ken = kenData[i].split(':');
						if (ken.length == 2) {
							sky.data('ken-' + ken[0].replace(/ /g, ''), ken[1].replace(/ /g, ''));
						}
					}
				}

				// Carousel Prepare
				if (sky.data('carousel') && cloudInstance.options[sky.data('carousel')]) {
					cloudInstance.options[sky.data('carousel')] = $.extend({}, cloudInstance.options.constant.carousel, cloudInstance.options[sky.data('carousel')]);
					if (cloudInstance.options[sky.data('carousel')]['arrow']) {
						cloudInstance.options[sky.data('carousel')]['arrow'] = $.extend({}, cloudInstance.options.constant.carousel.arrow, cloudInstance.options[sky.data('carousel')]['arrow']);
					}
					if (cloudInstance.options[sky.data('carousel')]['level'].length > 0) {
						for (var i = 0; i < cloudInstance.options[sky.data('carousel')]['level'].length; i++) {
							cloudInstance.options[sky.data('carousel')]['level'][i] = $.extend({}, cloudInstance.options.constant.carousel.level[i], cloudInstance.options[sky.data('carousel')]['level'][i]);
						}
					}
					sky.data('carousel', cloudInstance.options[sky.data('carousel')]);
				}else if (sky.find('.kr-carousel').length > 0) {
					sky.data('carousel', cloudInstance.options.constant.carousel);
				}

				if (sky.data('carousel')) {
					var firstShow = parseInt(sky.data('carousel').firstShow) - 1;
					var carousel_count = sky.find('.kr-carousel').length;
					var level_count = Math.floor(carousel_count / 2);

					cloudInstance.options.responsive = true;
					if (firstShow == 'random') {
						sky.data('current_carousel', Math.floor(Math.random() * carousel_count));
					}else if (firstShow > 0 && firstShow < carousel_count) {
						sky.data('current_carousel', firstShow);
					}else {
						sky.data('current_carousel', 0);
					}

					for (var i = 0; i < level_count; i++) {
						if (!sky.data('carousel').level[i]) {
							sky.data('carousel').level.push($.extend({}, sky.data('carousel').level[sky.data('carousel').level.length - 1]));
						}
					}
				}

				sky.find('img').each(function() {
					if (cloudInstance.options.lazyImageLoad) {
						if (!$(this).data('src') || $(this).data('src') == '') {
							$(this).data('src', $(this).attr('src'));
						}
					}
				});
			});
			
			// Initializinig for carousel
			cloud_container.find('.kr-carousel').each(function() {
				var carousel;
				if ($(this).find('.kr-carousel-img').length > 0) {
					carousel = $(this).find('.kr-carousel-img');
				} else {
					carousel = $(this).removeClass('kr-carousel').removeClass('kr-cloud').addClass('kr-carousel-img');
					carousel.wrap($('<div class="kr-carousel" style="' + carousel.attr('style') + '"></div>')
						.data('border_left', carousel.css('border-left-width'))
						.data('border_right', carousel.css('border-right-width'))
						.data('border_top', carousel.css('border-top-width'))
						.data('border_bottom', carousel.css('border-bottom-width')));
				}
				var clouds = carousel.closest('.kr-clouds');
				var sky = clouds.closest('.kr-sky');

				if (sky.data('carousel').itemSize.width) {
					carousel.closest('.kr-carousel').css('width', sky.data('carousel').itemSize.width);
					carousel.closest('.kr-carousel').data('width', sky.data('carousel').itemSize.width);
				}
				if (sky.data('carousel').itemSize.height) {
					carousel.closest('.kr-carousel').css('height', sky.data('carousel').itemSize.height);
					carousel.closest('.kr-carousel').data('height', sky.data('carousel').itemSize.height);
				}

				if (clouds.find('.kr-carousel-container').length > 0) {
				}else {
					$('<div class="kr-cloud kr-carousel-container"><div class="kr-carousel-wrapper"></div></div>').prependTo(clouds);
				}
				carousel.parent().appendTo(clouds.find('.kr-carousel-wrapper'));

				if (sky.data('carousel').arrow.visibility != 'hide') {
					if (sky.find('.kr-carousel-container .kr-carousel-left-arrow').length > 0) {
					} else {
						var additional_class = '';
						if (sky.data('carousel').arrow.visibility == 'hover') {
							additional_class = ' kr-hidden';
						}
						$('<div class="kr-carousel-left-arrow' + additional_class + '"><img src="' + sky.data('carousel').arrow.imgPrev + '" /></div>').appendTo(sky.find('.kr-carousel-container'));
						$('<div class="kr-carousel-right-arrow' + additional_class + '"><img src="' + sky.data('carousel').arrow.imgNext + '" /></div>').appendTo(sky.find('.kr-carousel-container'));
					}
				}
			});
			
			if (cloudInstance.options.numberOfSlides == 1 && cloudInstance.options.currentSky.find('.kr-carousel-container').length > 0) {
				cloudInstance.options.autoSlideCarousel = 'carousel';
			}

			cloud_container.on('dragstart', function(event) {
				event.preventDefault();
			});

			// Add listeners for carousel
			cloud_container.find('.kr-carousel-container').closest('.kr-clouds').hover(function() {
				if ($(this).closest('.kr-sky').data('carousel').arrow.visibility == 'hover') {
					if (is_lowerIE8()) {
						cloud_container.find('.kr-carousel-left-arrow, .kr-carousel-right-arrow').removeClass('kr-hidden');
					}else {
						cloud_container.find('.kr-carousel-left-arrow, .kr-carousel-right-arrow').stop(true, true).fadeIn();
					}
				}
			}, function() {
				if ($(this).closest('.kr-sky').data('carousel').arrow.visibility == 'hover') {
					if (is_lowerIE8()) {
						cloud_container.find('.kr-carousel-left-arrow, .kr-carousel-right-arrow').addClass('kr-hidden');
					}else {
						cloud_container.find('.kr-carousel-left-arrow, .kr-carousel-right-arrow').stop(true, true).fadeOut();
					}
				}
			});

			cloud_container.find('.kr-carousel-left-arrow').on('click', function() {
				cloudInstance.flowCarouselTo('left');
			});
			cloud_container.find('.kr-carousel-right-arrow').click(function() {
				cloudInstance.flowCarouselTo('right');
			});

			cloud_wrapper.mousedown(function(e) {
				cloudInstance.options.sliderDragStart = e.pageX;
			});

			$(document).mousemove(function(e) {

				if (typeof cloudInstance.options.sliderDragStart != 'undefined' && cloudInstance.options.sliderDragStart != -1) {

					var dragDistance = cloudInstance.options.sliderDragStart - e.pageX;
					if (dragDistance > 0) {
						if (!cloudInstance.options.isBusy) {
							if (cloudInstance.options.currentSky.find('.kr-carousel-container').length > 0) {
								if (cloudInstance.options.autoSlideCarousel == 'combine') {
								 	cloudInstance.options.carouselRepeated = false;
								 	cloudInstance.options.carouselShowed = 0;
								}
								cloudInstance.flowCarouselTo('right');
							} else if (cloud_container.find('.kr-sky').length > 1) {
								cloudInstance.flowTo('right');	
							}							
						}
					}else if (dragDistance < -0) {
						if (!cloudInstance.options.isBusy) {
							if (cloudInstance.options.currentSky.find('.kr-carousel-container').length > 0) {
								cloudInstance.flowCarouselTo('left');
								if (cloudInstance.options.autoSlideCarousel == 'combine') {
								 	cloudInstance.options.carouselRepeated = false;
								 	cloudInstance.options.carouselShowed = 0;
								}
							} else if (cloud_container.find('.kr-sky').length > 1) {
								cloudInstance.flowTo('left');
							}
						}
					}
					cloudInstance.options.sliderDragStart = e.pageX;
				}

			}).mouseup(function(e) {
				cloudInstance.options.sliderDragStart = -1;
			});

			if('ontouchstart' in window) {
				// Touch enabling for slider
				cloud_wrapper.on('touchstart', function(event) {
					
					var touches = event.touches ? event.touches : event.originalEvent.touches;
					if (touches.length == 1) {
						cloudInstance.options.sliderDragStart = touches[0].clientX;
					}
			    });

				cloud_wrapper.on('touchmove', function(event) {

					var touches = event.touches ? event.touches : event.originalEvent.touches;
					var dragDistance = cloudInstance.options.sliderDragStart - touches[0].clientX;
					if (dragDistance > 30) {
						if (!cloudInstance.options.isBusy) {
							event.preventDefault();
							if (cloudInstance.options.currentSky.find('.kr-carousel-container').length > 0) {
								cloudInstance.flowCarouselTo('right');
							} else {
								cloudInstance.flowTo('right');
							}
						}
					}else if (dragDistance < -30) {
						if (!cloudInstance.options.isBusy) {
							event.preventDefault();
							if (cloudInstance.options.currentSky.find('.kr-carousel-container').length > 0) {
								cloudInstance.flowCarouselTo('left');
							} else {
								cloudInstance.flowTo('left');
							}
						}
					}else {

					}
					cloudInstance.options.sliderDragStart = touches[0].clientX;
			    });

				cloud_wrapper.on('touchend',function(event) {
					var target = $(event.target);
					cloudInstance.options.sliderDragStart = -1;
				});
			}

			// Initializing for responsive
			cloud_container.find('.kr-cloud').each(function() {

				var cloud = $(this);

				cloud.data('anchored', false);

				if ((cloud[0].style.width + '').indexOf('%') !== -1) {
					cloud.css('width', cloud_container.width() / 100 * parseInt(cloud[0].style.width));
				}

				cloud.data('left', cloud.css('left'));
				cloud.data('top', cloud.css('top'));

				cloud.data('width', cloud.width());
				cloud.data('height', cloud.height());

				cloud.data('margin_top', cloud.css('margin-top'));
				cloud.data('margin_right', cloud.css('margin-right'));
				cloud.data('margin_bottom', cloud.css('margin-bottom'));
				cloud.data('margin_left', cloud.css('margin-left'));

				cloud.data('padding_left', cloud.css('padding-left'));
				cloud.data('padding_right', cloud.css('padding-right'));
				cloud.data('padding_top', cloud.css('padding-top'));
				cloud.data('padding_bottom', cloud.css('padding-bottom'));
				
				cloud.data('border_left', cloud.css('border-left-width'));
				cloud.data('border_right', cloud.css('border-right-width'));
				cloud.data('border_top', cloud.css('border-top-width'));
				cloud.data('border_bottom', cloud.css('border-bottom-width'));

				cloud.data('font_size', cloud.css('font-size'));
				cloud.data('line_height', cloud.css('line-height'));

				cloud.data('opacity', 1);
				if ($.isNumeric(cloud.css('opacity'))) {
					cloud.data('opacity', cloud.css('opacity'));
				}
				
				if (cloud.data('transitionin')) {
					var transitionInData = (cloud.data('transitionin') + '').split(';');
					for (var i = 0; i < transitionInData.length; i++) {
						var transitionIn = transitionInData[i].split(':');
						if (transitionIn.length == 2) {
							cloud.data(transitionIn[0].replace(/ /g, '') + 'in', transitionIn[1]);
						}
					}
				}

				if (cloud.data('transitionout')) {
					var transitionOutData = (cloud.data('transitionout') + '').split(';');
					for (var i = 0; i < transitionOutData.length; i++) {
						var transitionOut = transitionOutData[i].split(':');
						if (transitionOut.length == 2) {
							cloud.data(transitionOut[0].replace(/ /g, '') + 'out', transitionOut[1]);
						}
					}
				}

				// Set Default Options For Cloud Transition In
				if (typeof cloud.data('offsetxin') == 'undefined') {
					cloud.data('offsetxin', 0);
				}else {
					cloud.data('offsetxin', parseFloat(cloud.data('offsetxin')));
				}
				if (typeof cloud.data('offsetyin') == 'undefined') {
					cloud.data('offsetyin', 0);
				}else {
					cloud.data('offsetyin', parseFloat(cloud.data('offsetyin')));
				}
				if (typeof cloud.data('rotatein') == 'undefined') {
					cloud.data('rotatein', 0);
				}else {
					cloud.data('rotatein', parseFloat(cloud.data('rotatein')));
				}
				if (typeof cloud.data('rotatexin') == 'undefined') {
					cloud.data('rotatexin', 0);
				}else {
					cloud.data('rotatexin', parseFloat(cloud.data('rotatexin')));
				}
				if (typeof cloud.data('rotateyin') == 'undefined') {
					cloud.data('rotateyin', 0);
				}else {
					cloud.data('rotateyin', parseFloat(cloud.data('rotateyin')));
				}
				if (typeof cloud.data('scalexin') == 'undefined') {
					cloud.data('scalexin', 1);
				}else {
					cloud.data('scalexin', parseFloat(cloud.data('scalexin')));
				}
				if (typeof cloud.data('scaleyin') == 'undefined') {
					cloud.data('scaleyin', 1);
				}else {
					cloud.data('scaleyin', parseFloat(cloud.data('scaleyin')));
				}
				if (typeof cloud.data('skewxin') == 'undefined') {
					cloud.data('skewxin', 0);
				}else {
					cloud.data('skewxin', parseFloat(cloud.data('skewxin')));
				}
				if (typeof cloud.data('skewyin') == 'undefined') {
					cloud.data('skewyin', 0);
				}else {
					cloud.data('skewyin', parseFloat(cloud.data('skewyin')));
				}
				if (typeof cloud.data('delayin') == 'undefined') {
					cloud.data('delayin', 0);
				}else {
					cloud.data('delayin', parseFloat(cloud.data('delayin')));
				}
				if (typeof cloud.data('durationin') == 'undefined') {
					cloud.data('durationin', 800);
				}else {
					cloud.data('durationin', parseFloat(cloud.data('durationin')));
				}
				if (typeof cloud.data('easingin') == 'undefined') {
					cloud.data('easingin', 'easeInOutExpo');
				}
				if (typeof cloud.data('perspectivein') == 'undefined') {
					cloud.data('perspectivein', 400);
				}else {
					cloud.data('perspectivein', parseFloat(cloud.data('perspectivein')));
				}
				if (typeof cloud.data('transformoriginin') == 'undefined') {
					cloud.data('transformoriginin', '50% 50% 0');
				}
				if (cloud.data('fadein') == 'false' || cloud.data('fadein') == false) {
					cloud.data('fadein', false);
				}
				
				// Set Default Options For Cloud Transition Out				
				if (typeof cloud.data('offsetxout') == 'undefined') {
					cloud.data('offsetxout', 0);
				}else {
					cloud.data('offsetxout', parseFloat(cloud.data('offsetxout')));
				}
				if (typeof cloud.data('offsetyout') == 'undefined') {
					cloud.data('offsetyout', 0);
				}else {
					cloud.data('offsetyout', parseFloat(cloud.data('offsetyout')));
				}
				if (typeof cloud.data('rotateout') == 'undefined') {
					cloud.data('rotateout', 0);
				}else {
					cloud.data('rotateout', parseFloat(cloud.data('rotateout')));
				}
				if (typeof cloud.data('rotatexout') == 'undefined') {
					cloud.data('rotatexout', 0);
				}else {
					cloud.data('rotatexout', parseFloat(cloud.data('rotatexout')));
				}
				if (typeof cloud.data('rotateyout') == 'undefined') {
					cloud.data('rotateyout', 0);
				}else {
					cloud.data('rotateyout', parseFloat(cloud.data('rotateyout')));
				}
				if (typeof cloud.data('scalexout') == 'undefined') {
					cloud.data('scalexout', 1);
				}else {
					cloud.data('scalexout', parseFloat(cloud.data('scalexout')));
				}
				if (typeof cloud.data('scaleyout') == 'undefined') {
					cloud.data('scaleyout', 1);
				}else {
					cloud.data('scaleyout', parseFloat(cloud.data('scaleyout')));
				}
				if (typeof cloud.data('skewxout') == 'undefined') {
					cloud.data('skewxout', 0);
				}else {
					cloud.data('skewxout', parseFloat(cloud.data('skewxout')));
				}
				if (typeof cloud.data('skewyout') == 'undefined') {
					cloud.data('skewyout', 0);
				}else {
					cloud.data('skewyout', parseFloat(cloud.data('skewyout')));
				}
				if (typeof cloud.data('delayout') == 'undefined') {
					cloud.data('delayout', 0);
				}else {
					cloud.data('delayout', parseFloat(cloud.data('delayout')));
				}
				if (typeof cloud.data('durationout') == 'undefined') {
					cloud.data('durationout', 400);
				}else {
					cloud.data('durationout', parseFloat(cloud.data('durationout')));
				}
				if (typeof cloud.data('easingout') == 'undefined') {
					cloud.data('easingout', 'easeInOutExpo');
				}
				if (typeof cloud.data('perspectiveout') == 'undefined') {
					cloud.data('perspectiveout', 400);
				}else {
					cloud.data('perspectiveout', parseFloat(cloud.data('perspectiveout')));
				}
				if (typeof cloud.data('transformoriginout') == 'undefined') {
					cloud.data('transformoriginout', '50% 50% 0');
				}
				if (cloud.data('fadeout') == 'false' || cloud.data('fadeout') == false) {
					cloud.data('fadeout', false);
				}

				cloud.click(function() {
					if (cloud.data('anchored') === true) {
						cloudInstance.options.onCloudClick(cloud);
					}
				});

				cloud.hover(function() {
					if (cloud.data('anchored') === true) {
						cloudInstance.options.onCloudHover(cloud, true);
					}
				}, function() {
					if (cloud.data('anchored') === true) {
						cloudInstance.options.onCloudHover(cloud, false);
					}
				});
			});

			// Prepare Navigation Arrows
			if (cloudInstance.options.arrow.visibility != 'hide') {
				var additional_class = '';
				if (cloudInstance.options.arrow.visibility != 'show') {
					additional_class = ' kr-hidden';
				}
				var prev_arrow = $('<a class="kr-prev-arrow kr-nav-arrow' + additional_class + '" href="#" />').appendTo(cloud_others);
				var next_arrow = $('<a class="kr-next-arrow kr-nav-arrow' + additional_class + '" href="#" />').appendTo(cloud_others);
				
				if (cloudInstance.options.arrow.imgPrevActivated && cloudInstance.options.arrow.imgPrevActivated.length > 0) {
					$('<img src="' + cloudInstance.options.arrow.imgPrevActivated + '" />').hide().appendTo(cloud_others);
				}
				if (cloudInstance.options.arrow.imgNextActivated && cloudInstance.options.arrow.imgNextActivated.length > 0) {
					$('<img src="' + cloudInstance.options.arrow.imgNextActivated + '" />').hide().appendTo(cloud_others);
				}

				prev_arrow.css({'background-image': 'url(' + cloudInstance.options.arrow.imgPrev + ')'});
				next_arrow.css({'background-image': 'url(' + cloudInstance.options.arrow.imgNext + ')'});

				if (is_lowerIE8()) {
					prev_arrow.css({
						'-ms-filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + cloudInstance.options.arrow.imgPrev + '", sizingMethod="scale")'
					});
					next_arrow.css({
						'-ms-filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + cloudInstance.options.arrow.imgNext + '", sizingMethod="scale")'
					});
				} else {
					prev_arrow.css({'background-image': 'url(' + cloudInstance.options.arrow.imgPrev + ')'});
					next_arrow.css({'background-image': 'url(' + cloudInstance.options.arrow.imgNext + ')'});
				}
				
				cloud_others.find('.kr-nav-arrow').css('width', 0);
				cloud_others.find('.kr-nav-arrow').css('height', 0);

				$('.kr-nav-arrow').on('click', function(e) {
					e.preventDefault();
					if ($(this).hasClass('kr-prev-arrow')) {
						cloud_container.cloudPrev();
					} else if ($(this).hasClass('kr-next-arrow')) {
						cloud_container.cloudNext();
					}
				});

				$('.kr-nav-arrow').hover(function() {
					if ($(this).hasClass('kr-prev-arrow') && cloudInstance.options.arrow.imgPrevActivated && cloudInstance.options.arrow.imgPrevActivated.length > 0) {
						$(this).css({'background-image': 'url(' + cloudInstance.options.arrow.imgPrevActivated + ')'});
					}
					if ($(this).hasClass('kr-next-arrow') && cloudInstance.options.arrow.imgNextActivated && cloudInstance.options.arrow.imgNextActivated.length > 0) {
						$(this).css({'background-image': 'url(' + cloudInstance.options.arrow.imgNextActivated + ')'});
					}
				}, function() {
					$('.kr-prev-arrow').css({'background-image': 'url(' + cloudInstance.options.arrow.imgPrev + ')'});
					$('.kr-next-arrow').css({'background-image': 'url(' + cloudInstance.options.arrow.imgNext + ')'});
				});
			}

			// Prepare Navigation Bullets
			if (cloudInstance.options.navType == 'bullet') {
				var additional_class = '';
				if (cloudInstance.options.bullet.visibility != 'show') {
					additional_class = ' kr-hidden';
				}
				var bullet_container = $('<div class="kr-bullet-container' + additional_class + '" />').appendTo(cloud_others);
				
				if (cloudInstance.options.bullet.imgItemActivated && cloudInstance.options.bullet.imgItemActivated.length > 0) {
					$('<img src="' + cloudInstance.options.bullet.imgItemActivated + '" />').hide().appendTo(cloud_others);
				}

				if (cloudInstance.options.bullet.imgContainerLeft && cloudInstance.options.bullet.imgContainerLeft.length > 0) {
					var bullet_left = $('<a href="#" class="kr-bullet-left" />').appendTo(bullet_container);
					bullet_left.css({
						'background-image': 'url(' + cloudInstance.options.bullet.imgContainerLeft + ')'
					});
				}

				for(var i = 0; i < cloudInstance.options.numberOfSlides; i++) {
					var bullet = $('<a href="#" class="kr-bullet" />').appendTo(bullet_container);

					bullet.data('ind', i);
					bullet.css({
						margin: cloudInstance.options.bullet.itemMargin,
						opacity: cloudInstance.options.bullet.itemOpacity,
						'background-image': 'url(' + cloudInstance.options.bullet.imgItem + ')'
					});
					/*
					if (cloudInstance.options.bullet.itemSize.width) {
						bullet.css({
							width: cloudInstance.options.bullet.itemSize.width
						});
					}
					if (cloudInstance.options.bullet.itemSize.height) {
						bullet.css({
							height: cloudInstance.options.bullet.itemSize.height
						});
					}
					*/
				}

				if (cloudInstance.options.bullet.imgContainerRight && cloudInstance.options.bullet.imgContainerRight.length > 0) {
					var bullet_right = $('<a href="#" class="kr-bullet-right" />').appendTo(bullet_container);
					bullet_right.css({
						'background-image': 'url(' + cloudInstance.options.bullet.imgContainerRight + ')'
					});
				}

				$('.kr-bullet').on('click', function(e) {
					e.preventDefault();
					cloud_container.cloudTo(parseInt($(this).data('ind')) + 1);
				});

				$('.kr-bullet-left, .kr-bullet-right').on('click', function(e) {
					e.preventDefault();
				});

				$('.kr-bullet').hover(function() {
					if (!$(this).hasClass('kr-activated') && cloudInstance.options.bullet.imgItemActivated && cloudInstance.options.bullet.imgItemActivated.length > 0) {
						$(this).stop().css({'background-image': 'url(' + cloudInstance.options.bullet.imgItemActivated + ')'});
					}
				}, function() {
					if (!$(this).hasClass('kr-activated') && cloudInstance.options.bullet.imgItemActivated && cloudInstance.options.bullet.imgItemActivated.length > 0) {
						$(this).stop().css({'background-image': 'url(' + cloudInstance.options.bullet.imgItem + ')'});
					}
				});
			}
			
			// Prepare Navigation Thumbnails
			if (cloudInstance.options.navType == 'thumb') {
				var additional_class = '';
				
				var thumb_container = $('<div class="kr-thumb-container" />').appendTo(cloud_others);
				var thumb_wrapper = $('<div class="kr-thumb-wrapper" />').appendTo(thumb_container);
				var thumb_inner = $('<div class="kr-thumb-inner" />').appendTo(thumb_wrapper);
				
				if (cloudInstance.options.thumb.visibility == 'hover') {
					thumb_container.children().andSelf().css({
						'visibility': 'hidden'
					})
				}

				var thumb_width = 0
				if (parseInt(cloudInstance.options.thumb.itemSize.width) > 0) {
					thumb_width = parseInt(cloudInstance.options.thumb.itemSize.width);
				} else {
					if (parseInt(cloudInstance.options.thumb.itemSize.height) > 0) {
						thumb_width = parseInt(cloudInstance.options.thumb.itemSize.height) * cloudInstance.options.width / cloudInstance.options.height;
					} else {
						thumb_width = cloudInstance.options.width / 10;
					}
				}
				var thumb_height = (parseInt(cloudInstance.options.thumb.itemSize.height) > 0) ? parseInt(cloudInstance.options.thumb.itemSize.height) : thumb_width * cloudInstance.options.height / cloudInstance.options.width;
				
				var thumb;
				var total_width = 0;
				var total_height = 0;

				for(var i = 0; i < cloudInstance.options.numberOfSlides; i++) {

					var thumb_background = cloudInstance.options.thumb.imgNoThumb;
					var background_size = 'cover';
					if (cloud_container.find('.kr-sky').eq(i).data('thumb')) {
						thumb_background = cloud_container.find('.kr-sky').eq(i).data('thumb');
					} else if (cloud_container.find('.kr-sky').eq(i).find('.sky-background img').length > 0) {
						var background_image = cloud_container.find('.kr-sky').eq(i).find('.sky-background img').eq(0);
						thumb_background = background_image.attr('src');
						if (background_image.data('size') == 'contain') {
							background_size = 'contain';
						}
					}

					thumb = $('<a class="kr-thumb">&nbsp;</a>').appendTo(thumb_inner);

					thumb.css({
						backgroundImage: 'url(' + thumb_background + ')',
						backgroundSize: background_size,
						opacity: cloudInstance.options.thumb.itemOpacity,
						borderWidth: cloudInstance.options.thumb.itemBorderWidth,
						borderColor: cloudInstance.options.thumb.itemBorderColor,
						borderStyle: 'solid'
					});

					if (thumb.parent(''))
					if (is_lowerIE8()) {
						thumb.css({
							background: 'none',
							'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + thumb_background.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, '') + '", sizingMethod="scale")',
							'-ms-filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + thumb_background.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, '') + '", sizingMethod="scale")'
						});
					}
					//var thumb_image = $('<img src="' + thumb_background + '" />').attr('data-clickable', 'true').css({width: thumb_width, height: thumb_height}).appendTo(thumb);

					thumb.data('ind', i);

					thumb.css({
						margin: cloudInstance.options.thumb.itemMargin,
						width: thumb_width,
						height: thumb_height
					});
					
					//thumb_image.css({
						//opacity: cloudInstance.options.thumb.opacity
					//});

					total_width += parseFloat(thumb.css('margin-left')) + thumb.width() + parseFloat(thumb.css('margin-right')) + parseInt(thumb.css('border-left-width')) + parseInt(thumb.css('border-right-width'));
					total_height += parseFloat(thumb.css('margin-top')) + thumb.height() + parseFloat(thumb.css('margin-bottom')) + parseInt(thumb.css('border-top-width')) + parseInt(thumb.css('border-bottom-width'));
				}
				thumb_inner.css('padding', cloudInstance.options.thumb.containerPadding);
				thumb_wrapper.css('background-color', cloudInstance.options.thumb.containerBgColor);

				total_width += parseInt(thumb_inner.css('padding-left')) + parseInt(thumb_inner.css('padding-right'));
				var thumb_container_width = 0;

				if (cloudInstance.options.thumb.containerWidth != 'auto' && $.isNumeric(parseInt(cloudInstance.options.thumb.containerWidth))) {
					if ((cloudInstance.options.thumb.containerWidth + '').indexOf('%') !== -1) {
						thumb_container_width = parseInt(cloudInstance.options.thumb.containerWidth) / 100 * cloud_container.width();
					} else {
						thumb_container_width = cloudInstance.options.thumb.containerWidth;
					}
				} else {
					thumb_container_width = (total_width > cloudInstance.options.width) ? cloudInstance.options.responsiveWidth : total_width;
				}

				thumb_container.css({
					margin: '0 auto'
				});
				
				
				
				thumb_container.data('width', parseInt(thumb_container_width));
				
				thumb_container.data('thumb_width', thumb.width());
				thumb_container.data('thumb_height', thumb.height());
				thumb_container.data('thumb_container_padding_top', parseInt(thumb_inner.css('padding-top')));
				thumb_container.data('thumb_container_padding_bottom', parseInt(thumb_inner.css('padding-bottom')));
				thumb_container.data('thumb_container_padding_left', parseInt(thumb_inner.css('padding-left')));
				thumb_container.data('thumb_container_padding_right', parseInt(thumb_inner.css('padding-right')));
				thumb_container.data('thumb_margin_top', parseInt(thumb.css('margin-top')));
				thumb_container.data('thumb_margin_bottom', parseInt(thumb.css('margin-bottom')));
				thumb_container.data('thumb_margin_left', parseInt(thumb.css('margin-left')));
				thumb_container.data('thumb_margin_right', parseInt(thumb.css('margin-right')));
				
				Draggable.create(".kr-thumb-inner", {
					type: 'x',
					edgeResistance: 0.65,
					bounds: '.kr-thumb-wrapper',
					cursor: 'pointer',
					dragClickables: true,
					throwProps: true
				});

				$('.kr-thumb').on('click', function(e) {
					e.preventDefault();
					cloud_container.cloudTo(parseInt($(this).data('ind')) + 1);
				});
			}

			// Prepare Window Resize Action For Responsive
			$(window).resize(function() {

				cloudInstance.pause();
				TweenMax.killTweensOf(cloudInstance.options.currentSky.find('.sky-background img'));

				cloudInstance.options.carouselTimeline = null;
				cloudInstance.options.currentSky.data('isBusy', false);
				cloud_container.find('.kr-carousel').each(function() {
					TweenMax.killTweensOf($(this));
				});

				if (cloudInstance.options.isBusy) {
					cloudInstance.options.needToRedrawSkin = true;
				} else {
					cloudInstance.redrawAll(cloudInstance.options.currentSky);
					cloudInstance.redrawSkin();
				}

				cloudInstance.options.resizeTimeout = setTimeout(function() {

					cloudInstance.redrawAll(cloudInstance.options.currentSky);

					if (!cloudInstance.options.isVideoPlaying) {
						cloudInstance.resume();
					}

					if (typeof cloudInstance.options.kenTween != 'undefined' && cloudInstance.options.kenTween !== false) {
						cloudInstance.options.kenTween.kill();
						//cloudInstance.kenBurn(cloudInstance.options.currentSky);
					}

					clearTimeout(cloudInstance.options.resizeTimeout);
				}, 100);

				cloudInstance.options.timeouts.push(cloudInstance.options.resizeTimeout);

				if (cloudInstance.options.navType == 'thumb') {
					cloudInstance.switchActiveNav();
				}
			});

			// Define Action On Main Wrapper Hover
			cloud_container.mouseenter(function(e) {		// On Mouse Enter
				
				if (!cloudInstance.options.mouseEntered) {
					cloudInstance.options.mouseEntered = true;
					if (cloudInstance.options.arrow.visibility == 'hover') {
						if (is_lowerIE8()) {
							cloud_container.find('.kr-nav-arrow').removeClass('kr-hidden');
						}else {
							cloud_container.find('.kr-nav-arrow').stop(true, true).fadeIn(cloudInstance.options.constant.navFadeDuration);
						}
					}
					if (cloudInstance.options.bullet.visibility == 'hover') {
						if (is_lowerIE8()) {
							cloud_container.find('.kr-bullet-container').removeClass('kr-hidden');
						}else {
							cloud_container.find('.kr-bullet-container').stop(true, true).fadeIn(cloudInstance.options.constant.navFadeDuration);
						}
					}
					if (cloudInstance.options.thumb.visibility == 'hover') {
						cloud_container.find('.kr-thumb-container *').css('visibility', 'visible');
						TweenMax.fromTo(cloud_container.find('.kr-thumb-container'),
							cloudInstance.options.constant.navFadeDuration / 1000,
							{
								opacity: 0,
								visibility: 'visible'
							},
							{
								opacity: 1
							}
						);
					}

					if (cloudInstance.options.onHoverPause) {
						cloudInstance.options.paused = true;
						cloudInstance.pause();
					}
				}
			});

			cloud_container.mouseleave(function() {		// On Mouse Leave

				cloudInstance.options.mouseEntered = false;
				if (cloudInstance.options.arrow.visibility == 'hover') {
					if (is_lowerIE8()) {
						cloud_container.find('.kr-nav-arrow').addClass('kr-hidden');
					}else {
						cloud_container.find('.kr-nav-arrow').stop(true, true).fadeOut(cloudInstance.options.constant.navFadeDuration);
					}
				}
				if (cloudInstance.options.bullet.visibility == 'hover') {
					if (is_lowerIE8()) {
						cloud_container.find('.kr-bullet-container').addClass('kr-hidden');
					}else {
						cloud_container.find('.kr-bullet-container').stop(true, true).fadeOut(cloudInstance.options.constant.navFadeDuration);
					}
				}
				if (cloudInstance.options.thumb.visibility == 'hover') {
					TweenMax.fromTo(cloud_container.find('.kr-thumb-container'),
						cloudInstance.options.constant.navFadeDuration / 1000,
						{
							opacity: 1
						},
						{
							opacity: 0,
							onComplete: function() {
								cloud_container.find('.kr-thumb-container').children().andSelf().css('visibility', 'hidden');
							}
						}
					);
				}

				if (cloudInstance.options.onHoverPause) {
					if (cloudInstance.options.paused) {
						cloudInstance.options.paused = false;
						if (cloudInstance.options.video.pauseWhilePlaying) {
							if (!cloudInstance.options.isVideoPlaying) {
								cloudInstance.resume();
								cloudInstance.options.onResume();
							}
						} else {
							cloudInstance.resume();
							cloudInstance.options.onResume();
						}
					}
				}
			});
			
			// Prepare Sky Index Array for Shuffle Mode
			///if (cloudInstance.options.shuffleMode) {
			cloudInstance.options.skyIndexArray = new Array();

			for (var i = 0; i < cloudInstance.options.numberOfSlides; i++) {
				cloudInstance.options.skyIndexArray.push(i);
			}

			// Prepare Keybord Navigation
			if (cloudInstance.options.keyNavigation) {
				$(document).keydown(function(event) {
					if (!cloudInstance.options.isBusy) {
						if (event.keyCode == 39) {
							cloud_container.cloudNext();
						} else if (event.keyCode == 37) {
							cloud_container.cloudPrev();
						}
					}
				});
			}

			// Redraw container
			cloudInstance.redrawContainer();

			// Count All Images For Container Skin
			var imgCount = 0;

			if (!cloud_others.data('loaded')) {
				cloud_others.find('*').andSelf().each(function() {
					if (($(this).is('img')) || ($(this).css('background-image') && ($(this).css('background-image') + '').indexOf('url') != -1)) {
						imgCount++;
					}
				});
			}

			// Load All Images For Container Skin
			if (imgCount > 0) {
				
				cloudInstance.options.isBusy = true;
				cloudInstance.options.loader.show();

				cloud_others.find('*').andSelf().each(function() {
					
					var imgSrc = '';
					var imgObj = $(this);

					if (!$(this).data('loaded')) {
						if ($(this).is('img')) {
							imgSrc = $(this).attr('src');
						} else if ($(this).css('background-image') && ($(this).css('background-image') + '').indexOf('url') != -1) {
							imgSrc = $(this).css('background-image').replace(/^url\([\"\']?/, '').replace(/[\"\']?\)$/, '');

						}
					}

					if (imgSrc != '') {
						var tmpImg = new Image();
						tmpImg.onload = function() {
							if (imgObj.hasClass('kr-nav-arrow') || imgObj.hasClass('kr-bullet') || imgObj.hasClass('kr-bullet-left') || imgObj.hasClass('kr-bullet-right')) {
								if (imgObj.width() <= 0) {
									if (imgObj.height() <= 0) {
										imgObj.css('width', tmpImg.width);
									} else {
										imgObj.css('width', imgObj.height() * tmpImg.width / tmpImg.height);
									}
								}
								if (imgObj.height() <= 0) {
									if (imgObj.width() <= 0) {
										imgObj.css('height', tmpImg.height);
									} else {
										imgObj.css('height', imgObj.width() * tmpImg.height / tmpImg.width);
									}
								}
								imgObj.data('width', imgObj.width());
								imgObj.data('height', imgObj.height());
							}

							imgCount--;

							if (imgCount == 0) {

								var tmpLoaderImg = new Image();
								tmpLoaderImg.onload = function() {
									cloudInstance.options.loader.data('width', tmpLoaderImg.width);
									cloudInstance.options.loader.data('height', tmpLoaderImg.height);

									cloud_others.data('loaded', true);
									cloudInstance.options.isBusy = false;
									cloudInstance.options.loader.hide();
									
									if (cloudInstance.options.arrow.visiblitiy != 'hide') {
										var arrow_width = parseInt(cloud_others.find('.kr-nav-arrow').width());
										var arrow_height = parseInt(cloud_others.find('.kr-nav-arrow').height());

										var cloud_others_height = cloud_others.height() / 2;
										if (cloudInstance.options.navType == 'thumb' && cloudInstance.options.thumb.visibility == 'show') {
											cloud_others_height = 0;
										}
										cloud_others.find('.kr-nav-arrow').css({top: '50%', marginTop: - arrow_height / 2});

										if (cloudInstance.options.arrow.positionOffset == 'outside') {
											cloudInstance.options.arrow.positionOffset = - arrow_width;
										} else if (cloudInstance.options.arrow.positionOffset == 'inside') {
											cloudInstance.options.arrow.positionOffset = 0;
										}

										cloud_others.find('.kr-prev-arrow').css({left: cloudInstance.options.arrow.positionOffset}).data('left', cloudInstance.options.arrow.positionOffset);
										cloud_others.find('.kr-next-arrow').css({right: cloudInstance.options.arrow.positionOffset}).data('right', cloudInstance.options.arrow.positionOffset);
									}
									if (cloudInstance.options.navType == 'bullet') {
										var bullet_container = cloud_others.find('.kr-bullet-container');
										var bullet = bullet_container.find('.kr-bullet').eq(0);
										var bullet_container_width = (bullet.width() + parseInt(bullet.css('margin-left')) + parseInt(bullet.css('margin-right'))) * bullet_container.find('.kr-bullet').length;
										var bullet_container_height = (bullet.height() + parseInt(bullet.css('margin-top')) + parseInt(bullet.css('margin-bottom')));

										if (bullet_container.find('.kr-bullet-left').length > 0) {
											bullet_container_width += bullet_container.find('.kr-bullet-left').eq(0).width();
										}
										if (bullet_container.find('.kr-bullet-right').length > 0) {
											bullet_container_width += bullet_container.find('.kr-bullet-right').eq(0).width();
										}

										if (cloudInstance.options.bullet.position == 'top_center' || cloudInstance.options.bullet.position == 'bottom_center') {
											bullet_container.css({
												marginLeft: - bullet_container_width / 2
											});
											bullet_container.data('margin_left', - bullet_container_width / 2);
										}
										bullet_container.data('width', bullet_container_width);
										bullet_container.data('height', bullet_container_height);
										
										bullet_container.data('bullet_width', bullet.width());
										bullet_container.data('bullet_height', bullet.height());
										bullet_container.data('bullet_margin_left', parseInt(bullet.css('margin-left')));
										bullet_container.data('bullet_margin_right', parseInt(bullet.css('margin-right')));
										bullet_container.data('bullet_margin_top', parseInt(bullet.css('margin-top')));
										bullet_container.data('bullet_margin_bottom', parseInt(bullet.css('margin-bottom')));

										if (bullet_container.find('.kr-bullet-left').length > 0) {
											bullet_container.data('bullet_left_width', bullet_container.find('.kr-bullet-left').eq(0).width());
										} else {
											bullet_container.data('bullet_left_width', 0);
										}
										if (bullet_container.find('.kr-bullet-right').length > 0) {
											bullet_container.data('bullet_right_width', bullet_container.find('.kr-bullet-right').eq(0).width());
										} else {
											bullet_container.data('bullet_right_width', 0);
										}
									}
									cloud_container.cloudNext();
								}
								tmpLoaderImg.src = cloudInstance.options.loader.attr('src');

								
							}
						}
						tmpImg.src = imgSrc;
					}
				});
			} else {
				cloud_container.cloudNext();
			}
			
			cloudInstance.options.onInit();
		};

		cloudInstance.redrawContainer = function() {

			var marginLeft = (typeof cloud_container.parent().offset() != 'undefined') ? - cloud_container.parent().offset().left - parseInt(cloud_container.parent().css('padding-left')) : 0;
			var marginTop = (typeof cloud_container.parent().offset() != 'undefined') ? cloud_container.parent().offset().top + parseInt(cloud_container.parent().css('padding-top')) : 0;

			// Container Redraw
			if (cloudInstance.options.fullWidth && $(window).width() <= parseInt(cloudInstance.options.width)) {
				cloudInstance.options.responsive = cloudInstance.options.originalResponsive && true;
				cloudInstance.options.responsiveWidth = cloudInstance.options.width;
			}

			if (cloudInstance.options.responsive) {
				cloudInstance.options.responsiveRate = Math.min(1, cloud_container.parent().width() / parseInt(cloudInstance.options.responsiveWidth));
				if (cloudInstance.options.fullWidth && $(window).width() <= parseInt(cloudInstance.options.width)) {
					cloudInstance.options.responsiveRate = Math.min(1, $(window).width() / parseInt(cloudInstance.options.responsiveWidth));
				}
			} else {
				cloudInstance.options.responsiveRate = 1;
			}

			if (cloudInstance.options.fullSize) {
				if ($(window).width() > parseInt(cloudInstance.options.width)) {
					cloudInstance.options.responsive = false;
					cloudInstance.options.responsiveRate = 1;
					cloudInstance.options.fullSizeHeight = parseInt(cloudInstance.options.responsiveHeight) + (cloudInstance.options.responsiveHeight + '').replace(/\d+/g, '');
				} else {
					if (cloudInstance.options.responsive == true) {
						cloudInstance.options.responsive = cloudInstance.options.originalResponsive && true;
						cloudInstance.options.fullSizeHeight = $(window).width() * parseInt(cloudInstance.options.height) / parseInt(cloudInstance.options.width);
					} else {
						cloudInstance.options.responsiveRate = 1;
						cloudInstance.options.fullSizeHeight = parseInt(cloudInstance.options.responsiveHeight) + (cloudInstance.options.responsiveHeight + '').replace(/\d+/g, '');
					}
				}
				cloud_container.css({
					width	: $(window).width(),
					height	: $(window).height() - marginTop,
					marginLeft: marginLeft,
					overflow: 'hidden'
				});

			} else if (cloudInstance.options.fullWidth && $(window).width() > parseInt(cloudInstance.options.width)) {
				cloudInstance.options.responsive = false;
				cloudInstance.options.responsiveRate = 1;
				cloud_container.css({
					width	: $(window).width(),
					height	: parseInt(cloudInstance.options.responsiveHeight) + (cloudInstance.options.responsiveHeight + '').replace(/\d+/g, ''),
					marginLeft: marginLeft,
					overflow: 'hidden'
				});
			} else if(cloudInstance.options.fullWidth) {
				if (cloudInstance.options.responsive) {
					cloud_container.css({
						width	: $(window).width(),
						height	: $(window).width() * parseInt(cloudInstance.options.height) / parseInt(cloudInstance.options.width),
						marginLeft: marginLeft,
						overflow: 'hidden'
					});
				}
			} else {
				cloud_container.css({
					width	: (cloudInstance.options.responsiveRate * parseInt(cloudInstance.options.responsiveWidth)) + (cloudInstance.options.responsiveWidth + '').replace(/\d+/g, ''),
					height	: (cloudInstance.options.responsiveRate * parseInt(cloudInstance.options.responsiveHeight)) + (cloudInstance.options.responsiveHeight + '').replace(/\d+/g, '')
				});
			}


			if (!cloudInstance.options.slideTransitionNeeded) {
				cloud_container.fadeIn();
			}
			
			if (cloudInstance.options.fullWidth) {
				// Redraw again for fullWidth
				if (cloudInstance.options.fullWidth && $(window).width() > parseInt(cloudInstance.options.width)) {
					cloud_container.css({
						marginLeft: marginLeft
					});
					cloud_container.css({
						width	: $(window).width()
					});
				} else if(cloudInstance.options.fullWidth) {
					if(cloudInstance.options.fullSize) {
						cloud_container.css({
							marginLeft: marginLeft
						});
						cloud_container.css({
							width	: $(window).width(),
							height	: $(window).height() - marginTop
						});
						cloudInstance.options.fullSizeHeight = $(window).width() * parseInt(cloudInstance.options.height) / parseInt(cloudInstance.options.width);
					} else {
						cloud_container.css({
							marginLeft: marginLeft
						});
						if (cloudInstance.options.responsive) {
							cloud_container.css({
								width	: $(window).width(),
								height	: $(window).width() * parseInt(cloudInstance.options.height) / parseInt(cloudInstance.options.width)
							});
						}
					}
				}
			}

			// Redraw loader
			var loaderWidth = parseInt(cloudInstance.options.loader.data('width')) * cloudInstance.options.responsiveRate;
			var loaderHeight = parseInt(cloudInstance.options.loader.data('height')) * cloudInstance.options.responsiveRate;
			cloudInstance.options.loader.css({
				width: loaderWidth,
				height: loaderHeight,
				marginLeft: - loaderWidth / 2,
				marginTop: - loaderHeight / 2
			});
		};

		cloudInstance.redrawSkin = function() {

			// Navigation Bullet Redraw
				cloud_others.find('.kr-bullet-container').each(function() {
					var bullet_container = $(this);
					var bullet_rate = (cloudInstance.options.bullet.responsiveLevel - 1 + cloudInstance.options.responsiveRate) / cloudInstance.options.bullet.responsiveLevel;
					
					switch(cloudInstance.options.bullet.position) {
						case 'top_left':
							bullet_container.css({
								left: parseInt(cloudInstance.options.bullet.horizontalOffset) * bullet_rate,
								top: parseInt(cloudInstance.options.bullet.verticalOffset) * bullet_rate
							});
							break;
						case 'top_center':
							bullet_container.css({
								left: '50%',
								top: parseInt(cloudInstance.options.bullet.verticalOffset) * bullet_rate,
								marginLeft: bullet_rate * bullet_container.data('margin_left') + parseInt(cloudInstance.options.bullet.horizontalOffset) * cloudInstance.options.responsiveRate
							});
							break;
						case 'top_right':
							bullet_container.css({
								right: parseInt(cloudInstance.options.bullet.horizontalOffset) * bullet_rate,
								top: parseInt(cloudInstance.options.bullet.verticalOffset) * bullet_rate
							});
							break;
						case 'bottom_left':
							bullet_container.css({
								left: parseInt(cloudInstance.options.bullet.horizontalOffset) * bullet_rate,
								bottom: parseInt(cloudInstance.options.bullet.verticalOffset) * bullet_rate
							});
							break;
						case 'bottom_right':
							bullet_container.css({
								right: parseInt(cloudInstance.options.bullet.horizontalOffset) * bullet_rate,
								bottom: parseInt(cloudInstance.options.bullet.verticalOffset) * bullet_rate
							});
							break;
						default:
							bullet_container.css({
								left: '50%',
								bottom: parseInt(cloudInstance.options.bullet.verticalOffset) * bullet_rate,
								marginLeft: bullet_rate * bullet_container.data('margin_left') + parseInt(cloudInstance.options.bullet.horizontalOffset) * cloudInstance.options.responsiveRate
							});
					}

					/*
					bullet_container.css({
						width: bullet_rate * bullet_container.data('width'),
						height: bullet_rate * bullet_container.data('height')
					});
					*/

					bullet_container.find('.kr-bullet').css({
						width: bullet_rate * bullet_container.data('bullet_width'),
						height: bullet_rate * bullet_container.data('bullet_height'),
						marginLeft: bullet_rate * bullet_container.data('bullet_margin_left'),
						marginRight: bullet_rate * bullet_container.data('bullet_margin_right'),
						marginTop: bullet_rate * bullet_container.data('bullet_margin_top'),
						marginBottom: bullet_rate * bullet_container.data('bullet_margin_bottom')
						//'background-size': bullet_rate * bullet_container.data('bullet_width')
					});
					bullet_container.find('.kr-bullet-left').css({
						width: bullet_rate * bullet_container.data('bullet_left_width'),
						height: bullet_rate * bullet_container.data('bullet_height')
					});
					bullet_container.find('.kr-bullet-right').css({
						width: bullet_rate * bullet_container.data('bullet_right_width'),
						height: bullet_rate * bullet_container.data('bullet_height')
					});
				});
				
				// Navigation Thumbnail Redraw
				cloud_others.find('.kr-thumb-container').each(function() {
					var thumb_container = $(this);
					var thumb_inner = thumb_container.find('.kr-thumb-inner')
					var thumb_rate = (cloudInstance.options.thumb.responsiveLevel - 1 + cloudInstance.options.responsiveRate) / cloudInstance.options.thumb.responsiveLevel;
					
					var thumb_width = Math.round(thumb_rate * thumb_container.data('thumb_width'));
					var thumb_height = Math.round(thumb_rate * thumb_container.data('thumb_height'));

					var thumb_container_padding_left = Math.round(thumb_rate * thumb_container.data('thumb_container_padding_left'));
					var thumb_container_padding_right = Math.round(thumb_rate * thumb_container.data('thumb_container_padding_right'));
					var thumb_container_padding_top = Math.round(thumb_rate * thumb_container.data('thumb_container_padding_top'));
					var thumb_container_padding_bottom = Math.round(thumb_rate * thumb_container.data('thumb_container_padding_bottom'));

					var thumb_margin_left = Math.round(thumb_rate * thumb_container.data('thumb_margin_left'));
					var thumb_margin_right = Math.round(thumb_rate * thumb_container.data('thumb_margin_right'));
					var thumb_margin_top = Math.round(thumb_rate * thumb_container.data('thumb_margin_top'));
					var thumb_margin_bottom = Math.round(thumb_rate * thumb_container.data('thumb_margin_bottom'));

					var thumb_inner_width = (thumb_width + thumb_margin_left + thumb_margin_right + parseInt(thumb_container.find('.kr-thumb').css('border-left-width')) + parseInt(thumb_container.find('.kr-thumb').css('border-right-width'))) * cloudInstance.options.numberOfSlides;
					var thumb_inner_height = thumb_height + thumb_margin_top + thumb_margin_bottom + parseInt(thumb_container.find('.kr-thumb').css('border-top-width')) + parseInt(thumb_container.find('.kr-thumb').css('border-bottom-width'));
					var thumb_container_width = cloudInstance.options.responsiveRate * thumb_container.data('width');

					var thumb_container_offset = 0;
					if (cloudInstance.options.thumb.positionOffset == 'inside') {
						thumb_container_offset = -thumb_inner_height;
					} else if (cloudInstance.options.thumb.positionOffset == 'outside') {
						thumb_container_offset = 0;
					} else {
						thumb_container_offset = thumb_rate * parseInt(cloudInstance.options.thumb.positionOffset);
					}
					thumb_container.find('.kr-thumb').css({
						width: thumb_width,
						height: thumb_height,
						marginLeft: thumb_margin_left,
						marginRight: thumb_margin_right,
						marginTop: thumb_margin_top,
						marginBottom: thumb_margin_bottom,
						lineHeight: thumb_height + 'px'
					});

					thumb_inner.css({
						width: thumb_inner_width,
						height: thumb_inner_height,
						paddingLeft: thumb_container_padding_left,
						paddingRight: thumb_container_padding_right,
						paddingTop: thumb_container_padding_top,
						paddingBottom: thumb_container_padding_bottom
					});

					thumb_container.css({
						width: thumb_container_width,
						height: thumb_inner_height + thumb_container_padding_top + thumb_container_padding_bottom,
						maxWidth: cloudInstance.options.width,
						marginTop: thumb_container_offset
					});
/*
					if (cloudInstance.options.thumb.visibility == 'hover') {
						thumb_container.css({
							marginTop: - thumb_container.height() + containerPaddingBottom
						});						
					} else if (cloudInstance.options.thumb.visibility == 'show') {
						thumb_container.css({
							marginTop: - containerPaddingBottom
						});						
					}
*/
				});
				
				// Nav Arrow Redraw
				cloud_others.find('.kr-nav-arrow').each(function() {
					var nav_arrow = $(this);
					var nav_rate = (cloudInstance.options.arrow.responsiveLevel - 1 + cloudInstance.options.responsiveRate) / cloudInstance.options.arrow.responsiveLevel;

					nav_arrow.css({
						width: nav_rate * parseInt(nav_arrow.data('width')),
						height: nav_rate * parseInt(nav_arrow.data('height')),
						marginLeft: nav_rate * parseInt(nav_arrow.data('margin_left')),
						right: nav_rate * parseInt(nav_arrow.data('right')),
						bottom: nav_rate * parseInt(nav_arrow.data('bottom'))
						//'background-size': nav_rate * parseInt(nav_arrow.data('width'))
					});
					
					var arrow_width = nav_arrow.width();
					var arrow_height = nav_arrow.height();


					if ((nav_arrow.data('left') + '').indexOf('%') === -1) {
						nav_arrow.css({
							left: nav_rate * parseInt(nav_arrow.data('left'))
						});
					}
					nav_arrow.css({top: '50%', marginTop: - arrow_height / 2});
				});			
		};

		cloudInstance.redrawAll = function(sky) {

			if (!cloudInstance.options.isBusy) {

				// Redraw container
				cloudInstance.redrawContainer();

				var oldW = parseInt(parseFloat(cloud_wrapper.css('width')));
				var containerPaddingLeft = cloudInstance.options.responsiveRate * cloudInstance.options.containerPaddingLeft;
				var containerPaddingRight = cloudInstance.options.responsiveRate * cloudInstance.options.containerPaddingRight;
				var containerPaddingTop = cloudInstance.options.responsiveRate * cloudInstance.options.containerPaddingTop;
				var containerPaddingBottom = cloudInstance.options.responsiveRate * cloudInstance.options.containerPaddingBottom;

				var widthWrapper = cloud_container.width() - containerPaddingLeft - containerPaddingRight;
				var heightWrapper = cloud_container.height() - containerPaddingTop - containerPaddingBottom;

				// Redraw wrapper
				cloud_wrapper.css({
					width: widthWrapper,
					height: heightWrapper,
					paddingLeft: containerPaddingLeft,
					paddingRight: containerPaddingRight,
					paddingTop: containerPaddingTop,
					paddingBottom: containerPaddingBottom
				});
/*
				if (cloudInstance.options.navType == 'thumb' && cloudInstance.options.thumb.visibility == 'show') {
					cloud_others.css({
						marginTop: containerPaddingBottom
					});
				}
*/
				cloud_container.find('.kr-sky').css({
					width	: widthWrapper,
					height	: heightWrapper
				});

				var newW = parseInt(parseFloat(cloud_wrapper.css('width')));

				var progressBarWidth = parseInt(cloudInstance.options.progressBar.width());
				cloudInstance.options.progressBar.css({
					width: progressBarWidth * newW / oldW,
					left: containerPaddingLeft
				});

				if(cloudInstance.options.progressBarPosition == 'top') {
					cloudInstance.options.progressBar.css({
						top: containerPaddingTop
					});
				} else {
					cloudInstance.options.progressBar.css({
						bottom: containerPaddingBottom
					});
				}

				if (cloudInstance.options.responsive || cloudInstance.options.fullWidth) {

					sky.children().each(function() {
						
						var cloud = $(this);

						if (!cloud.hasClass('sky-background')) {
							if (cloud.hasClass('kr-clouds')) {
								cloud.find('*').each(function() {
									if (!$(this).hasClass('kr-carousel-wrapper') && !$(this).hasClass('kr-carousel') && !$(this).hasClass('kr-carousel-img') && !$(this).hasClass('kr-carousel-left-arrow') && !$(this).hasClass('kr-carousel-right-arrow')) {
										cloudInstance.redrawCloud($(this));
									}
								});
							} else {
								cloudInstance.redrawCloud(cloud);
							}
						}
						
					});
				}

				if (cloudInstance.options.navType == 'thumb' && cloudInstance.options.thumb.visibility == 'show') {
					cloud_container.css({
						marginBottom: parseInt(cloud_container.data('margin-bottom')) + cloud_others.height() - parseInt(cloud_others.css('margin-top'))
					});
				}

				cloud_container.find('.sky-background').css({
					width : widthWrapper,
					height : heightWrapper
				});

				var background = sky.find('.sky-background img');
				var bg_width = parseFloat(cloud_wrapper.css('width'));
				var bg_height = background.data('background_height') * parseFloat(cloud_wrapper.css('width')) / background.data('background_width');

				if (background.data('size') == 'contain') {
					if (background.data('background_width') / background.data('background_height') < parseFloat(cloud_wrapper.css('width')) / parseFloat(cloud_wrapper.css('height'))) {
						bg_width = background.data('background_width') * parseFloat(cloud_wrapper.css('height')) / background.data('background_height');
						bg_height = parseFloat(cloud_wrapper.css('height'));
					}
				} else {
					if (background.data('background_width') / background.data('background_height') > parseFloat(cloud_wrapper.css('width')) / parseFloat(cloud_wrapper.css('height'))) {
						bg_width = background.data('background_width') * parseFloat(cloud_wrapper.css('height')) / background.data('background_height');
						bg_height = parseFloat(cloud_wrapper.css('height'));
					}
				}

				if (typeof sky.data('ken-positionfrom') != 'undefined') {
					var scale = (parseFloat(sky.data('ken-scalefrom')) > 0 ? parseFloat(sky.data('ken-scalefrom')) : 1);
					var scaleTo = (parseFloat(sky.data('ken-scaleto')) > 0 ? parseFloat(sky.data('ken-scaleto')) : 1);
					sky.data('width_to_rate', bg_width * scaleTo / parseFloat(cloud_wrapper.css('width')));
					sky.data('height_to_rate', bg_height * scaleTo / parseFloat(cloud_wrapper.css('width')));

					bg_width *= scale;
					bg_height *= scale;

					var css = {};

					css['width'] = bg_width;
					css['height'] = bg_height;

					css['scale'] = 1;
					css['x'] = 0;
					css['y'] = 0;

					if ((sky.data('ken-positionfrom') + '').indexOf('top') >= 0) {
						css['top'] = 0;
					} else if((sky.data('ken-positionfrom') + '').indexOf('bottom') >= 0) {
						css['top'] = parseFloat(cloud_wrapper.css('height')) - bg_height;
					} else if(parseInt(sky.data('ken-positionfrom').split(' ')[0]) >= 0) {
						css['top'] = (parseFloat(cloud_wrapper.css('height')) - bg_height) * parseInt(sky.data('ken-positionfrom').split(' ')[0]) / 100;
					} else if(parseInt(sky.data('ken-positionfrom').split(',')[0]) >= 0) {
						css['top'] = (parseFloat(cloud_wrapper.css('height')) - bg_height) * parseInt(sky.data('ken-positionfrom').split(',')[0]) / 100;
					} else {
						css['top'] = (parseFloat(cloud_wrapper.css('height')) - bg_height) / 2;
					}

					if ((sky.data('ken-positionfrom') + '').indexOf('left') >= 0) {
						css['left'] = 0;
					} else if ((sky.data('ken-positionfrom') + '').indexOf('right') >= 0) {
						css['left'] = parseFloat(cloud_wrapper.css('width')) - bg_width;
					} else if(parseInt(sky.data('ken-positionfrom').split(' ')[1]) >= 0) {
						css['left'] = (parseFloat(cloud_wrapper.css('width')) - bg_width) * parseInt(sky.data('ken-positionfrom').split(' ')[1]) / 100;
					} else if(parseInt(sky.data('ken-positionfrom').split(',')[1]) >= 0) {
						css['left'] = (parseFloat(cloud_wrapper.css('width')) - bg_width) * parseInt(sky.data('ken-positionfrom').split(',')[1]) / 100;
					} else {
						css['left'] = (parseFloat(cloud_wrapper.css('width')) - bg_width) / 2;
					}
					css['rotation'] = 0;
					sky.data('bg_width', bg_width);
					sky.data('bg_height', bg_height);

					TweenMax.set(background, {
							css: css
						}
					);
				} else {
					background.css({
						width: bg_width,
						height: bg_height,
						left: - (bg_width - parseFloat(cloud_wrapper.css('width'))) / 2,
						top: - (bg_height - parseFloat(cloud_wrapper.css('height'))) / 2,
						position: 'absolute'
					});
				}
			}

			cloudInstance.options.onRedraw();
		};
		

		cloudInstance.redrawCloud = function(cloud) {

			var left = cloud.data('left') ? cloud.data('left') : '0';
			var top = cloud.data('top') ? cloud.data('top') : '0';
			
			var width = cloud.data('width') ? cloud.data('width') : '';
			var height = cloud.data('height') ? cloud.data('height') : '';
			
			var font_size = parseInt(cloud.data('font_size'));
			var line_height = parseInt(cloud.data('line_height'));

			var margin_top = cloud.data('margin_top') ? parseInt(cloud.data('margin_top')) : 0;
			var margin_right = cloud.data('margin_right') ? parseInt(cloud.data('margin_right')) : 0;
			var margin_bottom = cloud.data('margin_bottom') ? parseInt(cloud.data('margin_bottom')) : 0;
			var margin_left = cloud.data('margin_left') ? parseInt(cloud.data('margin_left')) : 0;

			var padding_top = cloud.data('padding_top') ? parseInt(cloud.data('padding_top')) : 0;					
			var padding_right = cloud.data('padding_right') ? parseInt(cloud.data('padding_right')) : 0;					
			var padding_bottom = cloud.data('padding_bottom') ? parseInt(cloud.data('padding_bottom')) : 0;
			var padding_left = cloud.data('padding_left') ? parseInt(cloud.data('padding_left')) : 0;

			var border_top = cloud.data('border_top') ? parseInt(cloud.data('border_top')) : 0;					
			var border_right = cloud.data('border_right') ? parseInt(cloud.data('border_right')) : 0;					
			var border_bottom = cloud.data('border_bottom') ? parseInt(cloud.data('border_bottom')) : 0;
			var border_left = cloud.data('border_left') ? parseInt(cloud.data('border_left')) : 0;

			// Adjust Left And Top
			if(!cloud.hasClass('kr-carousel-container')) {
				if (left.indexOf('%') != -1) {
					cloud.css({
						left : left
					});
				} else {
					if (cloudInstance.options.responsive) {
						cloud.css({
							left : parseInt(left) * cloudInstance.options.responsiveRate
						});
					} else {
						cloud.css({
							left : parseInt(left) + (parseFloat(cloud_wrapper.css('width')) - parseInt(cloudInstance.options.width)) / 2
						});
					}
				}
				if (top.indexOf('%') != -1) {
					cloud.css({
						top : top
					});
				} else {
					var paddingTop = (parseInt(cloudInstance.options.fullSizeHeight) > 0) ? (cloud_container.height() - parseInt(cloudInstance.options.fullSizeHeight)) / 2 : 0;
					cloud.css({
						top : paddingTop + parseInt(top) * cloudInstance.options.responsiveRate
					});
				}

				if ($.isNumeric(width)) {
					cloud.css({
						width : parseInt(width) * cloudInstance.options.responsiveRate
					});
				} else {
					cloud.css({
						width : width
					});
				}

				if ($.isNumeric(height)) {
					cloud.css({
						height : parseInt(height) * cloudInstance.options.responsiveRate
					});
				} else {
					cloud.css({
						height : height
					});
				}
			} else {
				var carousel_option = cloud.closest('.kr-sky').data('carousel');
				var firstCarouselItem = cloud.find('.kr-carousel:eq(0)');
				var carousel_width = firstCarouselItem.find('img').data('width');
				var	carousel_height = firstCarouselItem.find('img').data('height');

				border_top = firstCarouselItem.data('border_top') ? parseInt(firstCarouselItem.data('border_top')) : 0;					
				border_right = firstCarouselItem.data('border_right') ? parseInt(firstCarouselItem.data('border_right')) : 0;					
				border_bottom = firstCarouselItem.data('border_bottom') ? parseInt(firstCarouselItem.data('border_bottom')) : 0;
				border_left = firstCarouselItem.data('border_left') ? parseInt(firstCarouselItem.data('border_left')) : 0;

				if (parseInt(firstCarouselItem.data('width')) && parseInt(firstCarouselItem.data('height')))  {
					carousel_width = parseInt(cloud.closest('.kr-sky').data('carousel').itemSize.width);
					carousel_height = parseInt(firstCarouselItem.data('height')) * parseInt(cloud.closest('.kr-sky').data('carousel').itemSize.width) / parseInt(firstCarouselItem.data('width'));
				} else if (parseInt(firstCarouselItem.data('width'))) {
					carousel_width = parseInt(firstCarouselItem.data('width'));
					carousel_height = firstCarouselItem.find('img').data('height') * carousel_width / firstCarouselItem.find('img').data('width');
				} else if (parseInt(firstCarouselItem.data('height'))) {
					carousel_height = parseInt(firstCarouselItem.data('height'));
					carousel_width = firstCarouselItem.find('img').data('width') * carousel_height / firstCarouselItem.find('img').data('height');
				}

				if (cloud_container.find('.kr-carousel-container').data('rect_circ') == 'circ') {
					carousel_height = carousel_width;
				}

				cloud.find('.kr-carousel img').each(function() {
					var img = $(this);
					if (img.data('width') / img.data('height') >= carousel_width / carousel_height) {
						var img_width = parseInt(img.data('width')) * carousel_height / img.data('height') * cloudInstance.options.responsiveRate;
						var img_height = carousel_height * cloudInstance.options.responsiveRate;
						img.css({
							width: img_width,
							height: img_height,
							marginTop: 0,
							marginLeft: - (img_width - carousel_width * cloudInstance.options.responsiveRate) / 2
						});					
					} else {
						var img_width = carousel_width * cloudInstance.options.responsiveRate;
						var img_height = parseInt(img.data('height')) * carousel_width / img.data('width') * cloudInstance.options.responsiveRate;
						img.css({
							width: img_width,
							height: img_height,
							marginLeft: 0,
							marginTop: - (img_height - carousel_height * cloudInstance.options.responsiveRate) / 2
						});
					}
				});

				carousel_width = carousel_width * cloudInstance.options.responsiveRate;
				carousel_height = carousel_height * cloudInstance.options.responsiveRate;
				cloud.find('.kr-carousel').css({
					top: 0,
					width: carousel_width,
					height: carousel_height,
					'border-top-width'		: border_top * cloudInstance.options.responsiveRate + 'px',
					'border-right-width'	: border_right * cloudInstance.options.responsiveRate + 'px',
					'border-bottom-width'	: border_bottom * cloudInstance.options.responsiveRate + 'px',
					'border-left-width'		: border_left * cloudInstance.options.responsiveRate + 'px'	
				});

				var carousel_count = cloud.find('.kr-carousel').length;
				var level_count = Math.floor(carousel_count / 2);
				var current_carousel = cloud.closest('.kr-sky').data('current_carousel');
				var additional = carousel_count % 2;

				for (var i = 0; i < carousel_count; i++) {
					var side;
					var carousel_level;
					var carousel = cloud.find('.kr-carousel').eq(i);

					// Detect carousel level
					if (Math.abs(i - current_carousel) > level_count) {
						carousel_level = level_count - (Math.abs(i - current_carousel) % level_count == 0 ? level_count : Math.abs(i - current_carousel) % level_count) + additional;
						if (i - current_carousel > 0) {
							side = 'left';
						} else {
							side = 'right';
						}
					} else {
						carousel_level = Math.abs(i - current_carousel);
						if (i - current_carousel > 0) {
							side = 'right';
						} else {
							side = 'left';
						}
					}

					// Set z-index of carousel
					carousel.css({
						'z-index': level_count - carousel_level
					});

					// Set common style for carousel
					if (carousel_level == 0) {
						TweenMax.set(carousel.addClass('kr-current-carousel'), {
							css: {
								top 					: 0,
								left 					: (parseFloat(cloud_wrapper.css('width')) - carousel_width) / 2,
								scale 					: is_lowerIE8() ? 0.999 : 1,
								opacity 				: 1,
								rotationX 				: 0,
								rotationY 				: 0,
								rotationZ 				: 0,
								transformPerspective 	: carousel_option.perspective == 'auto' ? carousel_width : parseInt(carousel_option.perspective)
							}
						});
						/*
						carousel.addClass('kr-current-carousel').css({
							top: 0,
							left: (parseFloat(cloud_wrapper.css('width')) - carousel_width) / 2
						});
						*/
					} else {
						var level_option = carousel_option.level[carousel_level - 1];
						var level_width = carousel_width * level_option.scale;

						if (side == 'right') {
							TweenMax.set(carousel, {
								css: {
									scale 					: level_option.scale,
									opacity 				: level_option.opacity,
									rotationX 				: level_option.rotationX,
									rotationY 				: - level_option.rotationY,
									rotationZ 				: - level_option.rotationZ,
									transformPerspective 	: carousel_option.perspective == 'auto' ? level_width : parseInt(carousel_option.perspective)
								}
							});
						} else {
							TweenMax.set(carousel, {
								css: {
									scale 					: level_option.scale,
									opacity 				: level_option.opacity,
									rotationX 				: level_option.rotationX,
									rotationY 				: level_option.rotationY,
									rotationZ 				: level_option.rotationZ,
									transformPerspective 	: carousel_option.perspective == 'auto' ? level_width : parseInt(carousel_option.perspective)
								}
							});
						}

						// Calculate left position of carousel
						if ((carousel_option.overlay + '').indexOf('%') > 0) {
						} else {
							carousel_option.overlay = parseInt(carousel_option.overlay) * cloudInstance.options.responsiveRate / carousel_width * 100 + '%';
						}

						if (side == 'left') {
							var left = parseFloat(cloud_wrapper.css('width')) / 2 - carousel_width / 2;
							for (var j = 1; j <= carousel_level; j++) {
								left -= -(j == 1 ? 0 : carousel_width * (1 - carousel_option.level[j - 2].scale) / 2) + carousel_width * carousel_option.level[j - 1].scale * (100 - parseInt(carousel_option.overlay)) / 100 + carousel_width * (1 - carousel_option.level[j - 1].scale) / 2;
							}
							
							TweenMax.set(carousel, {
								css: {
							       	left: left
							    }
							});
						} else {
							var left = parseFloat(cloud_wrapper.css('width')) / 2 - carousel_width / 2;
							for (var j = 1; j <= carousel_level; j++) {
								left += (j == 1 ? carousel_width : carousel_width * carousel_option.level[j - 2].scale + carousel_width * (1 - carousel_option.level[j - 2].scale) / 2) - carousel_width * carousel_option.level[j - 1].scale * parseInt(carousel_option.overlay) / 100 - carousel_width * (1 - carousel_option.level[j - 1].scale) / 2;
							}
							TweenMax.set(carousel, {
								css: {
							       	left: left
							    }
							});
						}
					}
					if (carousel.find('img').css('-webkit-box-reflect') && carousel.find('img').css('-webkit-box-reflect').length != 0) {						
						carousel.css('-webkit-box-reflect', carousel.find('img').css('-webkit-box-reflect'));
						carousel.find('img').css('-webkit-box-reflect', 'none');
					}
				}

				// Set carousel container style
				var top;
				if (carousel_option.position == 'top') {
					top = 0;
				} else if (carousel_option.position == 'bottom') {
					top = parseFloat(cloud_wrapper.css('height')) - carousel_height;
				} else if (carousel_option.position == 'center') {
					top = (parseFloat(cloud_wrapper.css('height')) - carousel_height) / 2;
				} else if ((carousel_option.position + '').indexOf('%') > 0) {
					top = parseFloat(cloud_wrapper.css('height')) * parseInt(carousel_option.position) / 100;
				} else if (parseInt(carousel_option.position) >= 0) {
					top = parseInt(carousel_option.position) * cloudInstance.options.responsiveRate;
				} else {					
					top = (parseFloat(cloud_wrapper.css('height')) - carousel_height) / 2;	// Center
				}

				cloud.css({
					width: parseFloat(cloud_wrapper.css('width')),
					height: carousel_height,
					top: top,
					left: parseFloat(cloud.data('left')) * cloudInstance.options.responsiveRate
				});

				cloud.find('.kr-carousel-wrapper').css({
					width: parseFloat(cloud_wrapper.css('width')),
					height: carousel_height
				});

				if (carousel_option.arrow.visibility != 'hide') {
					// Resize carousel arrow for responsive
					var arrow_rate = (carousel_option.arrow.responsiveLevel - 1 + cloudInstance.options.responsiveRate) / carousel_option.arrow.responsiveLevel
					cloud.find('.kr-carousel-left-arrow').css({
						width: cloud.find('.kr-carousel-left-arrow img').data('width') * arrow_rate,
						height: cloud.find('.kr-carousel-left-arrow img').data('height') * arrow_rate
					});
					cloud.find('.kr-carousel-right-arrow').css({
						width: cloud.find('.kr-carousel-right-arrow img').data('width') * arrow_rate,
						height: cloud.find('.kr-carousel-right-arrow img').data('height') * arrow_rate
					});

					// Caculate carousel arrow position
					if (carousel_option.arrow.position == 'auto') {
						cloud.find('.kr-carousel-left-arrow').css({
							left: (parseFloat(cloud_wrapper.css('width')) - carousel_width) / 2 - cloud.find('.kr-carousel-left-arrow').width(),
							top: (cloud.height() - cloud.find('.kr-carousel-left-arrow').width()) / 2
						});
						cloud.find('.kr-carousel-right-arrow').css({
							left: (parseFloat(cloud_wrapper.css('width')) + carousel_width) / 2 + parseInt(firstCarouselItem.css('border-right-width')) * 2,
							top: (cloud.height() - cloud.find('.kr-carousel-right-arrow').width()) / 2
						});
					} else if ((carousel_option.arrow.position + '').indexOf('%') > 0) {
						cloud.find('.kr-carousel-left-arrow').css({
							left: parseFloat(cloud_wrapper.css('width')) * parseInt(carousel_option.arrow.position) / 100 - cloud.find('.kr-carousel-left-arrow').width() / 2
						});
						cloud.find('.kr-carousel-right-arrow').css({
							left: parseFloat(cloud_wrapper.css('width')) - parseFloat(cloud_wrapper.css('width')) * parseInt(carousel_option.arrow.position) / 100 - cloud.find('.kr-carousel-right-arrow').width() / 2
						});
					} else if (parseInt(carousel_option.arrow.position) >= 0) {
						cloud.find('.kr-carousel-left-arrow').css({
							left: parseInt(carousel_option.arrow.position) * cloudInstance.options.responsiveRate - cloud.find('.kr-carousel-left-arrow').width() / 2
						});
						cloud.find('.kr-carousel-right-arrow').css({
							left: parseFloat(cloud_wrapper.css('width')) - parseInt(carousel_option.arrow.position) * cloudInstance.options.responsiveRate - cloud.find('.kr-carousel-right-arrow').width() / 2
						});
					}else {		// auto
						cloud.find('.kr-carousel-left-arrow').css({
							left: (parseFloat(cloud_wrapper.css('width')) - carousel_width) / 2 - cloud.find('.kr-carousel-left-arrow').width()
						});
						cloud.find('.kr-carousel-right-arrow').css({
							left: (parseFloat(cloud_wrapper.css('width')) + carousel_width) / 2
						});
					}

					cloud.find('.kr-carousel-left-arrow').css({
						top: (cloud.height() - cloud.find('.kr-carousel-left-arrow').width()) / 2
					});
					cloud.find('.kr-carousel-right-arrow').css({
						top: (cloud.height() - cloud.find('.kr-carousel-right-arrow').width()) / 2
					});
				}

			}
			cloud.css({
				'font-size'				: font_size * cloudInstance.options.responsiveRate + 'px',
				'line-height'			: line_height * cloudInstance.options.responsiveRate + 'px',
				'margin-top'			: margin_top * cloudInstance.options.responsiveRate + 'px',
				'margin-right'			: margin_right * cloudInstance.options.responsiveRate + 'px',
				'margin-left'			: margin_left * cloudInstance.options.responsiveRate + 'px',
				'margin-bottom'			: margin_bottom * cloudInstance.options.responsiveRate + 'px',
				'padding-top'			: padding_top * cloudInstance.options.responsiveRate + 'px',
				'padding-right'			: padding_right * cloudInstance.options.responsiveRate + 'px',
				'padding-bottom'		: padding_bottom * cloudInstance.options.responsiveRate + 'px',
				'padding-left'			: padding_left * cloudInstance.options.responsiveRate + 'px',
				'border-top-width'		: border_top * cloudInstance.options.responsiveRate + 'px',
				'border-right-width'	: border_right * cloudInstance.options.responsiveRate + 'px',							
				'border-bottom-width'	: border_bottom * cloudInstance.options.responsiveRate + 'px',
				'border-left-width'		: border_left * cloudInstance.options.responsiveRate + 'px'							
			});
			
			cloud.find(' > iframe, > video, > audio').each(function() {
				var media = $(this);
				var media_width = cloud.data('width') ? parseInt(cloud.data('width')) * cloudInstance.options.responsiveRate: 0;
				var media_height = cloud.data('height') ? parseInt(cloud.data('height')) * cloudInstance.options.responsiveRate: 0;

				cloud.css({
					width : media_width,
					height : media_height
				});

				media.attr('width', media_width);
				media.attr('height', media_height);
			});
		};

		// Cloud Slider Resume
		cloudInstance.resume = function() {
			
			if (!cloudInstance.options.isBusy && cloudInstance.options.autoSlide) {

				if (cloudInstance.options.currentSky.find('.kr-carousel-container').length > 0 && cloudInstance.options.autoSlideCarousel != 'slide' && (typeof cloudInstance.options.carouselRepeated == 'undefined' || cloudInstance.options.carouselRepeated == null || !cloudInstance.options.carouselRepeated)) {	// Carousel Auto Flow

					var carousel_option = cloudInstance.options.currentSky.data('carousel');
					// Caculate Remaining Sky Duration Using Progress Bar
					var openedSkyDurRemaining = parseInt(carousel_option.delay) * (parseFloat(cloud_wrapper.css('width')) - cloudInstance.options.progressBar.width()) / parseFloat(cloud_wrapper.css('width'));
					if (carousel_option.delay == 0) {
						if (!cloudInstance.options.currentSky.data('carousel-started')) {
							openedSkyDurRemaining = 1;
							cloudInstance.options.currentSky.data('carousel-started', true);
						} else {
							openedSkyDurRemaining = 0;
						}
					}

					TweenMax.to(cloudInstance.options.progressBar,

						openedSkyDurRemaining / 1000,
						{
							css: {
								width : parseFloat(cloud_wrapper.css('width'))
							},
							ease: Linear.easeNone,
							onComplete: function() {
								if (cloud_container.find('.cloud-wrapper').length > 0) {
									cloudInstance.options.progressBar.css('width', 0);
									if (cloudInstance.options.autoSlideCarousel == 'combine') {
										 cloudInstance.options.carouselShowed++;
										 if (cloudInstance.options.carouselShowed == cloudInstance.options.currentSky.find('.kr-carousel').length - 1) {
										 	cloudInstance.options.carouselRepeated = true;
										 	cloudInstance.options.carouselShowed = 0;
										 }
									}
									cloudInstance.flowCarouselTo(carousel_option.direction);
								}
							}
						}
					);
				} else if (cloudInstance.options.numberOfSlides > 1) {		// Slider Auto Flow
					// Caculate Remaining Sky Duration Using Progress Bar
					var openedSkyDurRemaining = parseInt(cloud_container.find('.sky-opened').data('duration')) * (parseFloat(cloud_wrapper.css('width')) - cloudInstance.options.progressBar.width()) / parseFloat(cloud_wrapper.css('width'));

					TweenMax.to(cloudInstance.options.progressBar,

						openedSkyDurRemaining / 1000,
						{
							css: {
								width : parseFloat(cloud_wrapper.css('width'))
							},
							ease: Linear.easeNone,
							onComplete: function() {
								if (cloud_container.find('.cloud-wrapper').length > 0) {
									cloudInstance.options.progressBar.css('width', 0);
									cloudInstance.flowTo('right');
									if (cloudInstance.options.autoSlideCarousel == 'combine') {
									 	cloudInstance.options.carouselRepeated = false;
									 	cloudInstance.options.carouselShowed = 0;
									}
								}
							}
						}
					);
				}
			}
		};
		
		// Pause Cloud Slider
		cloudInstance.pause = function() {
			
			if(TweenMax.isTweening(cloudInstance.options.progressBar)) {
				TweenMax.killTweensOf(cloudInstance.options.progressBar);
			}

			cloudInstance.options.onPause();
		};

		// Pause Cloud Slider
		cloudInstance.kill = function() {
			
			TweenMax.killAll();
			for(var i = 0; i < cloudInstance.options.timeouts.length; i++) {
		        clearTimeout(cloudInstance.options.timeouts);
		    }
			cloudInstance.options.timeouts.length = 0;
		};

		// Slide Flow
		cloudInstance.flowTo = function(target) {
			
			var imgCount = 0;

			cloudInstance.options.isBusy = true;
			//cloudInstance.resume();

			if (typeof target != 'number') {

				if (cloudInstance.options.shuffleMode) {
					if (!cloudInstance.options.slideTransitionNeeded && param_options.startSlideNo >= 0) {
						target = cloudInstance.options.startSlideNo;
					} else {
						var skyIndexArray = cloudInstance.options.skyIndexArray.slice(0);
						skyIndexArray.splice(cloudInstance.options.currentSkyNo, 1);
						target = skyIndexArray[Math.floor(Math.random() * skyIndexArray.length)];
					}
				} else {
					if (target == 'left') {
						var leftSkyNo = cloudInstance.options.currentSkyNo - 1;
						
						if (cloudInstance.options.currentSkyNo == 0) {

							leftSkyNo = cloudInstance.options.numberOfSlides - 1;
						}
						target = leftSkyNo;
					} else {
						var rightSkyNo = cloudInstance.options.currentSkyNo + 1;

						if (cloudInstance.options.currentSkyNo == cloudInstance.options.numberOfSlides - 1) {

							rightSkyNo = 0;
						}
						target = rightSkyNo;
					}
				}
			}
			
			cloud_container.css('visibility', 'visible');

			// Stop ProgressBar
			TweenMax.killTweensOf(cloudInstance.options.progressBar);

			cloudInstance.options.progressBar.css('width', 0);

			cloudInstance.options.upcomingSkyNo = target;

			cloudInstance.options.upcomingSky = cloud_container.find('.kr-sky').eq(cloudInstance.options.upcomingSkyNo);

			// Count All Images In Upcoming Sky
			var imgCount = 0;

			if (!cloudInstance.options.upcomingSky.data('loaded')) {
				cloudInstance.options.upcomingSky.find('*').andSelf().each(function() {

					if (($(this).is('img')) || ($(this).css('background-image') && ($(this).css('background-image') + '').indexOf('url') != -1)) {
						imgCount++;
					}
				});
			}

			// Load All Images In Upcoming Sky	
			if (imgCount > 0) {
				
				cloudInstance.options.isBusy = true;
				cloudInstance.options.loader.show();

				cloudInstance.options.upcomingSky.find('*').andSelf().each(function() {
					
					var imgSrc = null;
					var imgObj = $(this);

					if (!$(this).data('loaded')) {
						if ($(this).is('img')) {

							if (cloudInstance.options.lazyImageLoad) {
								$(this).attr('src', $(this).data('src'));
							}
							imgSrc = $(this).attr('src');

						} else if ($(this).css('background-image') && ($(this).css('background-image') + '').indexOf('url') != -1) {
							imgSrc = $(this).css('background-image').replace(/^url\([\"\']?/, '').replace(/[\"\']?\)$/, '');
						}
					}
					
					if (imgSrc != null) {

						var tmpImg = new Image();

						tmpImg.onload = function() {

							if (!imgObj.data('width') || imgObj.data('width') <= 0 || imgObj.data('width') == 'auto') {
								if (imgObj.data('height') > 0) {
									imgObj.data('width', imgObj.data('height') * tmpImg.width / tmpImg.height);
								}else {
									imgObj.data('width', tmpImg.width);
								}
							}
							if (!imgObj.data('height') || imgObj.data('height') <= 0 || imgObj.data('height') == 'auto') {
								if (imgObj.data('width') > 0) {
									imgObj.data('height', imgObj.data('width') * tmpImg.height / tmpImg.width);
								}else {
									imgObj.data('height', tmpImg.height);
								}
							}

							if (imgObj.parent().hasClass('sky-background')) {
								imgObj.data('background_width', tmpImg.width);
								imgObj.data('background_height', tmpImg.height);
							}

							imgCount--;

							if (imgCount == 0) {
								cloudInstance.options.upcomingSky.data('loaded', true);

								if (cloudInstance.options.upcomingSky.find())

								cloudInstance.options.isBusy = false;
								cloudInstance.options.loader.hide();
								if (!cloudInstance.options.slideTransitionNeeded) {
									cloudInstance.redrawAll(cloudInstance.options.upcomingSky);
									cloudInstance.redrawSkin();
								}
								cloudInstance.fly();
							}
						}
						tmpImg.src = imgSrc;
					}
				});
			} else {
				if (!cloudInstance.options.slideTransitionNeeded) {
					cloudInstance.redrawAll(cloudInstance.options.upcomingSky);
					cloudInstance.redrawSkin();
				}
				cloudInstance.fly();
			}
		};
		
		cloudInstance.flowCarouselTo = function(target) {

			if (!cloudInstance.options.currentSky.data('isBusy')) {
				cloudInstance.options.currentSky.data('isBusy', true);
				var carouselNo = target;
				var minLeft = null;
				var maxLeft = null;
				if (typeof target != 'number') {
					
					if (target == 'left') {
						carouselNo = cloudInstance.options.currentSky.find('.kr-current-carousel').index() - 1;
						if (carouselNo < 0) {
							carouselNo = cloudInstance.options.currentSky.find('.kr-carousel').length - 1;
						}
						cloud_container.find('.kr-carousel').each(function() {
							if (maxLeft == null) {
								maxLeft = parseFloat($(this).css('left'));
							} else if (maxLeft < parseFloat($(this).css('left'))) {
								maxLeft = parseFloat($(this).css('left'));
							}
						});
					} else {
						carouselNo = cloudInstance.options.currentSky.find('.kr-current-carousel').index() + 1;
						if (carouselNo > cloudInstance.options.currentSky.find('.kr-carousel').length - 1) {
							carouselNo = 0;
						}
						cloud_container.find('.kr-carousel').each(function() {
							if (minLeft == null) {
								minLeft = parseFloat($(this).css('left'));
							} else if (minLeft > parseFloat($(this).css('left'))) {
								minLeft = parseFloat($(this).css('left'));
							}
						});
					}
				}

				cloudInstance.options.currentSky.data('current_carousel', carouselNo);

				var carousel_option = cloudInstance.options.currentSky.data('carousel');
				var carousel_width = cloudInstance.options.currentSky.find('.kr-current-carousel').width();
				var carousel_height = cloudInstance.options.currentSky.find('.kr-current-carousel').height();

				var carousel_count = cloudInstance.options.currentSky.find('.kr-carousel').length;
				var level_count = Math.floor(carousel_count / 2);
				var current_carousel = carouselNo;
				var additional = carousel_count % 2;


				cloudInstance.options.currentSky.find('.kr-current-carousel').removeClass('kr-current-carousel');
				cloudInstance.options.currentSky.find('.kr-carousel').eq(current_carousel).addClass('kr-current-carousel');

				cloudInstance.cloudsOut(true);

				for (var i = 0; i < carousel_count; i++) {
					var side;
					var carousel_level;
					var carousel = cloudInstance.options.currentSky.find('.kr-carousel').eq(i);

					// Detect carousel level
					if (Math.abs(i - current_carousel) > level_count) {
						carousel_level = level_count - (Math.abs(i - current_carousel) % level_count == 0 ? level_count : Math.abs(i - current_carousel) % level_count) + additional;
						if (i - current_carousel > 0) {
							side = 'left';
						} else {
							side = 'right';
						}
					} else {
						carousel_level = Math.abs(i - current_carousel);
						if (i - current_carousel > 0) {
							side = 'right';
						} else {
							side = 'left';
						}
					}

					var z_index = (level_count - carousel_level) * 2;
					if (side == 'left' && target == 'right') {
						z_index++;
					}
					if (side == 'right' && target == 'left') {
						z_index++;
					}

					// Set z-index of carousel
					carousel.css({
						'z-index': z_index
					});

					var toVars = {};
					cloudInstance.options.carouselTimeline = new TimelineLite();

					// Set common style for carousel
					if (carousel_level == 0) {

						toVars = {
								top 					: 0,
								left 					: parseInt((parseFloat(cloud_wrapper.css('width')) - carousel_width) / 2),
								scale 					: is_lowerIE8() ? 0.999 : 1,		// IE7, 8 needs filter style
								opacity 				: 1,
								rotationX 				: 0,
								rotationY 				: 0,
								rotationZ 				: 0,
								ease 					: carousel_option.easing
						};

						if (i == carousel_count - 1) {
							toVars['onComplete'] = function() {
								cloud_container.find('.kr-carousel').show();
								cloudInstance.options.currentSky.data('isBusy', false);
								cloudInstance.options.carouselTimeline = null;
								if (!cloudInstance.options.paused) {
									cloudInstance.resume();
								}
							};
						}

						cloudInstance.options.carouselTimeline.to(carousel, 
							carousel_option.duration / 1000,
							toVars
						);
					} else {
						var level_option = carousel_option.level[carousel_level - 1];
						var level_width = carousel_width * level_option.scale;

						if (side == 'right') {
							toVars = {
									scale 					: level_option.scale,
									opacity 				: level_option.opacity,
									rotationX 				: level_option.rotationX,
									rotationY 				: - level_option.rotationY,
									rotationZ 				: - level_option.rotationZ,
									transformPerspective 	: carousel_option.perspective == 'auto' ? level_width : parseInt(carousel_option.perspective)
							};
						} else {
							toVars = {
									scale 					: level_option.scale,
									opacity 				: level_option.opacity,
									rotationX 				: level_option.rotationX,
									rotationY 				: level_option.rotationY,
									rotationZ 				: level_option.rotationZ,
									transformPerspective 	: carousel_option.perspective == 'auto' ? level_width : parseInt(carousel_option.perspective)
							};
						}

						// Calculate left position of carousel
						if ((carousel_option.overlay + '').indexOf('%') > 0) {
						} else {
							carousel_option.overlay = parseInt(carousel_option.overlay) / carousel_width * 100 + '%';
						}

						var left = parseFloat(cloud_wrapper.css('width')) / 2 - carousel_width / 2;
						if (side == 'left') {
							for (var j = 1; j <= carousel_level; j++) {
								left -= -(j == 1 ? 0 : carousel_width * (1 - carousel_option.level[j - 2].scale) / 2) + carousel_width * carousel_option.level[j - 1].scale * (100 - parseInt(carousel_option.overlay)) / 100 + carousel_width * (1 - carousel_option.level[j - 1].scale) / 2;
							}
						} else {
							for (var j = 1; j <= carousel_level; j++) {
								left += (j == 1 ? carousel_width : carousel_width * carousel_option.level[j - 2].scale + carousel_width * (1 - carousel_option.level[j - 2].scale) / 2) - carousel_width * carousel_option.level[j - 1].scale * parseInt(carousel_option.overlay) / 100 - carousel_width * (1 - carousel_option.level[j - 1].scale) / 2;
							}
						}

						if (target == 'left' && parseFloat(carousel.css('left')) + (carousel_width - level_width) / 2 >= parseFloat(cloud_wrapper.css('width')) || target == 'right' && parseFloat(carousel.css('left')) + (carousel_width - level_width) / 2 + level_width <= 0) {
							carousel.hide();
						} else {
							carousel.show();
						}

						toVars['left'] = parseInt(left);
						toVars['ease'] = carousel_option.easing;
						if (i == carousel_count - 1) {
							toVars['onComplete'] = function() {
								cloud_container.find('.kr-carousel').show();
								cloudInstance.options.currentSky.data('isBusy', false);
								cloudInstance.options.carouselTimeline = null;
								if (!cloudInstance.options.paused) {
									cloudInstance.resume();
								}
							};
						} else {
							toVars['onComplete'] = function() {
								cloudInstance.options.currentSky.data('isBusy', false);
								cloudInstance.options.carouselTimeline = null;
								cloud_container.find('.kr-carousel').show();
							};
						}
						

						cloudInstance.options.carouselTimeline.to(carousel, 
							carousel_option.duration / 1000,
							toVars
						);
					}
				}
				cloudInstance.options.onCarouselTo();
			}
		};

		// Switch Active Navigation When Sliding
		cloudInstance.switchActiveNav = function() {
			if (typeof cloudInstance.options.currentSkyNo != 'undefined' && typeof cloudInstance.options.upcomingSkyNo != 'undefined') {
				if (cloudInstance.options.navType == 'bullet') {
					cloud_container.find('.kr-bullet-container .kr-bullet:eq('+cloudInstance.options.currentSkyNo+')').removeClass('kr-activated').css({
						opacity: cloudInstance.options.bullet.itemOpacity,
						'background-image': 'url(' + cloudInstance.options.bullet.imgItem + ')'
					});
					cloud_container.find('.kr-bullet-container .kr-bullet:eq('+cloudInstance.options.upcomingSkyNo+')').addClass('kr-activated').css({
						opacity: cloudInstance.options.bullet.activatedOpacity,
						'background-image': 'url(' + cloudInstance.options.bullet.imgItemActivated + ')'
					});
				} else if (cloudInstance.options.navType == 'thumb') {

					var active_thumb = cloud_container.find('.kr-thumb-container .kr-thumb:eq(' + cloudInstance.options.upcomingSkyNo + ')');

					cloud_container.find('.kr-thumb-container .kr-thumb:eq(' + cloudInstance.options.currentSkyNo + ')').css({
						opacity: cloudInstance.options.thumb.itemOpacity,
						borderColor: cloudInstance.options.thumb.itemBorderColor
					});

					active_thumb.css({
						opacity: cloudInstance.options.thumb.activatedOpacity,
						borderColor: cloudInstance.options.thumb.activatedBorderColor
					});

					// Scrolling Thumbnails
					var thumb_inner = cloud_container.find('.kr-thumb-inner');
					var left_position = cloud_container.find('.kr-thumb-wrapper').position().left;
					var right_position = left_position + cloud_container.find('.kr-thumb-wrapper').width();
					var active_thumb_left = active_thumb.position().left;
					var thumb_width = active_thumb.width() + parseInt(active_thumb.css('margin-left')) + parseInt(active_thumb.css('margin-right')) + parseInt(active_thumb.css('border-left-width')) + parseInt(active_thumb.css('border-right-width'));

					var _x = 0;
					if (thumb_inner.width() > cloud_container.find('.kr-thumb-container').width()) {
						if (active_thumb_left < left_position + thumb_width / 2) {
							_x = Math.min(0, - (thumb_width * (cloudInstance.options.upcomingSkyNo - 1) + thumb_width / 2));

							TweenLite.to(thumb_inner, 0.5, {
		                        x: _x
		                    });

						} else if (active_thumb_left > right_position - thumb_width * 1.5) {
							
							_x = Math.max( - (thumb_inner.width() - (right_position - left_position)) - parseInt(thumb_inner.css('padding-left')) - parseInt(thumb_inner.css('padding-right')), - (thumb_width * (cloudInstance.options.upcomingSkyNo + 1.5) + left_position - right_position));
							TweenLite.to(thumb_inner, 0.5, {
		                        x: _x
		                    });
						}
					}
					cloudInstance.options.timeouts.push(setTimeout(function() {
						if (right_position - cloud_container.find('.kr-thumb-container .kr-thumb:eq(' + (cloudInstance.options.numberOfSlides - 1) + ')').position().left > thumb_width) {
							TweenLite.to(thumb_inner, 0.5, {
		                        x: right_position - thumb_width * cloudInstance.options.numberOfSlides - parseInt(thumb_inner.css('padding-left')) - parseInt(thumb_inner.css('padding-right'))
		                    });
						}
					}, 100));
				}
			}
		};

		// Ken Burns
		cloudInstance.kenBurn = function(sky) {

			if (typeof sky.data('ken-positionto') != 'undefined') {
				var scale = (parseFloat(sky.data('ken-scalefrom')) > 0 ? parseFloat(sky.data('ken-scalefrom')) : 1);
				var scaleTo = (parseFloat(sky.data('ken-scaleto')) > 0 ? parseFloat(sky.data('ken-scaleto')) : 1);
				var bg_width = sky.data('width_to_rate') * parseFloat(cloud_wrapper.css('width'));
				var bg_height = sky.data('height_to_rate') * parseFloat(cloud_wrapper.css('width'));
				var duration = parseInt(sky.data('ken-duration'));
				var easing = sky.data('ken-easing');

				if (duration < 0) {
					duration = parseInt(sky.data('duration'));
				}

				if (typeof easing == 'undefined' || easing == '') {
					easing = 'easeOutQuad';
				}
				var css = {};

				css['scale'] = scaleTo / scale;

				var top, left;
				if ((sky.data('ken-positionto') + '').indexOf('top') >= 0) {
					top = 0;
				} else if((sky.data('ken-positionto') + '').indexOf('bottom') >= 0) {
					top = parseFloat(cloud_wrapper.css('height')) - bg_height;
				} else if(parseFloat(sky.data('ken-positionto').split(' ')[0]) >= 0) {
					top = (parseFloat(cloud_wrapper.css('height')) - bg_height) * parseFloat(sky.data('ken-positionto').split(' ')[0]) / 100;
				} else if(parseFloat(sky.data('ken-positionto').split(',')[0]) >= 0) {
					top = (parseFloat(cloud_wrapper.css('height')) - bg_height) * parseFloat(sky.data('ken-positionto').split(',')[0]) / 100;
				} else {
					top = (parseFloat(cloud_wrapper.css('height')) - bg_height) / 2;
				}

				if ((sky.data('ken-positionto') + '').indexOf('left') >= 0) {
					left = 0;
				} else if ((sky.data('ken-positionto') + '').indexOf('right') >= 0) {
					left = parseFloat(cloud_wrapper.css('width')) - bg_width;
				} else if(parseFloat(sky.data('ken-positionto').split(' ')[1]) >= 0) {
					left = (parseFloat(cloud_wrapper.css('width')) - bg_width) * parseFloat(sky.data('ken-positionto').split(' ')[1]) / 100;
				} else if(parseFloat(sky.data('ken-positionto').split(',')[1]) >= 0) {
					left = (parseFloat(cloud_wrapper.css('width')) - bg_width) * parseFloat(sky.data('ken-positionto').split(',')[1]) / 100;
				} else {
					left = (parseFloat(cloud_wrapper.css('width')) - bg_width) / 2;
				}

				css['y'] = top + bg_height / 2 - (parseFloat(sky.find('.sky-background img').css('top')) + sky.data('bg_height') / 2);
				css['x'] = left + bg_width / 2 - (parseFloat(sky.find('.sky-background img').css('left')) + sky.data('bg_width') / 2);
				if (parseFloat(sky.data('ken-rotateto')) != 0) {
					css['rotation'] = parseFloat(sky.data('ken-rotateto'));
				}				

				sky.data('cloud_wrapper_width', parseFloat(cloud_wrapper.css('width')));
				sky.data('cloud_wrapper_height', parseFloat(cloud_wrapper.css('height')));

				cloudInstance.options.kenTween = TweenMax.to(sky.find('.sky-background img'),
					duration / 1000,
					{
						css: css,
						ease: easing
					}
				);
			}
		};

		cloudInstance.newSkyStart = function() {

			cloudInstance.options.isBusy = false;
			cloudInstance.options.currentSky.data('isBusy', false);
			if (!cloudInstance.options.slideTransitionNeeded) {
				cloudInstance.switchActiveNav();
			}

			// Count for showed carousel for autoSlideCarousel option
			if (cloudInstance.options.autoSlideCarousel == 'combine') {
				cloudInstance.options.carouselShowed = 0;
				cloudInstance.options.carouselRepeated = false;
			}

			var oldSky = cloudInstance.options.currentSky;
			var newSky = cloudInstance.options.currentSky = cloudInstance.options.upcomingSky;

			if (cloudInstance.options.kenTween && cloudInstance.options.kenTween != null && typeof cloudInstance.options.kenTween != 'undefined') {
				cloudInstance.options.kenTween.kill();
				cloudInstance.options.kenTween = null;
			}

			cloudInstance.options.currentSkyNo = cloudInstance.options.upcomingSkyNo;
			
			cloudInstance.options.currentSky.css('overflow', 'hidden').find('.sky-background').show();
			
			//TweenMax.killAll();
			for(var i = 0; i < cloudInstance.options.timeouts.length; i++) {
		        clearTimeout(cloudInstance.options.timeouts);
		    }
			cloudInstance.options.timeouts.length = 0;

			cloud_container.find('.kr-flow-panel').find('*').each(function() {
				$(this).remove();
			});
			cloud_container.find('.kr-flow-panel').remove();

			oldSky.removeClass('sky-opened');
			newSky.addClass('sky-opened');

			if (!cloudInstance.options.paused && (cloudInstance.options.numberOfSlides > 1 || cloudInstance.options.currentSky.find('.kr-carousel-container').length > 0)) {
				cloudInstance.resume();
			} else if (cloudInstance.options.paused && cloudInstance.options.navType == 'thumb') {
				// Fixed transparency issue of the thumbnail container
				var hiddenDiv = $('<div>').css({width:0, height:1, background:'transparent'}).appendTo(cloud_container);
				TweenMax.to(hiddenDiv,
					1,
					{
						css: {
							width : parseFloat(cloud_wrapper.css('width'))
						},
						ease: Linear.easeNone,
						onComplete: function() {
							hiddenDiv.remove();
						}
					}
				);
			}

			cloudInstance.redrawAll(cloudInstance.options.currentSky);

			if (cloudInstance.options.needToRedrawSkin) {
				cloudInstance.redrawSkin();
				cloudInstance.options.needToRedrawSkin = false;
			}

			if (!cloudInstance.options.slideTransitionNeeded && is_lowerIE8() && newSky.find('.kr-carousel-container').length > 0) {
				cloudInstance.flowCarouselTo('right');
			}

			cloudInstance.cloudsIn();

			cloudInstance.kenBurn(newSky);

			// YoutubeIframe Refresh
			if (cloudInstance.options.youtubeToRefresh && cloudInstance.options.youtubeToRefresh.length > 0) {
				for(var i = 0; i < cloudInstance.options.youtubeToRefresh.length; i++) {
					var iframe = cloudInstance.options.youtubeToRefresh[i];
					iframe.data('player').stopVideo();
					
					iframe.wrap('<div id="' + iframe.data('id') + '"></div>');
					youtubeIframeLoad(iframe, iframe.data('id'), iframe.data('videoid'));
				}
			}
			if (cloudInstance.options.vimeoToRefresh && cloudInstance.options.vimeoToRefresh.length > 0) {
				for(var i = 0; i < cloudInstance.options.vimeoToRefresh.length; i++) {
					var iframe = cloudInstance.options.vimeoToRefresh[i];
					iframe.data('player').api('unload');
				}
			}

			cloudInstance.options.onSlidingComplete();
		};

		cloudInstance.cloudsOut = function(carousel) {
				
			cloudInstance.options.youtubeToRefresh = [];
			cloudInstance.options.vimeoToRefresh = [];

			cloudInstance.options.currentSky.find('.kr-cloud').each(function() {

				var cloud = $(this);

				cloud.data('anchored', false);

				if ($(this).data('outTimer')) {
					clearTimeout($(this).data('outTimer'));
				}

				if (carousel && !/kr-carousel-cloud/.test(cloud.attr('class'))) {
					return;
				}

				cloud.find('iframe[src*="youtube"]').each(function() {
					var youtubeIframe = $(this);
					if (youtubeIframe.data('player')) {
						cloudInstance.options.isVideoPlaying = false;
						cloudInstance.options.youtubeToRefresh.push(youtubeIframe);
					}
				});
				cloud.find('iframe[src*="vimeo"]').each(function() {
					var vimeoIframe = $(this);
					if (vimeoIframe.data('player')) {
						cloudInstance.options.vimeoToRefresh.push(vimeoIframe);
					}
				});

				cloud.find('video, audio').each(function() {
					if (this.currentTime > 0) {
						this.currentTime = 0;
					}
					this.pause();
				});

				TweenMax.killTweensOf(cloud);

				TweenMax.fromTo(
					cloud,
					cloud.data('durationout') / 1000,
					{
						transformOrigin : cloud.data('transformoriginout'),
						transformPerspective : cloud.data('perspectiveout')
					},
					{
						rotation : cloud.data('rotateout'),
						rotationX : cloud.data('rotatexout'),
						rotationY : cloud.data('rotateyout'),
						skewX : cloud.data('skewxout'),
						skewY : cloud.data('skewyout'),
						scaleX : cloud.data('scalexout'),
						scaleY : cloud.data('scaleyout'),
						x : cloud.data('offsetxout') * cloudInstance.options.responsiveRate,
						y : cloud.data('offsetyout') * cloudInstance.options.responsiveRate,
						//delay : cloud.data('delayout') / 1000,
						ease : cloud.data('easingout'),
						opacity : (cloud.data('fadeout') != false) ? 0 : 1,
						onComplete : function() {
							cloud.css({
								display: 'none',
								opacity: (cloud.data('fadeout') != false) ? cloud.data('opacity') : 1
							});

							if (carousel) {
								var allOuted = true;
								cloudInstance.options.currentSky.find('*[class*="kr-carousel-cloud"]').each(function() {
									if ($(this).is(':visible')) {
										allOuted = false;
									}
								});
								if (allOuted) {
									cloudInstance.cloudsIn(true);
								}
							}
						}
					}
				);
			});
		};

		// Transition out for specific cloud
		cloudInstance.cloudOut = function(cloud) {

			cloud.data('anchored', false);

			if ($(this).data('outTimer')) {
				clearTimeout($(this).data('outTimer'));
			}

			TweenMax.killTweensOf(cloud);

			TweenMax.fromTo(
				cloud,
				cloud.data('durationout') / 1000,
				{
					transformOrigin : cloud.data('transformoriginout'),
					transformPerspective : cloud.data('perspectiveout')
				},
				{
					rotation : cloud.data('rotateout'),
					rotationX : cloud.data('rotatexout'),
					rotationY : cloud.data('rotateyout'),
					skewX : cloud.data('skewxout'),
					skewY : cloud.data('skewyout'),
					scaleX : cloud.data('scalexout'),
					scaleY : cloud.data('scaleyout'),
					x : cloud.data('offsetxout') * cloudInstance.options.responsiveRate,
					y : cloud.data('offsetyout') * cloudInstance.options.responsiveRate,
					//delay : cloud.data('delayout') / 1000,
					ease : cloud.data('easingout'),
					opacity : (cloud.data('fadeout') != false) ? 0 : 1,
					onComplete : function() {
						cloud.css({
							display: 'none',
							opacity: (cloud.data('fadeout') != false) ? cloud.data('opacity') : 1
						});
					}
				}
			);
		};

		cloudInstance.cloudsIn = function(carousel) {

			var sky = cloudInstance.options.upcomingSky;
			if (carousel) sky = cloudInstance.options.currentSky;

			sky.find('.kr-cloud').each(function() {

				var cloud = $(this);

				if (/kr-carousel-cloud/.test(cloud.attr('class'))) {
					var carouselProp = sky.find('.kr-current-carousel .kr-carousel-img').data(cloud.attr('class').split('kr-carousel-cloud-')[1].split(' ')[0]);
					if (carouselProp && carouselProp != '') {
						cloud.css('opacity', '0');
						cloud.html(carouselProp);
					} else {
						return;
					}
				} else {

					if (carousel) return;

					cloud.find('iframe[src*="youtube"]').each(function() {
						var iframe = $(this);
						if (cloudInstance.options.video.autoPlay && iframe.data('player')) {
							iframe.data('player').playVideo();
						}
					});
					cloud.find('iframe[src*="vimeo"]').each(function() {
						var iframe = $(this);
						if (cloudInstance.options.video.autoPlay && iframe.data('player')) {
							iframe.data('player').api('play');
						}
					});

					cloud.find('video, audio').each(function() {
						if (cloudInstance.options.video.autoPlay) {
							this.play();
						}
					});
				}

				TweenMax.killTweensOf(cloud);

				TweenMax.fromTo(
					cloud,
					cloud.data('durationin') / 1000,
					{	// FromVars
						x : cloud.data('offsetxin') * cloudInstance.options.responsiveRate,
						y : cloud.data('offsetyin') * cloudInstance.options.responsiveRate,
						scaleX : cloud.data('scalexin'),
						scaleY : cloud.data('scaleyin'),
						rotation : cloud.data('rotatein'),
						rotationX : cloud.data('rotatexin'),
						rotationY : cloud.data('rotateyin'),
						skewX : cloud.data('skewxin'),
						skewY : cloud.data('skewyin'),
						display : 'block',
						opacity : (cloud.data('fadein') != false) ? 0 : 1,
						transformPerspective : cloud.data('perspectivein'),
						transformOrigin : cloud.data('transformoriginin')
					},
					{	// ToVars
						x : 0,
						y : 0,
						scaleX : 1,
						scaleY : 1,
						rotation : 0,
						rotationX : 0,
						rotationY : 0,
						skewX : 0,
						skewY : 0,
						opacity : (cloud.data('fadein') != false) ? cloud.data('opacity') : 1,
						delay : cloud.data('delayin') / 1000,
						ease : cloud.data('easingin'),
						onComplete : function() {
							cloud.data('anchored', true);
							if (cloud.data('delayout') > 0) {
								var outTimer = setTimeout(function() {
									TweenMax.killTweensOf(cloud);
									TweenMax.fromTo(
										cloud,
										cloud.data('durationout') / 1000,
										{	// FromVars
											transformOrigin : cloud.data('transformoriginout'),
											transformPerspective : cloud.data('perspectiveout')
										},
										{	// ToVars
											rotation : cloud.data('rotateout'),
											rotationX : cloud.data('rotatexout'),
											rotationY : cloud.data('rotateyout'),
											skewX : cloud.data('skewxout'),
											skewY : cloud.data('skewyout'),
											scaleX : cloud.data('scalexout'),
											scaleY : cloud.data('scaleyout'),
											x : cloud.data('offsetxout') * cloudInstance.options.responsiveRate,
											y : cloud.data('offsetyout') * cloudInstance.options.responsiveRate,
											ease : cloud.data('easingout'),
											opacity : (cloud.data('fadeout') != false) ? 0 : 1,
											onComplete : function() {
												cloud.css({
													display: 'none',
													opacity: (cloud.data('fadeout') != false) ? cloud.data('opacity') : 1
												});
											}
										}
									);
								}, cloud.data('delayout'));

								cloudInstance.options.timeouts.push(outTimer);

								cloud.data('outTimer', outTimer);
							}
						}
					}
				);
			});
		};


		// Transition in for specific cloud
		cloudInstance.cloudIn = function(cloud) {

			TweenMax.killTweensOf(cloud);

			TweenMax.fromTo(
				cloud,
				cloud.data('durationin') / 1000,
				{	// FromVars
					x : cloud.data('offsetxin') * cloudInstance.options.responsiveRate,
					y : cloud.data('offsetyin') * cloudInstance.options.responsiveRate,
					scaleX : cloud.data('scalexin'),
					scaleY : cloud.data('scaleyin'),
					rotation : cloud.data('rotatein'),
					rotationX : cloud.data('rotatexin'),
					rotationY : cloud.data('rotateyin'),
					skewX : cloud.data('skewxin'),
					skewY : cloud.data('skewyin'),
					display : 'block',
					opacity : (cloud.data('fadein') != false) ? 0 : 1,
					transformPerspective : cloud.data('perspectivein'),
					transformOrigin : cloud.data('transformoriginin')
				},
				{	// ToVars
					x : 0,
					y : 0,
					scaleX : 1,
					scaleY : 1,
					rotation : 0,
					rotationX : 0,
					rotationY : 0,
					skewX : 0,
					skewY : 0,
					opacity : (cloud.data('fadein') != false) ? cloud.data('opacity') : 1,
					ease : cloud.data('easingin'),
					onComplete : function() {
						cloud.data('anchored', true);
						if (cloud.data('delayout') > 0) {

							var outTimer = setTimeout(function() {

								TweenMax.killTweensOf(cloud);
								TweenMax.fromTo(
									cloud,
									cloud.data('durationout') / 1000,
									{	// FromVars
										transformOrigin : cloud.data('transformoriginout'),
										transformPerspective : cloud.data('perspectiveout')
									},
									{	// ToVars
										rotation : cloud.data('rotateout'),
										rotationX : cloud.data('rotatexout'),
										rotationY : cloud.data('rotateyout'),
										skewX : cloud.data('skewxout'),
										skewY : cloud.data('skewyout'),
										scaleX : cloud.data('scalexout'),
										scaleY : cloud.data('scaleyout'),
										x : cloud.data('offsetxout') * cloudInstance.options.responsiveRate,
										y : cloud.data('offsetyout') * cloudInstance.options.responsiveRate,
										ease : cloud.data('easingout'),
										opacity : (cloud.data('fadeout') != false) ? 0 : 1,
										onComplete : function() {
											cloud.css({
												display: 'none',
												opacity: (cloud.data('fadeout') != false) ? cloud.data('opacity') : 1
											});
										}
									}
								);
							}, cloud.data('delayout'));
							
							cloudInstance.options.timeouts.push(outTimer);
							cloud.data('outTimer', outTimer);
						}
					}
				}
			);
		};

		// Animate specific cloud
		cloudInstance.cloudAnimate = function(cloud, toVars) {

			TweenMax.killTweensOf(cloud);

			if (typeof toVars.duration == 'undefined') {
				toVars.duration = 1000;
			}

			if (typeof toVars.easing == 'undefined') {
				toVars.easing = 'linear';
			}

			if (typeof toVars.offsetx == 'undefined') {
				toVars.offsetx = 0;
			}

			if (typeof toVars.offsety == 'undefined') {
				toVars.offsety = 0;
			}

			if (typeof toVars.scalex == 'undefined') {
				toVars.scalex = 1;
			}

			if (typeof toVars.scaley == 'undefined') {
				toVars.scaley = 1;
			}

			if (typeof toVars.rotate == 'undefined') {
				toVars.rotate = 0;
			}

			if (typeof toVars.rotatex == 'undefined') {
				toVars.rotatex = 0;
			}

			if (typeof toVars.rotatey == 'undefined') {
				toVars.rotatey = 0;
			}

			if (typeof toVars.skewx == 'undefined') {
				toVars.skewx = 0;
			}

			if (typeof toVars.skewy == 'undefined') {
				toVars.skewy = 0;
			}

			if (typeof toVars.opacity == 'undefined') {
				toVars.opacity = 1;
			}

			if (typeof toVars.delay == 'undefined') {
				toVars.delay = 0;
			}

			if (typeof toVars.perspective == 'undefined') {
				toVars.perspective = 400;
			}

			if (typeof toVars.transformorigin == 'undefined') {
				toVars.transformorigin = '50% 50% 0';
			}

			TweenMax.set(
				cloud,
				{
					transformPerspective : toVars.perspective,
					transformOrigin : toVars.transformorigin
				}
			);

			TweenMax.to(
				cloud,
				toVars.duration / 1000,
				{
					x: toVars.offsetx * cloudInstance.options.responsiveRate,
					y: toVars.offsety * cloudInstance.options.responsiveRate,
					scaleX: toVars.scalex,
					scaleY: toVars.scaley,
					rotation: toVars.rotate,
					rotationX: toVars.rotationx,
					rotationY: toVars.rotationy,
					skewX: toVars.skewx,
					skewY: toVars.skewy,
					opacity: toVars.opacity,
					delay: toVars.delay / 1000,
					ease: toVars.easing
				}
			);
		};

		// Sliding From Now
		cloudInstance.fly = function() {
		
			cloudInstance.options.isBusy = true;
			cloudInstance.pause();

			if (cloudInstance.options.slideTransitionNeeded) {
				cloudInstance.switchActiveNav();
			}

			cloudInstance.options.onSlidingStart();
			
			if (!cloudInstance.options.slideTransitionNeeded) {				

				cloud_others.show();
				if (cloudInstance.options.thumb.visibility == 'show') {
					cloud_others.find('.kr-thumb').css('visibility', 'visible');
				}

				cloudInstance.newSkyStart();
				cloudInstance.options.slideTransitionNeeded = true;
			} else{
				
				cloudInstance.cloudsOut();

				var transition = cloudInstance.get_randomItem(cloudInstance.options.upcomingSky.data('transitionlist'));

				if (transition == 'all') {
					transition = cloudInstance.get_randomItem(get_transitions('all'));
				} else if (transition == '2d') {
					transition = cloudInstance.get_randomItem(get_transitions('2d'));
				} else if (transition == '3d') {
					transition = cloudInstance.get_randomItem(get_transitions('3d'));
				} else {
					transition = get_transitions(parseInt(transition));
				}

				if (cloudInstance.options.currentSky.find('.sky-background img').length <= 0 || cloudInstance.options.upcomingSky.find('.sky-background img').length <= 0) {
					transition = get_transitions(10);	// Fade
					if (cloudInstance.options.currentSky.find('.sky-background img').length <= 0 || cloudInstance.options.upcomingSky.find('.sky-background img').length <= 0) {
						transition.animation[0].duration = 400;
					}
				}
				var flow_panel = $('<div class="kr-flow-panel"/>').css('overflow', transition.overflow).prependTo(cloudInstance.options.currentSky.css('overflow', transition.overflow));
			
				var delay = [];
				
				var rows = transition.rows;
				var cols = transition.cols;

				if (rows > 10) {
					rows = Math.floor(transition.rows * cloudInstance.options.responsiveRate);
				}
				if (cols > 10) {
					cols = Math.floor(transition.cols * cloudInstance.options.responsiveRate);
				}

				if (cols * rows > 1) {
					if (transition.cellOrder == 'a-z') {
						for (var i = 0; i < cols * rows; i++) {
							delay.push(i * transition.cellDelay);
						}
					} else if (transition.cellOrder == 'z-a') {
						for (var i = cols * rows - 1; i >= 0; i--) {
							delay.push(i * transition.cellDelay);
						}
					} else {
						for (var i = 0; i < cols * rows; i++) {
							delay.push(i * transition.cellDelay);
						}

						for (var tmp, cur, top=delay.length; top--;) {
							cur = (Math.random() * (top + 1)) << 0;
							tmp = delay[cur]; delay[cur] = delay[top]; delay[top] = tmp;
						}
					}
				} else {
					delay.push(0);
				}

				var currentSkyBg = cloudInstance.options.currentSky.find('.sky-background');
				var upcomingSkyBg = cloudInstance.options.upcomingSky.find('.sky-background');

				var upcomingSkyBgImg = upcomingSkyBg.find('img');
				var bg_width = parseFloat(cloud_wrapper.css('width'));
				var bg_height = upcomingSkyBgImg.data('background_height') * parseFloat(cloud_wrapper.css('width')) / upcomingSkyBgImg.data('background_width');

				
				if (upcomingSkyBgImg.data('size') == 'contain') {
					if (upcomingSkyBgImg.data('background_width') / upcomingSkyBgImg.data('background_height') < parseFloat(cloud_wrapper.css('width')) / parseFloat(cloud_wrapper.css('height'))) {
						bg_width = upcomingSkyBgImg.data('background_width') * parseFloat(cloud_wrapper.css('height')) / upcomingSkyBgImg.data('background_height');
						bg_height = parseFloat(cloud_wrapper.css('height'));
					}
				} else {
					if (upcomingSkyBgImg.data('background_width') / upcomingSkyBgImg.data('background_height') > parseFloat(cloud_wrapper.css('width')) / parseFloat(cloud_wrapper.css('height'))) {
						bg_width = upcomingSkyBgImg.data('background_width') * parseFloat(cloud_wrapper.css('height')) / upcomingSkyBgImg.data('background_height');
						bg_height = parseFloat(cloud_wrapper.css('height'));
					}
				}
				upcomingSkyBgImg.css({
					width: bg_width,
					height: bg_height,
					left: - (bg_width - parseFloat(cloud_wrapper.css('width'))) / 2,
					top: - (bg_height - parseFloat(cloud_wrapper.css('height'))) / 2
				});

				if (typeof cloudInstance.options.upcomingSky.data('ken-positionfrom') != 'undefined') {
					var scale = (parseFloat(cloudInstance.options.upcomingSky.data('ken-scalefrom')) > 0 ? parseFloat(cloudInstance.options.upcomingSky.data('ken-scalefrom')) : 1);
					bg_width *= scale;
					bg_height *= scale;

					var css = {};

					css['width'] = bg_width;
					css['height'] = bg_height;

					css['scale'] = 1;
					css['x'] = 0;
					css['y'] = 0;

					if ((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').indexOf('top') >= 0) {
						css['top'] = 0;
					} else if((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').indexOf('bottom') >= 0) {
						css['top'] = parseFloat(cloud_wrapper.css('height')) - bg_height;
					} else if(parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(' ')[0]) >= 0) {
						css['top'] = (parseFloat(cloud_wrapper.css('height')) - bg_height) * parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(' ')[0]) / 100;
					} else if(parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(',')[0]) >= 0) {
						css['top'] = (parseFloat(cloud_wrapper.css('height')) - bg_height) * parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(',')[0]) / 100;
					} else {
						css['top'] = (parseFloat(cloud_wrapper.css('height')) - bg_height) / 2;
					}

					if ((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').indexOf('left') >= 0) {
						css['left'] = 0;
					} else if ((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').indexOf('right') >= 0) {
						css['left'] = parseFloat(cloud_wrapper.css('width')) - bg_width;
					} else if(parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(' ')[1]) >= 0) {
						css['left'] = (parseFloat(cloud_wrapper.css('width')) - bg_width) * parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(' ')[1]) / 100;
					} else if(parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(',')[1]) >= 0) {
						css['left'] = (parseFloat(cloud_wrapper.css('width')) - bg_width) * parseFloat((cloudInstance.options.upcomingSky.data('ken-positionfrom') + '').split(',')[1]) / 100;
					} else {
						css['left'] = (parseFloat(cloud_wrapper.css('width')) - bg_width) / 2;
					}

					css['rotation'] = 0;
					TweenMax.set(upcomingSkyBgImg, {
							css: css
						}
					);
				}

				var totalW = parseFloat(cloud_wrapper.css('width'));
				var totalH = parseFloat(cloud_wrapper.css('height'));

				var perspective = Math.max(totalW, totalH);

				var totalCellW = 0;
				var totalCellH = 0;
				
				var nextCell;

				if (transition.cellThick == 0) {
					currentSkyBg.clone().removeClass('sky-background').addClass('kr-current-bg').show().prependTo(flow_panel);					
				}
				cloudInstance.options.currentSky.find('.sky-background').hide();

				for(var i = 0; i < cols * rows; i++) {

					var cellW = Math.round(totalW / cols);
					var cellH = Math.round(totalH / rows);

					var css = $.extend({}, transition.css);

					if (transition.css) {
						if (!transition.css.top) {
							css.top = 0;
						}
						if (!transition.css.left) {
							css.left = 0;
						}
						if (transition.css.top == 'random') {
							var tmp = [cellH, 0, -cellH];
							css.top = tmp[Math.floor(Math.random() * 3)];
						} else if (transition.css.top == 'top') {
							css.top = -cellH;
						} else if (transition.css.top == 'bottom') {
							css.top = cellH;
						}
						
						if (transition.css.left == 'random') {
							if (css.top == 0) {
								var tmp = [cellW, -cellW];
								css.left = tmp[Math.floor(Math.random() * 2)];
							} else {
								css.left = 0;
							}
						} else if (transition.css.left == 'left') {
							css.left = -cellW;
						} else if (transition.css.left == 'right') {
							css.left = cellW;
						}
					}
					
					var scaleX = scaleY = scaleZ = false;
					var rotationX = rotationY = rotationZ = 0;
					var needFinalAnimation = true;

					var ind = 0;
					while(transition.animation[ind]) {
						if (transition.animation[ind].toVars.css) {
							if (transition.animation[ind].toVars.css.scaleX && transition.animation[ind].toVars.css.scaleX == 1) {
								scaleX = true;
							}
							if (transition.animation[ind].toVars.css.scaleY && transition.animation[ind].toVars.css.scaleY == 1) {
								scaleY = true;
							}
							if (transition.animation[ind].toVars.css.scaleZ && transition.animation[ind].toVars.css.scaleZ == 1) {
								scaleZ = true;
							}

							if (transition.animation[ind].toVars.css.rotationX) {
								rotationX += transition.animation[ind].toVars.css.rotationX;
							}
							if (transition.animation[ind].toVars.css.rotationY) {
								rotationY += transition.animation[ind].toVars.css.rotationY;
							}
							if (transition.animation[ind].toVars.css.rotationZ) {
								rotationZ += transition.animation[ind].toVars.css.rotationZ;
							}
						} else {
							needFinalAnimation = false;
						}
						ind++;
					}

					var cell = $('<div class="kr-cell" />').appendTo(flow_panel);

					cell.css({
						width : cellW,
						height : cellH,
						overflow: transition.overflow,
						'perspective': perspective,
						'-o-perspective': perspective,
						'-ms-perspective': perspective,
						'-moz-perspective': perspective,
						'-webkit-perspective': perspective
					});
						
					if (i % cols == cols - 1) {
						cellW = totalW - totalCellW;
						totalCellW = 0;
						if (rows * cols - i > cols) {
							totalCellH += cell.height();
						}
					} else {
						totalCellW += cell.width();
					}
					if (rows > 1 && rows * cols - i <= cols && totalCellH > 0) {
						cellH = totalH - totalCellH;
					}

					cell.css({
						width : cellW,
						height : cellH
					});

					var cellT = transition.cellThick * cloudInstance.options.responsiveRate;
					var cellT2 = cellT / 2;
					var originZ = (is_mobile()) ?  - cellT : - cellT2;

					var shape = $('<div class="kr-shape" />').css({
						'transform-origin'			: cellW / 2 + 'px ' + cellH / 2 + 'px ' + originZ + 'px',
						'-ms-transform-origin'		: cellW / 2 + 'px ' + cellH / 2 + 'px ' + originZ + 'px',
						'-webkit-transform-origin'	: cellW / 2 + 'px ' + cellH / 2 + 'px ' + originZ + 'px'
					}).appendTo(cell);
					
					var box_front = $('<div class="kr-box-front" />').css({
							width: cellW,
							height: cellH
					}).appendTo(shape);

					if (cellT > 0) {
						
						if (rotationX > 90 || rotationX < -90) {
							var box_back = $('<div class="kr-box-back" />').css({
									width: cellW,
									height: cellH,
									'-webkit-transform'	: 'rotateX( -180deg ) translateZ( ' + cellT + 'px )',
									'-moz-transform'	: 'rotateX( -180deg ) translateZ( ' + cellT + 'px )',
									'-ms-transform'		: 'rotateX( -180deg ) translateZ( ' + cellT + 'px )',
									'-o-transform'		: 'rotateX( -180deg ) translateZ( ' + cellT + 'px )',
									'transform'			: 'rotateX( -180deg ) translateZ( ' + cellT + 'px )'
							}).appendTo(shape);
						} else {
							var box_back = $('<div class="kr-box-back" />').css({
									width: cellW,
									height: cellH,
									'-webkit-transform'	: 'rotateY( -180deg ) translateZ( ' + cellT + 'px )',
									'-moz-transform'	: 'rotateY( -180deg ) translateZ( ' + cellT + 'px )',
									'-ms-transform'		: 'rotateY( -180deg ) translateZ( ' + cellT + 'px )',
									'-o-transform'		: 'rotateY( -180deg ) translateZ( ' + cellT + 'px )',
									'transform'			: 'rotateY( -180deg ) translateZ( ' + cellT + 'px )'
							}).appendTo(shape);
						}
						var box_left = $('<div class="kr-box-left" />').css({
								width: cellT,
								height: cellH,
								'-webkit-transform'	: 'rotateY( -90deg ) translateX(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'-moz-transform'	: 'rotateY( -90deg ) translateX(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'-ms-transform'		: 'rotateY( -90deg ) translateX(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'-o-transform'		: 'rotateY( -90deg ) translateX(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'transform'			: 'rotateY( -90deg ) translateX(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )'
						}).appendTo(shape);

						var box_right = $('<div class="kr-box-right" />').css({
								width: cellT,
								height: cellH,
								'-webkit-transform'	: 'rotateY( 90deg ) translateX(' + (cellT2) + 'px) translateZ( ' + (cellW - cellT2) + 'px )',
								'-moz-transform'	: 'rotateY( 90deg ) translateX(' + (cellT2) + 'px) translateZ( ' + (cellW - cellT2) + 'px )',
								'-ms-transform'		: 'rotateY( 90deg ) translateX(' + (cellT2) + 'px) translateZ( ' + (cellW - cellT2) + 'px )',
								'-o-transform'		: 'rotateY( 90deg ) translateX(' + (cellT2) + 'px) translateZ( ' + (cellW - cellT2) + 'px )',
								'transform'			: 'rotateY( 90deg ) translateX(' + (cellT2) + 'px) translateZ( ' + (cellW - cellT2) + 'px )'
						}).appendTo(shape);

						var box_top = $('<div class="kr-box-top" />').css({
								width: cellW,
								height: cellT,
								'-webkit-transform'	: 'rotateX( 90deg ) translateY(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'-moz-transform'	: 'rotateX( 90deg ) translateY(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'-ms-transform'		: 'rotateX( 90deg ) translateY(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'-o-transform'		: 'rotateX( 90deg ) translateY(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )',
								'transform'			: 'rotateX( 90deg ) translateY(-' + (cellT2) + 'px) translateZ( ' + cellT2 + 'px )'
						}).appendTo(shape);

						var box_bottom = $('<div class="kr-box-bottom" />').css({
								width: cellW,
								height: cellT,
								'-webkit-transform'	: 'rotateX( -90deg ) translateY(' + (cellT2) + 'px) translateZ( ' + (cellH - cellT2) + 'px )',
								'-moz-transform'	: 'rotateX( -90deg ) translateY(' + (cellT2) + 'px) translateZ( ' + (cellH - cellT2) + 'px )',
								'-ms-transform'		: 'rotateX( -90deg ) translateY(' + (cellT2) + 'px) translateZ( ' + (cellH - cellT2) + 'px )',
								'-o-transform'		: 'rotateX( -90deg ) translateY(' + (cellT2) + 'px) translateZ( ' + (cellH - cellT2) + 'px )',
								'transform'			: 'rotateX( -90deg ) translateY(' + (cellT2) + 'px) translateZ( ' + (cellH - cellT2) + 'px )'
						}).appendTo(shape);
					}
					

					if (rotationX == -90) {
						nextCell = box_top;
					} else if (rotationX == 90) {
						nextCell = box_bottom;
					} else if (rotationY == -90) {
						nextCell = box_left;
					} else if (rotationY == 90) {
						nextCell = box_right;
					} else {
						nextCell = box_back;
					}
					
					shape.css(css);
					
					var margin_left = - parseFloat(cell.position().left);
					var margin_top = - parseFloat(cell.position().top);
					if (transition.cellThick == 0) {
						
						var clonedUpcomingSkyBg = upcomingSkyBg.clone().css({
							left : margin_left,
							top : margin_top,
							position: 'absolute'
						}).appendTo(box_front);

						cloud_container.find('.kr-box-front').css('background-color', 'transparent');

					} else {
						var clonedCurrentSkyBg = currentSkyBg.clone().css({
							left : margin_left,
							top : margin_top,
							position: 'absolute'
						}).appendTo(box_front);

						var clonedUpcomingSkyBg = upcomingSkyBg.clone().css({
							display: 'block',
							left : margin_left,
							top : margin_top,
							position: 'absolute'
						}).appendTo(nextCell);
					}

					var ind = 0;
					var timelineLite = new TimelineLite();
					
					while(transition.animation[ind]) {
						
						var toVars = $.extend({}, transition.animation[ind].toVars);
						toVars['delay'] = delay[i] / 1000;

						if (!needFinalAnimation) {
							
							toVars['css'] = {
								top: 0,
								left: 0,
								opacity: 1,
								rotationX: 0,
								rotationY: 0,
								rotationZ: 0,
								scaleX: 1,
								scaleY: 1,
								scaleZ: 1
							}
						}

						if (transition.shift && transition.cellThick == 0 && rows == 1 && cols == 1) {

							cloud_container.find('.kr-box-front *').show();
							timelineLite.fromTo(
								shape,
								transition.animation[ind].duration / 1000,
								css,
								toVars
							);

							TweenMax.to(
								flow_panel.find('.kr-current-bg'),
								transition.animation[ind].duration / 1000,
								{
									top: - css.top,
									left: - css.left,
									ease: transition.animation[ind].toVars.ease
								}
							);

						} else {
							timelineLite.set(
								shape,
								css
							);
							cloud_container.find('.kr-box-front *').show();
							timelineLite.to(
								shape,
								transition.animation[ind].duration / 1000,
								toVars
							);

							if (transition.cellThick == 0 && rows == 1 && cols == 1 && transition.css.opacity == 0) {
								TweenMax.to(
									flow_panel.find('.kr-current-bg'),
									transition.animation[ind].duration / 1000,
									{
										opacity: 0,
										ease: transition.animation[ind].toVars.ease
									}
								);
							} 
						}
						ind++;
					}
					
					var toVars = {};

					if (!scaleX) {
						toVars['scaleX'] = 1;
					}
					if (!scaleY) {
						toVars['scaleY'] = 1;
					}
					if (!scaleZ) {
						toVars['scaleZ'] = 1;
					}
					if (rotationX >= 0 && rotationX < 90 || rotationX > -90 && rotationX <= 0) {
						toVars['rotationX'] = 0;
					} else if (rotationX > 90 && rotationX < 180) {
						toVars['rotationX'] = 180;
					} else if (rotationX > -180 && rotationX < -90) {
						toVars['rotationX'] = -180;
					}
					if (rotationY >= 0 && rotationY < 90 || rotationY > -90 && rotationY <= 0) {
						toVars['rotationY'] = 0;
					} else if (rotationY > 90 && rotationY < 180) {
						toVars['rotationY'] = 180;
					} else if (rotationY > -180 && rotationY < -90) {
						toVars['rotationY'] = -180;
					}
					if (rotationZ >= 0 && rotationZ < 90 || rotationZ > -90 && rotationZ <= 0) {
						toVars['rotationZ'] = 0;
					} else if (rotationZ > 90 && rotationZ < 180) {
						toVars['rotationZ'] = 180;
					} else if (rotationZ > -180 && rotationZ < -90) {
						toVars['rotationZ'] = -180;
					}
					var finalDuration = 1;

					if (!$.isEmptyObject(toVars) && needFinalAnimation) {
						finalDuration = 400;
					}

					if (delay[i] == (cols * rows - 1) * transition.cellDelay) {
						toVars['onComplete'] = function() {
							cloudInstance.newSkyStart();
						};
					}

					timelineLite.to(
						shape,
						finalDuration / 1000,
						toVars
					);
				}
			};
		};


		// Return random item of array
		cloudInstance.get_randomItem = function(arr) {
			if (typeof arr == 'undefined' || arr == null) return false;

			if (arr == '1,2') {
				if (cloudInstance.options.upcomingSkyNo - cloudInstance.options.currentSkyNo == 1 || (cloudInstance.options.currentSkyNo == cloudInstance.options.numberOfSlides - 1 && cloudInstance.options.upcomingSkyNo == 0)) {
					return 1;
				} else {
					return 2;
				}
			}
			return arr[Math.floor(Math.random() * arr.length)];
		}
		// initializing
		cloudInstance.initialize();
	};

	
	/*
	* Get youtube video ID
	*/
	var get_youtube_code = function(url) {
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match && match[7].length == 11) {
			return match[7];
		} else{
			return false;
		}
	}

	/*
	* Get vimeo ID
	*/
	var get_vimeo_code = function(url) {
		var match = /vimeo.*\/(\d+)/i.exec(url);

		if (match) {		
			return match[1];
		}
	}

	/*
	* Get url of this js file
	*/
	var get_self_url = function() {
	    var scripts = document.getElementsByTagName('SCRIPT');
	    var path = '';
	    if(scripts && scripts.length > 0) {
	        for(var i in scripts) {
	            if(scripts[i].src && scripts[i].src.match(/\/cloudslider.jquery/)) {
	                path = scripts[i].src.substring(0, (scripts[i].src + '').lastIndexOf('js/'));
	                break;
	            }
	        }
	    }
	    if (path == '') {
			path = '../cloudslider/';
		}
	    return path;
	}

	/*
	* Check current browser is ie8 or lower
	*/
	var is_lowerIE8 = function() {
		var userAgent = navigator.userAgent.toLowerCase();
		return (userAgent.indexOf('msie') != -1 && parseFloat((userAgent.match(/.*(?:rv|ie)[\/: ](.+?)([ \);]|$)/) || [])[1]) < 9) ? true : false;
	};

	/*
	* Check current browser is mobile
	*/
	var is_mobile = function() {
	    var mobile = ['iphone', 'ipad', 'iPod', 'android', 'blackberry', 'webos','nokia','opera mini','windows mobile','windows phone','iemobile'];
		for (var i in mobile) if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;
	    return false;
	}

	/*
	* Check current browser support 3d transform
	*/
	var supports3d = function() {

		if (!!navigator.userAgent.match(/Trident\/7\./)) return false; // if ie

		var el = document.createElement('div'), 
	        has3d,
	        transforms = {
	            'webkitTransform':'-webkit-transform',
	            'OTransform':'-o-transform',
	            'msTransform':'-ms-transform',
	            'MozTransform':'-moz-transform',
	            'transform':'transform'
	        };

	    // Add it to the body to get the computed style.
	    document.body.insertBefore(el, null);

	    for (var t in transforms) {
	        if (el.style[t] !== undefined) {
	            el.style[t] = "translate3d(1px, 1px, 1px)";
	            has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
	        }
	    }

	    document.body.removeChild(el);

	    return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
	}

	
	/*
	* Return defined transitions (2D & 3D)
	*/
	var get_transitions = function(id) {

		var transitions_2d = [

			{	//1
				title: 'Slide To Left',
				rows: 1,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: true,
				css:	{
							top: 0,
							left: 'right'
						 },
				animation:	[
								{
									duration: 800,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//2
				title: 'Slide To Right',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: true,
				css: {
						top: 0,
						left: 'left'
					 },
				animation:	[
								{
									duration: 800,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//3
				title: 'Slide To Top',
				rows: 1,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: true,
				css: {
						top: 'bottom',
						left: 0
					 },
				animation:	[
								{
									duration: 800,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//4
				title: 'Slide To Bottom',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: true,
				css: {
						top: 'top',
						left: 0
					 },
				animation:	[
								{
									duration: 800,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//5
				title: 'Slide Cells To Left',
				rows: 1,
				cols: 20,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'right'
					 },
				animation:	[
								{
									duration: 300,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//6
				title: 'Slide Cells To Right',
				rows: 1,
				cols: 20,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'left'
					 },
				animation:	[
								{
									duration: 300,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//7
				title: 'Slide Cells To Top',
				rows: 20,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'bottom',
						left: 0
					 },
				animation:	[
								{
									duration: 300,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//8
				title: 'Slide Cells To Bottom',
				rows: 20,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'top',
						left: 0
					 },
				animation:	[
								{
									duration: 300,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//9
				title: 'Slide Cells Randomly',
				rows: 3,
				cols: 5,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'random',
						left: 'random'
					 },
				animation:	[
								{
									duration: 600,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//10
				title: 'Fade',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 0,
						opacity: 0
					 },
				animation:	[
								{
									duration: 800,
									toVars: {
										ease: 'easeInOutQuad'
									}
								}
							]
			},
			{	//11
				title: 'Fade Cells To Left',
				rows: 1,
				cols: 20,
				cellOrder: 'z-a',
				cellDelay: 20,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 0,
						opacity: 0
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//12
				title: 'Fade Cells To Right',
				rows: 1,
				cols: 20,
				cellOrder: 'a-z',
				cellDelay: 20,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 0,
						opacity: 0
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//13
				title: 'Fade Cells To Top',
				rows: 20,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 20,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 0,
						opacity: 0
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//14
				title: 'Fade Cells To Bottom',
				rows: 20,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 20,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 0,
						opacity: 0
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeInOutQuart'
									}
								}
							]
			},
			{	//15
				title: 'Fade Cells Randomly',
				rows: 3,
				cols: 5,
				cellOrder: 'random',
				cellDelay: 30,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 0,
						opacity: 0
					 },
				animation:	[
								{
									duration: 800,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//16
				title: 'Fade&Slide Cells Randomly',
				rows: 3,
				cols: 5,
				cellOrder: 'random',
				cellDelay: 30,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'random',
						left: 'random',
						opacity: 0
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//17
				title: 'Rotate To Left',
				rows: 1,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'right',
						rotationY: -90
					 },
				animation:	[
								{
									duration: 1300,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//18
				title: 'Rotate To Right',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'left',
						rotationY: 90
					 },
				animation:	[
								{
									duration: 1300,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},	
			{	//19
				title: 'Rotate To Top',
				rows: 1,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'bottom',
						left: 0,
						rotationX: 90
					 },
				animation:	[
								{
									duration: 1300,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//20
				title: 'Rotate To Bottom',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'top',
						left: 0,
						rotationX: -90
					 },
				animation:	[
								{
									duration: 1300,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//21
				title: 'Scale In',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'visible',
				shift: false,
				css: {
						top: 0,
						left: 0,
						scale: 0.8,
						opacity: 0
					 },
				animation:	[
								{
									duration: 1500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//22
				title: 'Scale Out',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'visible',
				shift: false,
				css: {
						top: 0,
						left: 0,
						scale: 1.1,
						opacity: 0
					 },
				animation:	[
								{
									duration: 1500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//23
				title: 'Scale&Rotate To Left',
				rows: 1,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'visible',
				shift: false,
				css: {
						top: 0,
						left: 0,
						scale: 0.1,
						rotationY: 89
					 },
				animation:	[
								{
									duration: 1300,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//24
				title: 'Scale&Rotate To Right',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 0,
				cellThick: 0,
				overflow: 'visible',
				shift: false,
				css: {
						top: 0,
						left: 0,
						scale: 0.1,
						rotationY: -89
					 },
				animation:	[
								{
									duration: 1300,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//25
				title: 'Sldie&Scale Cells To Left Radomly',
				rows: 10,
				cols: 1,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'right',
						scale: 0.1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//26
				title: 'Sldie&Scale Cells To Right Radomly',
				rows: 10,
				cols: 1,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'left',
						scale: 0.1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//27
				title: 'Sldie&Scale Cells To Top Radomly',
				rows: 1,
				cols: 10,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'bottom',
						left: 0,
						scale: 0.1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//28
				title: 'Sldie&Scale Cells To Bottom Radomly',
				rows: 1,
				cols: 10,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'top',
						left: 0,
						scale: 0.1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},			
			{	//29
				title: 'Sldie Cells To Left Radomly',
				rows: 1,
				cols: 10,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'right',
						scale: 1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//30
				title: 'Sldie Cells To Right In Radomly',
				rows: 1,
				cols: 10,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 0,
						left: 'left',
						scale: 1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//31
				title: 'Sldie Cells To Top Radomly',
				rows: 10,
				cols: 1,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'bottom',
						left: 0,
						scale: 1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			},
			{	//32
				title: 'Sldie Cells To Bottom In Radomly',
				rows: 10,
				cols: 1,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 0,
				overflow: 'hidden',
				shift: false,
				css: {
						top: 'top',
						left: 0,
						scale: 1
					 },
				animation:	[
								{
									duration: 500,
									toVars: {
										ease: 'easeOutQuart'
									}
								}
							]
			}
		];
			
		//====================================================================================================================================================================================================
		var transitions_3d = [

			{	//33
				title: 'Twist Rows To Top',
				rows: 7,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 500,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 180
												}
											}
								}
							]
			},
			{	//34
				title: 'Twist Rows To Bottom',
				rows: 7,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 500,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: -180
												}
											}
								}
							]
			},
			{	//35
				title: 'Twist Cols To Right',
				rows: 1,
				cols: 10,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 500,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationY: 180
												}
											}
								}
							]
			},
			{	//36
				title: 'Twist Cols To Left',
				rows: 1,
				cols: 10,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 500,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationY: -180
												}
											}
								}
							]
			},
			{	//37
				title: 'Twist Cols To Top',
				rows: 1,
				cols: 10,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 500,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 180
												}
											}
								}
							]
			},
			{	//38
				title: 'Twist Cols To Bottom',
				rows: 1,
				cols: 10,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 500,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: -180
												}
											}
								}
							]
			},
			{	//39
				title: 'Twist Cells Randomly',
				rows: 3,
				cols: 5,
				cellOrder: 'random',
				cellDelay: 50,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 300,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9,
													rotationX: 30
												}
												
											}
								},
								{
									duration: 1000,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: -30,
													rotationY: 180
												}
											}
								}
							]
			},
			{	//40
				title: 'Totter Cols To Right',
				rows: 1,
				cols: 10,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 800,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 15,
													rotationY: 180
												}
											}
								}
							]
			},
			{	//41
				title: 'Totter Cols To Left',
				rows: 1,
				cols: 10,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 800,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 15,
													rotationY: -180
												}
											}
								}
							]
			},
			{	//42
				title: 'Rotate Cols To Right',
				rows: 1,
				cols: 10,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 1200,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationY: 180
												}
											}
								}
							]
			},
			{	//43
				title: 'Rotate Cols To Left',
				rows: 1,
				cols: 10,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 1200,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationY: -180
												}
											}
								}
							]
			},
			{	//44
				title: 'Rotate Rows To Top',
				rows: 7,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 1200,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 180
												}
											}
								}
							]
			},
			{	//45
				title: 'Rotate Rows To Bottom',
				rows: 7,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 20,
				direction: 'vertical',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 1200,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: -180
												}
											}
								}
							]
			},
			{	//46
				title: 'Scale&Rotate Cube To Right',
				rows: 1,
				cols: 1,
				cellOrder: 'a-z',
				cellDelay: 50,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 600,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													scaleX: 0.8,
													scaleY: 0.8,
													scaleZ: 0.8,
													rotationX: 10,
													rotationY: 145
												}
											}
								}
							]
			},
			{	//47
				title: 'Scale&Rotate Cube To Left',
				rows: 1,
				cols: 1,
				cellOrder: 'z-a',
				cellDelay: 50,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 600,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													scaleX: 0.8,
													scaleY: 0.8,
													scaleZ: 0.8,
													rotationX: 10,
													rotationY: -145
												}
											}
								}
							]
			},
			{	//48
				title: 'Scale&Rotate Rows To Right',
				rows: 3,
				cols: 5,
				cellOrder: 'a-z',
				cellDelay: 30,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[								
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 800,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 180,
													rotationY: 30
												}
											}
								}
							]
			},
			{	//49
				title: 'Scale&Rotate Rows To Left',
				rows: 3,
				cols: 5,
				cellOrder: 'z-a',
				cellDelay: 30,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 800,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 180,
													rotationY: -30
												}
											}
								}
							]
			},
			{	//50
				title: 'Scale&Rotate Rows To Left',
				rows: 3,
				cols: 5,
				cellOrder: 'random',
				cellDelay: 30,
				cellThick: 20,
				direction: 'horizontal',
				overflow: 'visible',
				shift: false,
				animation:	[
								{
									duration: 400,
									toVars:	{
												ease: 'easeOutBack',
												css: {
													scaleX: 0.9,
													scaleY: 0.9,
													scaleZ: 0.9
												}
											}
								},
								{
									duration: 800,
									toVars:	{
												ease: 'easeInOutBack',
												css: {
													rotationX: 180,
													rotationY: -30
												}
											}
								}
							]
			}
		];

		var defined_transitions = transitions_2d.concat(transitions_3d);

		if ($.isNumeric(id) && id >= 1 && id <= defined_transitions.length) {
			return defined_transitions[id - 1];
		} else if (id == '2d') {
			return transitions_2d;
		} else if (id == '3d') {
			return transitions_3d;
		} else if (id == 'all') {
			return defined_transitions;
		} else {
			return defined_transitions[0];
		}

		return defined_transitions;
	}

})(jQuery);



/*!
 * VERSION: 1.13.1
 * DATE: 2014-07-19
 * UPDATES AND DOCS AT: http://www.greensock.com
 * 
 * Includes all of the following: TweenLite, TweenMax, TimelineLite, TimelineMax, EasePack, CSSPlugin, RoundPropsPlugin, BezierPlugin, AttrPlugin, DirectionalRotationPlugin
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * This work is subject to the terms at http://www.greensock.com/terms_of_use.html or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 **/
var _gsScope="undefined"!=typeof module&&module.exports&&"undefined"!=typeof global?global:this||window;(_gsScope._gsQueue||(_gsScope._gsQueue=[])).push(function(){"use strict";_gsScope._gsDefine("TweenMax",["core.Animation","core.SimpleTimeline","TweenLite"],function(t,e,i){var s=function(t){var e,i=[],s=t.length;for(e=0;e!==s;i.push(t[e++]));return i},r=function(t,e,s){i.call(this,t,e,s),this._cycle=0,this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._dirty=!0,this.render=r.prototype.render},n=1e-10,a=i._internals,o=a.isSelector,h=a.isArray,l=r.prototype=i.to({},.1,{}),_=[];r.version="1.13.1",l.constructor=r,l.kill()._gc=!1,r.killTweensOf=r.killDelayedCallsTo=i.killTweensOf,r.getTweensOf=i.getTweensOf,r.lagSmoothing=i.lagSmoothing,r.ticker=i.ticker,r.render=i.render,l.invalidate=function(){return this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._uncache(!0),i.prototype.invalidate.call(this)},l.updateTo=function(t,e){var s,r=this.ratio;e&&this._startTime<this._timeline._time&&(this._startTime=this._timeline._time,this._uncache(!1),this._gc?this._enabled(!0,!1):this._timeline.insert(this,this._startTime-this._delay));for(s in t)this.vars[s]=t[s];if(this._initted)if(e)this._initted=!1;else if(this._gc&&this._enabled(!0,!1),this._notifyPluginsOfEnabled&&this._firstPT&&i._onPluginEvent("_onDisable",this),this._time/this._duration>.998){var n=this._time;this.render(0,!0,!1),this._initted=!1,this.render(n,!0,!1)}else if(this._time>0){this._initted=!1,this._init();for(var a,o=1/(1-r),h=this._firstPT;h;)a=h.s+h.c,h.c*=o,h.s=a-h.c,h=h._next}return this},l.render=function(t,e,i){this._initted||0===this._duration&&this.vars.repeat&&this.invalidate();var s,r,o,h,l,u,p,c,f=this._dirty?this.totalDuration():this._totalDuration,m=this._time,d=this._totalTime,g=this._cycle,v=this._duration,y=this._rawPrevTime;if(t>=f?(this._totalTime=f,this._cycle=this._repeat,this._yoyo&&0!==(1&this._cycle)?(this._time=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0):(this._time=v,this.ratio=this._ease._calcEnd?this._ease.getRatio(1):1),this._reversed||(s=!0,r="onComplete"),0===v&&(this._initted||!this.vars.lazy||i)&&(this._startTime===this._timeline._duration&&(t=0),(0===t||0>y||y===n)&&y!==t&&(i=!0,y>n&&(r="onReverseComplete")),this._rawPrevTime=c=!e||t||y===t?t:n)):1e-7>t?(this._totalTime=this._time=this._cycle=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0,(0!==d||0===v&&y>0&&y!==n)&&(r="onReverseComplete",s=this._reversed),0>t?(this._active=!1,0===v&&(this._initted||!this.vars.lazy||i)&&(y>=0&&(i=!0),this._rawPrevTime=c=!e||t||y===t?t:n)):this._initted||(i=!0)):(this._totalTime=this._time=t,0!==this._repeat&&(h=v+this._repeatDelay,this._cycle=this._totalTime/h>>0,0!==this._cycle&&this._cycle===this._totalTime/h&&this._cycle--,this._time=this._totalTime-this._cycle*h,this._yoyo&&0!==(1&this._cycle)&&(this._time=v-this._time),this._time>v?this._time=v:0>this._time&&(this._time=0)),this._easeType?(l=this._time/v,u=this._easeType,p=this._easePower,(1===u||3===u&&l>=.5)&&(l=1-l),3===u&&(l*=2),1===p?l*=l:2===p?l*=l*l:3===p?l*=l*l*l:4===p&&(l*=l*l*l*l),this.ratio=1===u?1-l:2===u?l:.5>this._time/v?l/2:1-l/2):this.ratio=this._ease.getRatio(this._time/v)),m===this._time&&!i&&g===this._cycle)return d!==this._totalTime&&this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||_)),void 0;if(!this._initted){if(this._init(),!this._initted||this._gc)return;if(!i&&this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration))return this._time=m,this._totalTime=d,this._rawPrevTime=y,this._cycle=g,a.lazyTweens.push(this),this._lazy=t,void 0;this._time&&!s?this.ratio=this._ease.getRatio(this._time/v):s&&this._ease._calcEnd&&(this.ratio=this._ease.getRatio(0===this._time?0:1))}for(this._lazy!==!1&&(this._lazy=!1),this._active||!this._paused&&this._time!==m&&t>=0&&(this._active=!0),0===d&&(2===this._initted&&t>0&&this._init(),this._startAt&&(t>=0?this._startAt.render(t,e,i):r||(r="_dummyGS")),this.vars.onStart&&(0!==this._totalTime||0===v)&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||_))),o=this._firstPT;o;)o.f?o.t[o.p](o.c*this.ratio+o.s):o.t[o.p]=o.c*this.ratio+o.s,o=o._next;this._onUpdate&&(0>t&&this._startAt&&this._startTime&&this._startAt.render(t,e,i),e||(this._totalTime!==d||s)&&this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||_)),this._cycle!==g&&(e||this._gc||this.vars.onRepeat&&this.vars.onRepeat.apply(this.vars.onRepeatScope||this,this.vars.onRepeatParams||_)),r&&(!this._gc||i)&&(0>t&&this._startAt&&!this._onUpdate&&this._startTime&&this._startAt.render(t,e,i),s&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[r]&&this.vars[r].apply(this.vars[r+"Scope"]||this,this.vars[r+"Params"]||_),0===v&&this._rawPrevTime===n&&c!==n&&(this._rawPrevTime=0))},r.to=function(t,e,i){return new r(t,e,i)},r.from=function(t,e,i){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,new r(t,e,i)},r.fromTo=function(t,e,i,s){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,new r(t,e,s)},r.staggerTo=r.allTo=function(t,e,n,a,l,u,p){a=a||0;var c,f,m,d,g=n.delay||0,v=[],y=function(){n.onComplete&&n.onComplete.apply(n.onCompleteScope||this,arguments),l.apply(p||this,u||_)};for(h(t)||("string"==typeof t&&(t=i.selector(t)||t),o(t)&&(t=s(t))),c=t.length,m=0;c>m;m++){f={};for(d in n)f[d]=n[d];f.delay=g,m===c-1&&l&&(f.onComplete=y),v[m]=new r(t[m],e,f),g+=a}return v},r.staggerFrom=r.allFrom=function(t,e,i,s,n,a,o){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,r.staggerTo(t,e,i,s,n,a,o)},r.staggerFromTo=r.allFromTo=function(t,e,i,s,n,a,o,h){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,r.staggerTo(t,e,s,n,a,o,h)},r.delayedCall=function(t,e,i,s,n){return new r(e,0,{delay:t,onComplete:e,onCompleteParams:i,onCompleteScope:s,onReverseComplete:e,onReverseCompleteParams:i,onReverseCompleteScope:s,immediateRender:!1,useFrames:n,overwrite:0})},r.set=function(t,e){return new r(t,0,e)},r.isTweening=function(t){return i.getTweensOf(t,!0).length>0};var u=function(t,e){for(var s=[],r=0,n=t._first;n;)n instanceof i?s[r++]=n:(e&&(s[r++]=n),s=s.concat(u(n,e)),r=s.length),n=n._next;return s},p=r.getAllTweens=function(e){return u(t._rootTimeline,e).concat(u(t._rootFramesTimeline,e))};r.killAll=function(t,i,s,r){null==i&&(i=!0),null==s&&(s=!0);var n,a,o,h=p(0!=r),l=h.length,_=i&&s&&r;for(o=0;l>o;o++)a=h[o],(_||a instanceof e||(n=a.target===a.vars.onComplete)&&s||i&&!n)&&(t?a.totalTime(a._reversed?0:a.totalDuration()):a._enabled(!1,!1))},r.killChildTweensOf=function(t,e){if(null!=t){var n,l,_,u,p,c=a.tweenLookup;if("string"==typeof t&&(t=i.selector(t)||t),o(t)&&(t=s(t)),h(t))for(u=t.length;--u>-1;)r.killChildTweensOf(t[u],e);else{n=[];for(_ in c)for(l=c[_].target.parentNode;l;)l===t&&(n=n.concat(c[_].tweens)),l=l.parentNode;for(p=n.length,u=0;p>u;u++)e&&n[u].totalTime(n[u].totalDuration()),n[u]._enabled(!1,!1)}}};var c=function(t,i,s,r){i=i!==!1,s=s!==!1,r=r!==!1;for(var n,a,o=p(r),h=i&&s&&r,l=o.length;--l>-1;)a=o[l],(h||a instanceof e||(n=a.target===a.vars.onComplete)&&s||i&&!n)&&a.paused(t)};return r.pauseAll=function(t,e,i){c(!0,t,e,i)},r.resumeAll=function(t,e,i){c(!1,t,e,i)},r.globalTimeScale=function(e){var s=t._rootTimeline,r=i.ticker.time;return arguments.length?(e=e||n,s._startTime=r-(r-s._startTime)*s._timeScale/e,s=t._rootFramesTimeline,r=i.ticker.frame,s._startTime=r-(r-s._startTime)*s._timeScale/e,s._timeScale=t._rootTimeline._timeScale=e,e):s._timeScale},l.progress=function(t){return arguments.length?this.totalTime(this.duration()*(this._yoyo&&0!==(1&this._cycle)?1-t:t)+this._cycle*(this._duration+this._repeatDelay),!1):this._time/this.duration()},l.totalProgress=function(t){return arguments.length?this.totalTime(this.totalDuration()*t,!1):this._totalTime/this.totalDuration()},l.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),t>this._duration&&(t=this._duration),this._yoyo&&0!==(1&this._cycle)?t=this._duration-t+this._cycle*(this._duration+this._repeatDelay):0!==this._repeat&&(t+=this._cycle*(this._duration+this._repeatDelay)),this.totalTime(t,e)):this._time},l.duration=function(e){return arguments.length?t.prototype.duration.call(this,e):this._duration},l.totalDuration=function(t){return arguments.length?-1===this._repeat?this:this.duration((t-this._repeat*this._repeatDelay)/(this._repeat+1)):(this._dirty&&(this._totalDuration=-1===this._repeat?999999999999:this._duration*(this._repeat+1)+this._repeatDelay*this._repeat,this._dirty=!1),this._totalDuration)},l.repeat=function(t){return arguments.length?(this._repeat=t,this._uncache(!0)):this._repeat},l.repeatDelay=function(t){return arguments.length?(this._repeatDelay=t,this._uncache(!0)):this._repeatDelay},l.yoyo=function(t){return arguments.length?(this._yoyo=t,this):this._yoyo},r},!0),_gsScope._gsDefine("TimelineLite",["core.Animation","core.SimpleTimeline","TweenLite"],function(t,e,i){var s=function(t){e.call(this,t),this._labels={},this.autoRemoveChildren=this.vars.autoRemoveChildren===!0,this.smoothChildTiming=this.vars.smoothChildTiming===!0,this._sortChildren=!0,this._onUpdate=this.vars.onUpdate;var i,s,r=this.vars;for(s in r)i=r[s],o(i)&&-1!==i.join("").indexOf("{self}")&&(r[s]=this._swapSelfInParams(i));o(r.tweens)&&this.add(r.tweens,0,r.align,r.stagger)},r=1e-10,n=i._internals,a=n.isSelector,o=n.isArray,h=n.lazyTweens,l=n.lazyRender,_=[],u=_gsScope._gsDefine.globals,p=function(t){var e,i={};for(e in t)i[e]=t[e];return i},c=function(t,e,i,s){t._timeline.pause(t._startTime),e&&e.apply(s||t._timeline,i||_)},f=function(t){var e,i=[],s=t.length;for(e=0;e!==s;i.push(t[e++]));return i},m=s.prototype=new e;return s.version="1.13.1",m.constructor=s,m.kill()._gc=!1,m.to=function(t,e,s,r){var n=s.repeat&&u.TweenMax||i;return e?this.add(new n(t,e,s),r):this.set(t,s,r)},m.from=function(t,e,s,r){return this.add((s.repeat&&u.TweenMax||i).from(t,e,s),r)},m.fromTo=function(t,e,s,r,n){var a=r.repeat&&u.TweenMax||i;return e?this.add(a.fromTo(t,e,s,r),n):this.set(t,r,n)},m.staggerTo=function(t,e,r,n,o,h,l,_){var u,c=new s({onComplete:h,onCompleteParams:l,onCompleteScope:_,smoothChildTiming:this.smoothChildTiming});for("string"==typeof t&&(t=i.selector(t)||t),a(t)&&(t=f(t)),n=n||0,u=0;t.length>u;u++)r.startAt&&(r.startAt=p(r.startAt)),c.to(t[u],e,p(r),u*n);return this.add(c,o)},m.staggerFrom=function(t,e,i,s,r,n,a,o){return i.immediateRender=0!=i.immediateRender,i.runBackwards=!0,this.staggerTo(t,e,i,s,r,n,a,o)},m.staggerFromTo=function(t,e,i,s,r,n,a,o,h){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,this.staggerTo(t,e,s,r,n,a,o,h)},m.call=function(t,e,s,r){return this.add(i.delayedCall(0,t,e,s),r)},m.set=function(t,e,s){return s=this._parseTimeOrLabel(s,0,!0),null==e.immediateRender&&(e.immediateRender=s===this._time&&!this._paused),this.add(new i(t,0,e),s)},s.exportRoot=function(t,e){t=t||{},null==t.smoothChildTiming&&(t.smoothChildTiming=!0);var r,n,a=new s(t),o=a._timeline;for(null==e&&(e=!0),o._remove(a,!0),a._startTime=0,a._rawPrevTime=a._time=a._totalTime=o._time,r=o._first;r;)n=r._next,e&&r instanceof i&&r.target===r.vars.onComplete||a.add(r,r._startTime-r._delay),r=n;return o.add(a,0),a},m.add=function(r,n,a,h){var l,_,u,p,c,f;if("number"!=typeof n&&(n=this._parseTimeOrLabel(n,0,!0,r)),!(r instanceof t)){if(r instanceof Array||r&&r.push&&o(r)){for(a=a||"normal",h=h||0,l=n,_=r.length,u=0;_>u;u++)o(p=r[u])&&(p=new s({tweens:p})),this.add(p,l),"string"!=typeof p&&"function"!=typeof p&&("sequence"===a?l=p._startTime+p.totalDuration()/p._timeScale:"start"===a&&(p._startTime-=p.delay())),l+=h;return this._uncache(!0)}if("string"==typeof r)return this.addLabel(r,n);if("function"!=typeof r)throw"Cannot add "+r+" into the timeline; it is not a tween, timeline, function, or string.";r=i.delayedCall(0,r)}if(e.prototype.add.call(this,r,n),(this._gc||this._time===this._duration)&&!this._paused&&this._duration<this.duration())for(c=this,f=c.rawTime()>r._startTime;c._timeline;)f&&c._timeline.smoothChildTiming?c.totalTime(c._totalTime,!0):c._gc&&c._enabled(!0,!1),c=c._timeline;return this},m.remove=function(e){if(e instanceof t)return this._remove(e,!1);if(e instanceof Array||e&&e.push&&o(e)){for(var i=e.length;--i>-1;)this.remove(e[i]);return this}return"string"==typeof e?this.removeLabel(e):this.kill(null,e)},m._remove=function(t,i){e.prototype._remove.call(this,t,i);var s=this._last;return s?this._time>s._startTime+s._totalDuration/s._timeScale&&(this._time=this.duration(),this._totalTime=this._totalDuration):this._time=this._totalTime=this._duration=this._totalDuration=0,this},m.append=function(t,e){return this.add(t,this._parseTimeOrLabel(null,e,!0,t))},m.insert=m.insertMultiple=function(t,e,i,s){return this.add(t,e||0,i,s)},m.appendMultiple=function(t,e,i,s){return this.add(t,this._parseTimeOrLabel(null,e,!0,t),i,s)},m.addLabel=function(t,e){return this._labels[t]=this._parseTimeOrLabel(e),this},m.addPause=function(t,e,i,s){return this.call(c,["{self}",e,i,s],this,t)},m.removeLabel=function(t){return delete this._labels[t],this},m.getLabelTime=function(t){return null!=this._labels[t]?this._labels[t]:-1},m._parseTimeOrLabel=function(e,i,s,r){var n;if(r instanceof t&&r.timeline===this)this.remove(r);else if(r&&(r instanceof Array||r.push&&o(r)))for(n=r.length;--n>-1;)r[n]instanceof t&&r[n].timeline===this&&this.remove(r[n]);if("string"==typeof i)return this._parseTimeOrLabel(i,s&&"number"==typeof e&&null==this._labels[i]?e-this.duration():0,s);if(i=i||0,"string"!=typeof e||!isNaN(e)&&null==this._labels[e])null==e&&(e=this.duration());else{if(n=e.indexOf("="),-1===n)return null==this._labels[e]?s?this._labels[e]=this.duration()+i:i:this._labels[e]+i;i=parseInt(e.charAt(n-1)+"1",10)*Number(e.substr(n+1)),e=n>1?this._parseTimeOrLabel(e.substr(0,n-1),0,s):this.duration()}return Number(e)+i},m.seek=function(t,e){return this.totalTime("number"==typeof t?t:this._parseTimeOrLabel(t),e!==!1)},m.stop=function(){return this.paused(!0)},m.gotoAndPlay=function(t,e){return this.play(t,e)},m.gotoAndStop=function(t,e){return this.pause(t,e)},m.render=function(t,e,i){this._gc&&this._enabled(!0,!1);var s,n,a,o,u,p=this._dirty?this.totalDuration():this._totalDuration,c=this._time,f=this._startTime,m=this._timeScale,d=this._paused;if(t>=p?(this._totalTime=this._time=p,this._reversed||this._hasPausedChild()||(n=!0,o="onComplete",0===this._duration&&(0===t||0>this._rawPrevTime||this._rawPrevTime===r)&&this._rawPrevTime!==t&&this._first&&(u=!0,this._rawPrevTime>r&&(o="onReverseComplete"))),this._rawPrevTime=this._duration||!e||t||this._rawPrevTime===t?t:r,t=p+1e-4):1e-7>t?(this._totalTime=this._time=0,(0!==c||0===this._duration&&this._rawPrevTime!==r&&(this._rawPrevTime>0||0>t&&this._rawPrevTime>=0))&&(o="onReverseComplete",n=this._reversed),0>t?(this._active=!1,this._rawPrevTime>=0&&this._first&&(u=!0),this._rawPrevTime=t):(this._rawPrevTime=this._duration||!e||t||this._rawPrevTime===t?t:r,t=0,this._initted||(u=!0))):this._totalTime=this._time=this._rawPrevTime=t,this._time!==c&&this._first||i||u){if(this._initted||(this._initted=!0),this._active||!this._paused&&this._time!==c&&t>0&&(this._active=!0),0===c&&this.vars.onStart&&0!==this._time&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||_)),this._time>=c)for(s=this._first;s&&(a=s._next,!this._paused||d);)(s._active||s._startTime<=this._time&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=a;else for(s=this._last;s&&(a=s._prev,!this._paused||d);)(s._active||c>=s._startTime&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=a;this._onUpdate&&(e||(h.length&&l(),this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||_))),o&&(this._gc||(f===this._startTime||m!==this._timeScale)&&(0===this._time||p>=this.totalDuration())&&(n&&(h.length&&l(),this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[o]&&this.vars[o].apply(this.vars[o+"Scope"]||this,this.vars[o+"Params"]||_)))}},m._hasPausedChild=function(){for(var t=this._first;t;){if(t._paused||t instanceof s&&t._hasPausedChild())return!0;t=t._next}return!1},m.getChildren=function(t,e,s,r){r=r||-9999999999;for(var n=[],a=this._first,o=0;a;)r>a._startTime||(a instanceof i?e!==!1&&(n[o++]=a):(s!==!1&&(n[o++]=a),t!==!1&&(n=n.concat(a.getChildren(!0,e,s)),o=n.length))),a=a._next;return n},m.getTweensOf=function(t,e){var s,r,n=this._gc,a=[],o=0;for(n&&this._enabled(!0,!0),s=i.getTweensOf(t),r=s.length;--r>-1;)(s[r].timeline===this||e&&this._contains(s[r]))&&(a[o++]=s[r]);return n&&this._enabled(!1,!0),a},m._contains=function(t){for(var e=t.timeline;e;){if(e===this)return!0;e=e.timeline}return!1},m.shiftChildren=function(t,e,i){i=i||0;for(var s,r=this._first,n=this._labels;r;)r._startTime>=i&&(r._startTime+=t),r=r._next;if(e)for(s in n)n[s]>=i&&(n[s]+=t);return this._uncache(!0)},m._kill=function(t,e){if(!t&&!e)return this._enabled(!1,!1);for(var i=e?this.getTweensOf(e):this.getChildren(!0,!0,!1),s=i.length,r=!1;--s>-1;)i[s]._kill(t,e)&&(r=!0);return r},m.clear=function(t){var e=this.getChildren(!1,!0,!0),i=e.length;for(this._time=this._totalTime=0;--i>-1;)e[i]._enabled(!1,!1);return t!==!1&&(this._labels={}),this._uncache(!0)},m.invalidate=function(){for(var t=this._first;t;)t.invalidate(),t=t._next;return this},m._enabled=function(t,i){if(t===this._gc)for(var s=this._first;s;)s._enabled(t,!0),s=s._next;return e.prototype._enabled.call(this,t,i)},m.duration=function(t){return arguments.length?(0!==this.duration()&&0!==t&&this.timeScale(this._duration/t),this):(this._dirty&&this.totalDuration(),this._duration)},m.totalDuration=function(t){if(!arguments.length){if(this._dirty){for(var e,i,s=0,r=this._last,n=999999999999;r;)e=r._prev,r._dirty&&r.totalDuration(),r._startTime>n&&this._sortChildren&&!r._paused?this.add(r,r._startTime-r._delay):n=r._startTime,0>r._startTime&&!r._paused&&(s-=r._startTime,this._timeline.smoothChildTiming&&(this._startTime+=r._startTime/this._timeScale),this.shiftChildren(-r._startTime,!1,-9999999999),n=0),i=r._startTime+r._totalDuration/r._timeScale,i>s&&(s=i),r=e;this._duration=this._totalDuration=s,this._dirty=!1}return this._totalDuration}return 0!==this.totalDuration()&&0!==t&&this.timeScale(this._totalDuration/t),this},m.usesFrames=function(){for(var e=this._timeline;e._timeline;)e=e._timeline;return e===t._rootFramesTimeline},m.rawTime=function(){return this._paused?this._totalTime:(this._timeline.rawTime()-this._startTime)*this._timeScale},s},!0),_gsScope._gsDefine("TimelineMax",["TimelineLite","TweenLite","easing.Ease"],function(t,e,i){var s=function(e){t.call(this,e),this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._cycle=0,this._yoyo=this.vars.yoyo===!0,this._dirty=!0},r=1e-10,n=[],a=e._internals,o=a.lazyTweens,h=a.lazyRender,l=new i(null,null,1,0),_=s.prototype=new t;return _.constructor=s,_.kill()._gc=!1,s.version="1.13.1",_.invalidate=function(){return this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._uncache(!0),t.prototype.invalidate.call(this)},_.addCallback=function(t,i,s,r){return this.add(e.delayedCall(0,t,s,r),i)},_.removeCallback=function(t,e){if(t)if(null==e)this._kill(null,t);else for(var i=this.getTweensOf(t,!1),s=i.length,r=this._parseTimeOrLabel(e);--s>-1;)i[s]._startTime===r&&i[s]._enabled(!1,!1);return this},_.tweenTo=function(t,i){i=i||{};var s,r,a,o={ease:l,overwrite:i.delay?2:1,useFrames:this.usesFrames(),immediateRender:!1};for(r in i)o[r]=i[r];return o.time=this._parseTimeOrLabel(t),s=Math.abs(Number(o.time)-this._time)/this._timeScale||.001,a=new e(this,s,o),o.onStart=function(){a.target.paused(!0),a.vars.time!==a.target.time()&&s===a.duration()&&a.duration(Math.abs(a.vars.time-a.target.time())/a.target._timeScale),i.onStart&&i.onStart.apply(i.onStartScope||a,i.onStartParams||n)},a},_.tweenFromTo=function(t,e,i){i=i||{},t=this._parseTimeOrLabel(t),i.startAt={onComplete:this.seek,onCompleteParams:[t],onCompleteScope:this},i.immediateRender=i.immediateRender!==!1;var s=this.tweenTo(e,i);return s.duration(Math.abs(s.vars.time-t)/this._timeScale||.001)},_.render=function(t,e,i){this._gc&&this._enabled(!0,!1);var s,a,l,_,u,p,c=this._dirty?this.totalDuration():this._totalDuration,f=this._duration,m=this._time,d=this._totalTime,g=this._startTime,v=this._timeScale,y=this._rawPrevTime,T=this._paused,w=this._cycle;if(t>=c?(this._locked||(this._totalTime=c,this._cycle=this._repeat),this._reversed||this._hasPausedChild()||(a=!0,_="onComplete",0===this._duration&&(0===t||0>y||y===r)&&y!==t&&this._first&&(u=!0,y>r&&(_="onReverseComplete"))),this._rawPrevTime=this._duration||!e||t||this._rawPrevTime===t?t:r,this._yoyo&&0!==(1&this._cycle)?this._time=t=0:(this._time=f,t=f+1e-4)):1e-7>t?(this._locked||(this._totalTime=this._cycle=0),this._time=0,(0!==m||0===f&&y!==r&&(y>0||0>t&&y>=0)&&!this._locked)&&(_="onReverseComplete",a=this._reversed),0>t?(this._active=!1,y>=0&&this._first&&(u=!0),this._rawPrevTime=t):(this._rawPrevTime=f||!e||t||this._rawPrevTime===t?t:r,t=0,this._initted||(u=!0))):(0===f&&0>y&&(u=!0),this._time=this._rawPrevTime=t,this._locked||(this._totalTime=t,0!==this._repeat&&(p=f+this._repeatDelay,this._cycle=this._totalTime/p>>0,0!==this._cycle&&this._cycle===this._totalTime/p&&this._cycle--,this._time=this._totalTime-this._cycle*p,this._yoyo&&0!==(1&this._cycle)&&(this._time=f-this._time),this._time>f?(this._time=f,t=f+1e-4):0>this._time?this._time=t=0:t=this._time))),this._cycle!==w&&!this._locked){var x=this._yoyo&&0!==(1&w),b=x===(this._yoyo&&0!==(1&this._cycle)),P=this._totalTime,S=this._cycle,k=this._rawPrevTime,R=this._time;if(this._totalTime=w*f,w>this._cycle?x=!x:this._totalTime+=f,this._time=m,this._rawPrevTime=0===f?y-1e-4:y,this._cycle=w,this._locked=!0,m=x?0:f,this.render(m,e,0===f),e||this._gc||this.vars.onRepeat&&this.vars.onRepeat.apply(this.vars.onRepeatScope||this,this.vars.onRepeatParams||n),b&&(m=x?f+1e-4:-1e-4,this.render(m,!0,!1)),this._locked=!1,this._paused&&!T)return;this._time=R,this._totalTime=P,this._cycle=S,this._rawPrevTime=k}if(!(this._time!==m&&this._first||i||u))return d!==this._totalTime&&this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||n)),void 0;if(this._initted||(this._initted=!0),this._active||!this._paused&&this._totalTime!==d&&t>0&&(this._active=!0),0===d&&this.vars.onStart&&0!==this._totalTime&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||n)),this._time>=m)for(s=this._first;s&&(l=s._next,!this._paused||T);)(s._active||s._startTime<=this._time&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=l;else for(s=this._last;s&&(l=s._prev,!this._paused||T);)(s._active||m>=s._startTime&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=l;this._onUpdate&&(e||(o.length&&h(),this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||n))),_&&(this._locked||this._gc||(g===this._startTime||v!==this._timeScale)&&(0===this._time||c>=this.totalDuration())&&(a&&(o.length&&h(),this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[_]&&this.vars[_].apply(this.vars[_+"Scope"]||this,this.vars[_+"Params"]||n)))},_.getActive=function(t,e,i){null==t&&(t=!0),null==e&&(e=!0),null==i&&(i=!1);var s,r,n=[],a=this.getChildren(t,e,i),o=0,h=a.length;for(s=0;h>s;s++)r=a[s],r.isActive()&&(n[o++]=r);return n},_.getLabelAfter=function(t){t||0!==t&&(t=this._time);var e,i=this.getLabelsArray(),s=i.length;for(e=0;s>e;e++)if(i[e].time>t)return i[e].name;return null},_.getLabelBefore=function(t){null==t&&(t=this._time);for(var e=this.getLabelsArray(),i=e.length;--i>-1;)if(t>e[i].time)return e[i].name;return null},_.getLabelsArray=function(){var t,e=[],i=0;for(t in this._labels)e[i++]={time:this._labels[t],name:t};return e.sort(function(t,e){return t.time-e.time}),e},_.progress=function(t){return arguments.length?this.totalTime(this.duration()*(this._yoyo&&0!==(1&this._cycle)?1-t:t)+this._cycle*(this._duration+this._repeatDelay),!1):this._time/this.duration()},_.totalProgress=function(t){return arguments.length?this.totalTime(this.totalDuration()*t,!1):this._totalTime/this.totalDuration()},_.totalDuration=function(e){return arguments.length?-1===this._repeat?this:this.duration((e-this._repeat*this._repeatDelay)/(this._repeat+1)):(this._dirty&&(t.prototype.totalDuration.call(this),this._totalDuration=-1===this._repeat?999999999999:this._duration*(this._repeat+1)+this._repeatDelay*this._repeat),this._totalDuration)},_.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),t>this._duration&&(t=this._duration),this._yoyo&&0!==(1&this._cycle)?t=this._duration-t+this._cycle*(this._duration+this._repeatDelay):0!==this._repeat&&(t+=this._cycle*(this._duration+this._repeatDelay)),this.totalTime(t,e)):this._time},_.repeat=function(t){return arguments.length?(this._repeat=t,this._uncache(!0)):this._repeat},_.repeatDelay=function(t){return arguments.length?(this._repeatDelay=t,this._uncache(!0)):this._repeatDelay},_.yoyo=function(t){return arguments.length?(this._yoyo=t,this):this._yoyo},_.currentLabel=function(t){return arguments.length?this.seek(t,!0):this.getLabelBefore(this._time+1e-8)},s},!0),function(){var t=180/Math.PI,e=[],i=[],s=[],r={},n=function(t,e,i,s){this.a=t,this.b=e,this.c=i,this.d=s,this.da=s-t,this.ca=i-t,this.ba=e-t},a=",x,y,z,left,top,right,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,",o=function(t,e,i,s){var r={a:t},n={},a={},o={c:s},h=(t+e)/2,l=(e+i)/2,_=(i+s)/2,u=(h+l)/2,p=(l+_)/2,c=(p-u)/8;return r.b=h+(t-h)/4,n.b=u+c,r.c=n.a=(r.b+n.b)/2,n.c=a.a=(u+p)/2,a.b=p-c,o.b=_+(s-_)/4,a.c=o.a=(a.b+o.b)/2,[r,n,a,o]},h=function(t,r,n,a,h){var l,_,u,p,c,f,m,d,g,v,y,T,w,x=t.length-1,b=0,P=t[0].a;for(l=0;x>l;l++)c=t[b],_=c.a,u=c.d,p=t[b+1].d,h?(y=e[l],T=i[l],w=.25*(T+y)*r/(a?.5:s[l]||.5),f=u-(u-_)*(a?.5*r:0!==y?w/y:0),m=u+(p-u)*(a?.5*r:0!==T?w/T:0),d=u-(f+((m-f)*(3*y/(y+T)+.5)/4||0))):(f=u-.5*(u-_)*r,m=u+.5*(p-u)*r,d=u-(f+m)/2),f+=d,m+=d,c.c=g=f,c.b=0!==l?P:P=c.a+.6*(c.c-c.a),c.da=u-_,c.ca=g-_,c.ba=P-_,n?(v=o(_,P,g,u),t.splice(b,1,v[0],v[1],v[2],v[3]),b+=4):b++,P=m;c=t[b],c.b=P,c.c=P+.4*(c.d-P),c.da=c.d-c.a,c.ca=c.c-c.a,c.ba=P-c.a,n&&(v=o(c.a,P,c.c,c.d),t.splice(b,1,v[0],v[1],v[2],v[3]))},l=function(t,s,r,a){var o,h,l,_,u,p,c=[];if(a)for(t=[a].concat(t),h=t.length;--h>-1;)"string"==typeof(p=t[h][s])&&"="===p.charAt(1)&&(t[h][s]=a[s]+Number(p.charAt(0)+p.substr(2)));if(o=t.length-2,0>o)return c[0]=new n(t[0][s],0,0,t[-1>o?0:1][s]),c;for(h=0;o>h;h++)l=t[h][s],_=t[h+1][s],c[h]=new n(l,0,0,_),r&&(u=t[h+2][s],e[h]=(e[h]||0)+(_-l)*(_-l),i[h]=(i[h]||0)+(u-_)*(u-_));return c[h]=new n(t[h][s],0,0,t[h+1][s]),c},_=function(t,n,o,_,u,p){var c,f,m,d,g,v,y,T,w={},x=[],b=p||t[0];u="string"==typeof u?","+u+",":a,null==n&&(n=1);for(f in t[0])x.push(f);if(t.length>1){for(T=t[t.length-1],y=!0,c=x.length;--c>-1;)if(f=x[c],Math.abs(b[f]-T[f])>.05){y=!1;break}y&&(t=t.concat(),p&&t.unshift(p),t.push(t[1]),p=t[t.length-3])}for(e.length=i.length=s.length=0,c=x.length;--c>-1;)f=x[c],r[f]=-1!==u.indexOf(","+f+","),w[f]=l(t,f,r[f],p);for(c=e.length;--c>-1;)e[c]=Math.sqrt(e[c]),i[c]=Math.sqrt(i[c]);if(!_){for(c=x.length;--c>-1;)if(r[f])for(m=w[x[c]],v=m.length-1,d=0;v>d;d++)g=m[d+1].da/i[d]+m[d].da/e[d],s[d]=(s[d]||0)+g*g;for(c=s.length;--c>-1;)s[c]=Math.sqrt(s[c])}for(c=x.length,d=o?4:1;--c>-1;)f=x[c],m=w[f],h(m,n,o,_,r[f]),y&&(m.splice(0,d),m.splice(m.length-d,d));return w},u=function(t,e,i){e=e||"soft";var s,r,a,o,h,l,_,u,p,c,f,m={},d="cubic"===e?3:2,g="soft"===e,v=[];if(g&&i&&(t=[i].concat(t)),null==t||d+1>t.length)throw"invalid Bezier data";for(p in t[0])v.push(p);for(l=v.length;--l>-1;){for(p=v[l],m[p]=h=[],c=0,u=t.length,_=0;u>_;_++)s=null==i?t[_][p]:"string"==typeof(f=t[_][p])&&"="===f.charAt(1)?i[p]+Number(f.charAt(0)+f.substr(2)):Number(f),g&&_>1&&u-1>_&&(h[c++]=(s+h[c-2])/2),h[c++]=s;for(u=c-d+1,c=0,_=0;u>_;_+=d)s=h[_],r=h[_+1],a=h[_+2],o=2===d?0:h[_+3],h[c++]=f=3===d?new n(s,r,a,o):new n(s,(2*r+s)/3,(2*r+a)/3,a);h.length=c}return m},p=function(t,e,i){for(var s,r,n,a,o,h,l,_,u,p,c,f=1/i,m=t.length;--m>-1;)for(p=t[m],n=p.a,a=p.d-n,o=p.c-n,h=p.b-n,s=r=0,_=1;i>=_;_++)l=f*_,u=1-l,s=r-(r=(l*l*a+3*u*(l*o+u*h))*l),c=m*i+_-1,e[c]=(e[c]||0)+s*s},c=function(t,e){e=e>>0||6;var i,s,r,n,a=[],o=[],h=0,l=0,_=e-1,u=[],c=[];for(i in t)p(t[i],a,e);for(r=a.length,s=0;r>s;s++)h+=Math.sqrt(a[s]),n=s%e,c[n]=h,n===_&&(l+=h,n=s/e>>0,u[n]=c,o[n]=l,h=0,c=[]);return{length:l,lengths:o,segments:u}},f=_gsScope._gsDefine.plugin({propName:"bezier",priority:-1,version:"1.3.3",API:2,global:!0,init:function(t,e,i){this._target=t,e instanceof Array&&(e={values:e}),this._func={},this._round={},this._props=[],this._timeRes=null==e.timeResolution?6:parseInt(e.timeResolution,10);var s,r,n,a,o,h=e.values||[],l={},p=h[0],f=e.autoRotate||i.vars.orientToBezier;this._autoRotate=f?f instanceof Array?f:[["x","y","rotation",f===!0?0:Number(f)||0]]:null;for(s in p)this._props.push(s);for(n=this._props.length;--n>-1;)s=this._props[n],this._overwriteProps.push(s),r=this._func[s]="function"==typeof t[s],l[s]=r?t[s.indexOf("set")||"function"!=typeof t["get"+s.substr(3)]?s:"get"+s.substr(3)]():parseFloat(t[s]),o||l[s]!==h[0][s]&&(o=l);if(this._beziers="cubic"!==e.type&&"quadratic"!==e.type&&"soft"!==e.type?_(h,isNaN(e.curviness)?1:e.curviness,!1,"thruBasic"===e.type,e.correlate,o):u(h,e.type,l),this._segCount=this._beziers[s].length,this._timeRes){var m=c(this._beziers,this._timeRes);this._length=m.length,this._lengths=m.lengths,this._segments=m.segments,this._l1=this._li=this._s1=this._si=0,this._l2=this._lengths[0],this._curSeg=this._segments[0],this._s2=this._curSeg[0],this._prec=1/this._curSeg.length}if(f=this._autoRotate)for(this._initialRotations=[],f[0]instanceof Array||(this._autoRotate=f=[f]),n=f.length;--n>-1;){for(a=0;3>a;a++)s=f[n][a],this._func[s]="function"==typeof t[s]?t[s.indexOf("set")||"function"!=typeof t["get"+s.substr(3)]?s:"get"+s.substr(3)]:!1;s=f[n][2],this._initialRotations[n]=this._func[s]?this._func[s].call(this._target):this._target[s]}return this._startRatio=i.vars.runBackwards?1:0,!0},set:function(e){var i,s,r,n,a,o,h,l,_,u,p=this._segCount,c=this._func,f=this._target,m=e!==this._startRatio;if(this._timeRes){if(_=this._lengths,u=this._curSeg,e*=this._length,r=this._li,e>this._l2&&p-1>r){for(l=p-1;l>r&&e>=(this._l2=_[++r]););this._l1=_[r-1],this._li=r,this._curSeg=u=this._segments[r],this._s2=u[this._s1=this._si=0]}else if(this._l1>e&&r>0){for(;r>0&&(this._l1=_[--r])>=e;);0===r&&this._l1>e?this._l1=0:r++,this._l2=_[r],this._li=r,this._curSeg=u=this._segments[r],this._s1=u[(this._si=u.length-1)-1]||0,this._s2=u[this._si]}if(i=r,e-=this._l1,r=this._si,e>this._s2&&u.length-1>r){for(l=u.length-1;l>r&&e>=(this._s2=u[++r]););this._s1=u[r-1],this._si=r}else if(this._s1>e&&r>0){for(;r>0&&(this._s1=u[--r])>=e;);0===r&&this._s1>e?this._s1=0:r++,this._s2=u[r],this._si=r}o=(r+(e-this._s1)/(this._s2-this._s1))*this._prec}else i=0>e?0:e>=1?p-1:p*e>>0,o=(e-i*(1/p))*p;for(s=1-o,r=this._props.length;--r>-1;)n=this._props[r],a=this._beziers[n][i],h=(o*o*a.da+3*s*(o*a.ca+s*a.ba))*o+a.a,this._round[n]&&(h=Math.round(h)),c[n]?f[n](h):f[n]=h;if(this._autoRotate){var d,g,v,y,T,w,x,b=this._autoRotate;
for(r=b.length;--r>-1;)n=b[r][2],w=b[r][3]||0,x=b[r][4]===!0?1:t,a=this._beziers[b[r][0]],d=this._beziers[b[r][1]],a&&d&&(a=a[i],d=d[i],g=a.a+(a.b-a.a)*o,y=a.b+(a.c-a.b)*o,g+=(y-g)*o,y+=(a.c+(a.d-a.c)*o-y)*o,v=d.a+(d.b-d.a)*o,T=d.b+(d.c-d.b)*o,v+=(T-v)*o,T+=(d.c+(d.d-d.c)*o-T)*o,h=m?Math.atan2(T-v,y-g)*x+w:this._initialRotations[r],c[n]?f[n](h):f[n]=h)}}}),m=f.prototype;f.bezierThrough=_,f.cubicToQuadratic=o,f._autoCSS=!0,f.quadraticToCubic=function(t,e,i){return new n(t,(2*e+t)/3,(2*e+i)/3,i)},f._cssRegister=function(){var t=_gsScope._gsDefine.globals.CSSPlugin;if(t){var e=t._internals,i=e._parseToProxy,s=e._setPluginRatio,r=e.CSSPropTween;e._registerComplexSpecialProp("bezier",{parser:function(t,e,n,a,o,h){e instanceof Array&&(e={values:e}),h=new f;var l,_,u,p=e.values,c=p.length-1,m=[],d={};if(0>c)return o;for(l=0;c>=l;l++)u=i(t,p[l],a,o,h,c!==l),m[l]=u.end;for(_ in e)d[_]=e[_];return d.values=m,o=new r(t,"bezier",0,0,u.pt,2),o.data=u,o.plugin=h,o.setRatio=s,0===d.autoRotate&&(d.autoRotate=!0),!d.autoRotate||d.autoRotate instanceof Array||(l=d.autoRotate===!0?0:Number(d.autoRotate),d.autoRotate=null!=u.end.left?[["left","top","rotation",l,!1]]:null!=u.end.x?[["x","y","rotation",l,!1]]:!1),d.autoRotate&&(a._transform||a._enableTransforms(!1),u.autoRotate=a._target._gsTransform),h._onInitTween(u.proxy,d,a._tween),o}})}},m._roundProps=function(t,e){for(var i=this._overwriteProps,s=i.length;--s>-1;)(t[i[s]]||t.bezier||t.bezierThrough)&&(this._round[i[s]]=e)},m._kill=function(t){var e,i,s=this._props;for(e in this._beziers)if(e in t)for(delete this._beziers[e],delete this._func[e],i=s.length;--i>-1;)s[i]===e&&s.splice(i,1);return this._super._kill.call(this,t)}}(),_gsScope._gsDefine("plugins.CSSPlugin",["plugins.TweenPlugin","TweenLite"],function(t,e){var i,s,r,n,a=function(){t.call(this,"css"),this._overwriteProps.length=0,this.setRatio=a.prototype.setRatio},o={},h=a.prototype=new t("css");h.constructor=a,a.version="1.13.1",a.API=2,a.defaultTransformPerspective=0,a.defaultSkewType="compensated",h="px",a.suffixMap={top:h,right:h,bottom:h,left:h,width:h,height:h,fontSize:h,padding:h,margin:h,perspective:h,lineHeight:""};var l,_,u,p,c,f,m=/(?:\d|\-\d|\.\d|\-\.\d)+/g,d=/(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,g=/(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi,v=/[^\d\-\.]/g,y=/(?:\d|\-|\+|=|#|\.)*/g,T=/opacity *= *([^)]*)/i,w=/opacity:([^;]*)/i,x=/alpha\(opacity *=.+?\)/i,b=/^(rgb|hsl)/,P=/([A-Z])/g,S=/-([a-z])/gi,k=/(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi,R=function(t,e){return e.toUpperCase()},A=/(?:Left|Right|Width)/i,C=/(M11|M12|M21|M22)=[\d\-\.e]+/gi,O=/progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i,D=/,(?=[^\)]*(?:\(|$))/gi,M=Math.PI/180,z=180/Math.PI,I={},E=document,L=E.createElement("div"),F=E.createElement("img"),N=a._internals={_specialProps:o},X=navigator.userAgent,U=function(){var t,e=X.indexOf("Android"),i=E.createElement("div");return u=-1!==X.indexOf("Safari")&&-1===X.indexOf("Chrome")&&(-1===e||Number(X.substr(e+8,1))>3),c=u&&6>Number(X.substr(X.indexOf("Version/")+8,1)),p=-1!==X.indexOf("Firefox"),/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(X)&&(f=parseFloat(RegExp.$1)),i.innerHTML="<a style='top:1px;opacity:.55;'>a</a>",t=i.getElementsByTagName("a")[0],t?/^0.55/.test(t.style.opacity):!1}(),Y=function(t){return T.test("string"==typeof t?t:(t.currentStyle?t.currentStyle.filter:t.style.filter)||"")?parseFloat(RegExp.$1)/100:1},j=function(t){window.console&&console.log(t)},B="",q="",V=function(t,e){e=e||L;var i,s,r=e.style;if(void 0!==r[t])return t;for(t=t.charAt(0).toUpperCase()+t.substr(1),i=["O","Moz","ms","Ms","Webkit"],s=5;--s>-1&&void 0===r[i[s]+t];);return s>=0?(q=3===s?"ms":i[s],B="-"+q.toLowerCase()+"-",q+t):null},G=E.defaultView?E.defaultView.getComputedStyle:function(){},W=a.getStyle=function(t,e,i,s,r){var n;return U||"opacity"!==e?(!s&&t.style[e]?n=t.style[e]:(i=i||G(t))?n=i[e]||i.getPropertyValue(e)||i.getPropertyValue(e.replace(P,"-$1").toLowerCase()):t.currentStyle&&(n=t.currentStyle[e]),null==r||n&&"none"!==n&&"auto"!==n&&"auto auto"!==n?n:r):Y(t)},Q=N.convertToPixels=function(t,i,s,r,n){if("px"===r||!r)return s;if("auto"===r||!s)return 0;var o,h,l,_=A.test(i),u=t,p=L.style,c=0>s;if(c&&(s=-s),"%"===r&&-1!==i.indexOf("border"))o=s/100*(_?t.clientWidth:t.clientHeight);else{if(p.cssText="border:0 solid red;position:"+W(t,"position")+";line-height:0;","%"!==r&&u.appendChild)p[_?"borderLeftWidth":"borderTopWidth"]=s+r;else{if(u=t.parentNode||E.body,h=u._gsCache,l=e.ticker.frame,h&&_&&h.time===l)return h.width*s/100;p[_?"width":"height"]=s+r}u.appendChild(L),o=parseFloat(L[_?"offsetWidth":"offsetHeight"]),u.removeChild(L),_&&"%"===r&&a.cacheWidths!==!1&&(h=u._gsCache=u._gsCache||{},h.time=l,h.width=100*(o/s)),0!==o||n||(o=Q(t,i,s,r,!0))}return c?-o:o},Z=N.calculateOffset=function(t,e,i){if("absolute"!==W(t,"position",i))return 0;var s="left"===e?"Left":"Top",r=W(t,"margin"+s,i);return t["offset"+s]-(Q(t,e,parseFloat(r),r.replace(y,""))||0)},$=function(t,e){var i,s,r={};if(e=e||G(t,null))if(i=e.length)for(;--i>-1;)r[e[i].replace(S,R)]=e.getPropertyValue(e[i]);else for(i in e)r[i]=e[i];else if(e=t.currentStyle||t.style)for(i in e)"string"==typeof i&&void 0===r[i]&&(r[i.replace(S,R)]=e[i]);return U||(r.opacity=Y(t)),s=Pe(t,e,!1),r.rotation=s.rotation,r.skewX=s.skewX,r.scaleX=s.scaleX,r.scaleY=s.scaleY,r.x=s.x,r.y=s.y,xe&&(r.z=s.z,r.rotationX=s.rotationX,r.rotationY=s.rotationY,r.scaleZ=s.scaleZ),r.filters&&delete r.filters,r},H=function(t,e,i,s,r){var n,a,o,h={},l=t.style;for(a in i)"cssText"!==a&&"length"!==a&&isNaN(a)&&(e[a]!==(n=i[a])||r&&r[a])&&-1===a.indexOf("Origin")&&("number"==typeof n||"string"==typeof n)&&(h[a]="auto"!==n||"left"!==a&&"top"!==a?""!==n&&"auto"!==n&&"none"!==n||"string"!=typeof e[a]||""===e[a].replace(v,"")?n:0:Z(t,a),void 0!==l[a]&&(o=new ue(l,a,l[a],o)));if(s)for(a in s)"className"!==a&&(h[a]=s[a]);return{difs:h,firstMPT:o}},K={width:["Left","Right"],height:["Top","Bottom"]},J=["marginLeft","marginRight","marginTop","marginBottom"],te=function(t,e,i){var s=parseFloat("width"===e?t.offsetWidth:t.offsetHeight),r=K[e],n=r.length;for(i=i||G(t,null);--n>-1;)s-=parseFloat(W(t,"padding"+r[n],i,!0))||0,s-=parseFloat(W(t,"border"+r[n]+"Width",i,!0))||0;return s},ee=function(t,e){(null==t||""===t||"auto"===t||"auto auto"===t)&&(t="0 0");var i=t.split(" "),s=-1!==t.indexOf("left")?"0%":-1!==t.indexOf("right")?"100%":i[0],r=-1!==t.indexOf("top")?"0%":-1!==t.indexOf("bottom")?"100%":i[1];return null==r?r="0":"center"===r&&(r="50%"),("center"===s||isNaN(parseFloat(s))&&-1===(s+"").indexOf("="))&&(s="50%"),e&&(e.oxp=-1!==s.indexOf("%"),e.oyp=-1!==r.indexOf("%"),e.oxr="="===s.charAt(1),e.oyr="="===r.charAt(1),e.ox=parseFloat(s.replace(v,"")),e.oy=parseFloat(r.replace(v,""))),s+" "+r+(i.length>2?" "+i[2]:"")},ie=function(t,e){return"string"==typeof t&&"="===t.charAt(1)?parseInt(t.charAt(0)+"1",10)*parseFloat(t.substr(2)):parseFloat(t)-parseFloat(e)},se=function(t,e){return null==t?e:"string"==typeof t&&"="===t.charAt(1)?parseInt(t.charAt(0)+"1",10)*Number(t.substr(2))+e:parseFloat(t)},re=function(t,e,i,s){var r,n,a,o,h=1e-6;return null==t?o=e:"number"==typeof t?o=t:(r=360,n=t.split("_"),a=Number(n[0].replace(v,""))*(-1===t.indexOf("rad")?1:z)-("="===t.charAt(1)?0:e),n.length&&(s&&(s[i]=e+a),-1!==t.indexOf("short")&&(a%=r,a!==a%(r/2)&&(a=0>a?a+r:a-r)),-1!==t.indexOf("_cw")&&0>a?a=(a+9999999999*r)%r-(0|a/r)*r:-1!==t.indexOf("ccw")&&a>0&&(a=(a-9999999999*r)%r-(0|a/r)*r)),o=e+a),h>o&&o>-h&&(o=0),o},ne={aqua:[0,255,255],lime:[0,255,0],silver:[192,192,192],black:[0,0,0],maroon:[128,0,0],teal:[0,128,128],blue:[0,0,255],navy:[0,0,128],white:[255,255,255],fuchsia:[255,0,255],olive:[128,128,0],yellow:[255,255,0],orange:[255,165,0],gray:[128,128,128],purple:[128,0,128],green:[0,128,0],red:[255,0,0],pink:[255,192,203],cyan:[0,255,255],transparent:[255,255,255,0]},ae=function(t,e,i){return t=0>t?t+1:t>1?t-1:t,0|255*(1>6*t?e+6*(i-e)*t:.5>t?i:2>3*t?e+6*(i-e)*(2/3-t):e)+.5},oe=function(t){var e,i,s,r,n,a;return t&&""!==t?"number"==typeof t?[t>>16,255&t>>8,255&t]:(","===t.charAt(t.length-1)&&(t=t.substr(0,t.length-1)),ne[t]?ne[t]:"#"===t.charAt(0)?(4===t.length&&(e=t.charAt(1),i=t.charAt(2),s=t.charAt(3),t="#"+e+e+i+i+s+s),t=parseInt(t.substr(1),16),[t>>16,255&t>>8,255&t]):"hsl"===t.substr(0,3)?(t=t.match(m),r=Number(t[0])%360/360,n=Number(t[1])/100,a=Number(t[2])/100,i=.5>=a?a*(n+1):a+n-a*n,e=2*a-i,t.length>3&&(t[3]=Number(t[3])),t[0]=ae(r+1/3,e,i),t[1]=ae(r,e,i),t[2]=ae(r-1/3,e,i),t):(t=t.match(m)||ne.transparent,t[0]=Number(t[0]),t[1]=Number(t[1]),t[2]=Number(t[2]),t.length>3&&(t[3]=Number(t[3])),t)):ne.black},he="(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#.+?\\b";for(h in ne)he+="|"+h+"\\b";he=RegExp(he+")","gi");var le=function(t,e,i,s){if(null==t)return function(t){return t};var r,n=e?(t.match(he)||[""])[0]:"",a=t.split(n).join("").match(g)||[],o=t.substr(0,t.indexOf(a[0])),h=")"===t.charAt(t.length-1)?")":"",l=-1!==t.indexOf(" ")?" ":",",_=a.length,u=_>0?a[0].replace(m,""):"";return _?r=e?function(t){var e,p,c,f;if("number"==typeof t)t+=u;else if(s&&D.test(t)){for(f=t.replace(D,"|").split("|"),c=0;f.length>c;c++)f[c]=r(f[c]);return f.join(",")}if(e=(t.match(he)||[n])[0],p=t.split(e).join("").match(g)||[],c=p.length,_>c--)for(;_>++c;)p[c]=i?p[0|(c-1)/2]:a[c];return o+p.join(l)+l+e+h+(-1!==t.indexOf("inset")?" inset":"")}:function(t){var e,n,p;if("number"==typeof t)t+=u;else if(s&&D.test(t)){for(n=t.replace(D,"|").split("|"),p=0;n.length>p;p++)n[p]=r(n[p]);return n.join(",")}if(e=t.match(g)||[],p=e.length,_>p--)for(;_>++p;)e[p]=i?e[0|(p-1)/2]:a[p];return o+e.join(l)+h}:function(t){return t}},_e=function(t){return t=t.split(","),function(e,i,s,r,n,a,o){var h,l=(i+"").split(" ");for(o={},h=0;4>h;h++)o[t[h]]=l[h]=l[h]||l[(h-1)/2>>0];return r.parse(e,o,n,a)}},ue=(N._setPluginRatio=function(t){this.plugin.setRatio(t);for(var e,i,s,r,n=this.data,a=n.proxy,o=n.firstMPT,h=1e-6;o;)e=a[o.v],o.r?e=Math.round(e):h>e&&e>-h&&(e=0),o.t[o.p]=e,o=o._next;if(n.autoRotate&&(n.autoRotate.rotation=a.rotation),1===t)for(o=n.firstMPT;o;){if(i=o.t,i.type){if(1===i.type){for(r=i.xs0+i.s+i.xs1,s=1;i.l>s;s++)r+=i["xn"+s]+i["xs"+(s+1)];i.e=r}}else i.e=i.s+i.xs0;o=o._next}},function(t,e,i,s,r){this.t=t,this.p=e,this.v=i,this.r=r,s&&(s._prev=this,this._next=s)}),pe=(N._parseToProxy=function(t,e,i,s,r,n){var a,o,h,l,_,u=s,p={},c={},f=i._transform,m=I;for(i._transform=null,I=e,s=_=i.parse(t,e,s,r),I=m,n&&(i._transform=f,u&&(u._prev=null,u._prev&&(u._prev._next=null)));s&&s!==u;){if(1>=s.type&&(o=s.p,c[o]=s.s+s.c,p[o]=s.s,n||(l=new ue(s,"s",o,l,s.r),s.c=0),1===s.type))for(a=s.l;--a>0;)h="xn"+a,o=s.p+"_"+h,c[o]=s.data[h],p[o]=s[h],n||(l=new ue(s,h,o,l,s.rxp[h]));s=s._next}return{proxy:p,end:c,firstMPT:l,pt:_}},N.CSSPropTween=function(t,e,s,r,a,o,h,l,_,u,p){this.t=t,this.p=e,this.s=s,this.c=r,this.n=h||e,t instanceof pe||n.push(this.n),this.r=l,this.type=o||0,_&&(this.pr=_,i=!0),this.b=void 0===u?s:u,this.e=void 0===p?s+r:p,a&&(this._next=a,a._prev=this)}),ce=a.parseComplex=function(t,e,i,s,r,n,a,o,h,_){i=i||n||"",a=new pe(t,e,0,0,a,_?2:1,null,!1,o,i,s),s+="";var u,p,c,f,g,v,y,T,w,x,P,S,k=i.split(", ").join(",").split(" "),R=s.split(", ").join(",").split(" "),A=k.length,C=l!==!1;for((-1!==s.indexOf(",")||-1!==i.indexOf(","))&&(k=k.join(" ").replace(D,", ").split(" "),R=R.join(" ").replace(D,", ").split(" "),A=k.length),A!==R.length&&(k=(n||"").split(" "),A=k.length),a.plugin=h,a.setRatio=_,u=0;A>u;u++)if(f=k[u],g=R[u],T=parseFloat(f),T||0===T)a.appendXtra("",T,ie(g,T),g.replace(d,""),C&&-1!==g.indexOf("px"),!0);else if(r&&("#"===f.charAt(0)||ne[f]||b.test(f)))S=","===g.charAt(g.length-1)?"),":")",f=oe(f),g=oe(g),w=f.length+g.length>6,w&&!U&&0===g[3]?(a["xs"+a.l]+=a.l?" transparent":"transparent",a.e=a.e.split(R[u]).join("transparent")):(U||(w=!1),a.appendXtra(w?"rgba(":"rgb(",f[0],g[0]-f[0],",",!0,!0).appendXtra("",f[1],g[1]-f[1],",",!0).appendXtra("",f[2],g[2]-f[2],w?",":S,!0),w&&(f=4>f.length?1:f[3],a.appendXtra("",f,(4>g.length?1:g[3])-f,S,!1)));else if(v=f.match(m)){if(y=g.match(d),!y||y.length!==v.length)return a;for(c=0,p=0;v.length>p;p++)P=v[p],x=f.indexOf(P,c),a.appendXtra(f.substr(c,x-c),Number(P),ie(y[p],P),"",C&&"px"===f.substr(x+P.length,2),0===p),c=x+P.length;a["xs"+a.l]+=f.substr(c)}else a["xs"+a.l]+=a.l?" "+f:f;if(-1!==s.indexOf("=")&&a.data){for(S=a.xs0+a.data.s,u=1;a.l>u;u++)S+=a["xs"+u]+a.data["xn"+u];a.e=S+a["xs"+u]}return a.l||(a.type=-1,a.xs0=a.e),a.xfirst||a},fe=9;for(h=pe.prototype,h.l=h.pr=0;--fe>0;)h["xn"+fe]=0,h["xs"+fe]="";h.xs0="",h._next=h._prev=h.xfirst=h.data=h.plugin=h.setRatio=h.rxp=null,h.appendXtra=function(t,e,i,s,r,n){var a=this,o=a.l;return a["xs"+o]+=n&&o?" "+t:t||"",i||0===o||a.plugin?(a.l++,a.type=a.setRatio?2:1,a["xs"+a.l]=s||"",o>0?(a.data["xn"+o]=e+i,a.rxp["xn"+o]=r,a["xn"+o]=e,a.plugin||(a.xfirst=new pe(a,"xn"+o,e,i,a.xfirst||a,0,a.n,r,a.pr),a.xfirst.xs0=0),a):(a.data={s:e+i},a.rxp={},a.s=e,a.c=i,a.r=r,a)):(a["xs"+o]+=e+(s||""),a)};var me=function(t,e){e=e||{},this.p=e.prefix?V(t)||t:t,o[t]=o[this.p]=this,this.format=e.formatter||le(e.defaultValue,e.color,e.collapsible,e.multi),e.parser&&(this.parse=e.parser),this.clrs=e.color,this.multi=e.multi,this.keyword=e.keyword,this.dflt=e.defaultValue,this.pr=e.priority||0},de=N._registerComplexSpecialProp=function(t,e,i){"object"!=typeof e&&(e={parser:i});var s,r,n=t.split(","),a=e.defaultValue;for(i=i||[a],s=0;n.length>s;s++)e.prefix=0===s&&e.prefix,e.defaultValue=i[s]||a,r=new me(n[s],e)},ge=function(t){if(!o[t]){var e=t.charAt(0).toUpperCase()+t.substr(1)+"Plugin";de(t,{parser:function(t,i,s,r,n,a,h){var l=(_gsScope.GreenSockGlobals||_gsScope).com.greensock.plugins[e];return l?(l._cssRegister(),o[s].parse(t,i,s,r,n,a,h)):(j("Error: "+e+" js file not loaded."),n)}})}};h=me.prototype,h.parseComplex=function(t,e,i,s,r,n){var a,o,h,l,_,u,p=this.keyword;if(this.multi&&(D.test(i)||D.test(e)?(o=e.replace(D,"|").split("|"),h=i.replace(D,"|").split("|")):p&&(o=[e],h=[i])),h){for(l=h.length>o.length?h.length:o.length,a=0;l>a;a++)e=o[a]=o[a]||this.dflt,i=h[a]=h[a]||this.dflt,p&&(_=e.indexOf(p),u=i.indexOf(p),_!==u&&(i=-1===u?h:o,i[a]+=" "+p));e=o.join(", "),i=h.join(", ")}return ce(t,this.p,e,i,this.clrs,this.dflt,s,this.pr,r,n)},h.parse=function(t,e,i,s,n,a){return this.parseComplex(t.style,this.format(W(t,this.p,r,!1,this.dflt)),this.format(e),n,a)},a.registerSpecialProp=function(t,e,i){de(t,{parser:function(t,s,r,n,a,o){var h=new pe(t,r,0,0,a,2,r,!1,i);return h.plugin=o,h.setRatio=e(t,s,n._tween,r),h},priority:i})};var ve="scaleX,scaleY,scaleZ,x,y,z,skewX,skewY,rotation,rotationX,rotationY,perspective,xPercent,yPercent".split(","),ye=V("transform"),Te=B+"transform",we=V("transformOrigin"),xe=null!==V("perspective"),be=N.Transform=function(){this.skewY=0},Pe=N.getTransform=function(t,e,i,s){if(t._gsTransform&&i&&!s)return t._gsTransform;var r,n,o,h,l,_,u,p,c,f,m,d,g,v=i?t._gsTransform||new be:new be,y=0>v.scaleX,T=2e-5,w=1e5,x=179.99,b=x*M,P=xe?parseFloat(W(t,we,e,!1,"0 0 0").split(" ")[2])||v.zOrigin||0:0;if(ye?r=W(t,Te,e,!0):t.currentStyle&&(r=t.currentStyle.filter.match(C),r=r&&4===r.length?[r[0].substr(4),Number(r[2].substr(4)),Number(r[1].substr(4)),r[3].substr(4),v.x||0,v.y||0].join(","):""),r&&"none"!==r&&"matrix(1, 0, 0, 1, 0, 0)"!==r){for(n=(r||"").match(/(?:\-|\b)[\d\-\.e]+\b/gi)||[],o=n.length;--o>-1;)h=Number(n[o]),n[o]=(l=h-(h|=0))?(0|l*w+(0>l?-.5:.5))/w+h:h;if(16===n.length){var S=n[8],k=n[9],R=n[10],A=n[12],O=n[13],D=n[14];if(v.zOrigin&&(D=-v.zOrigin,A=S*D-n[12],O=k*D-n[13],D=R*D+v.zOrigin-n[14]),!i||s||null==v.rotationX){var I,E,L,F,N,X,U,Y=n[0],j=n[1],B=n[2],q=n[3],V=n[4],G=n[5],Q=n[6],Z=n[7],$=n[11],H=Math.atan2(Q,R),K=-b>H||H>b;v.rotationX=H*z,H&&(F=Math.cos(-H),N=Math.sin(-H),I=V*F+S*N,E=G*F+k*N,L=Q*F+R*N,S=V*-N+S*F,k=G*-N+k*F,R=Q*-N+R*F,$=Z*-N+$*F,V=I,G=E,Q=L),H=Math.atan2(S,Y),v.rotationY=H*z,H&&(X=-b>H||H>b,F=Math.cos(-H),N=Math.sin(-H),I=Y*F-S*N,E=j*F-k*N,L=B*F-R*N,k=j*N+k*F,R=B*N+R*F,$=q*N+$*F,Y=I,j=E,B=L),H=Math.atan2(j,G),v.rotation=H*z,H&&(U=-b>H||H>b,F=Math.cos(-H),N=Math.sin(-H),Y=Y*F+V*N,E=j*F+G*N,G=j*-N+G*F,Q=B*-N+Q*F,j=E),U&&K?v.rotation=v.rotationX=0:U&&X?v.rotation=v.rotationY=0:X&&K&&(v.rotationY=v.rotationX=0),v.scaleX=(0|Math.sqrt(Y*Y+j*j)*w+.5)/w,v.scaleY=(0|Math.sqrt(G*G+k*k)*w+.5)/w,v.scaleZ=(0|Math.sqrt(Q*Q+R*R)*w+.5)/w,v.skewX=0,v.perspective=$?1/(0>$?-$:$):0,v.x=A,v.y=O,v.z=D}}else if(!(xe&&!s&&n.length&&v.x===n[4]&&v.y===n[5]&&(v.rotationX||v.rotationY)||void 0!==v.x&&"none"===W(t,"display",e))){var J=n.length>=6,te=J?n[0]:1,ee=n[1]||0,ie=n[2]||0,se=J?n[3]:1;v.x=n[4]||0,v.y=n[5]||0,_=Math.sqrt(te*te+ee*ee),u=Math.sqrt(se*se+ie*ie),p=te||ee?Math.atan2(ee,te)*z:v.rotation||0,c=ie||se?Math.atan2(ie,se)*z+p:v.skewX||0,f=_-Math.abs(v.scaleX||0),m=u-Math.abs(v.scaleY||0),Math.abs(c)>90&&270>Math.abs(c)&&(y?(_*=-1,c+=0>=p?180:-180,p+=0>=p?180:-180):(u*=-1,c+=0>=c?180:-180)),d=(p-v.rotation)%180,g=(c-v.skewX)%180,(void 0===v.skewX||f>T||-T>f||m>T||-T>m||d>-x&&x>d&&false|d*w||g>-x&&x>g&&false|g*w)&&(v.scaleX=_,v.scaleY=u,v.rotation=p,v.skewX=c),xe&&(v.rotationX=v.rotationY=v.z=0,v.perspective=parseFloat(a.defaultTransformPerspective)||0,v.scaleZ=1)}v.zOrigin=P;for(o in v)T>v[o]&&v[o]>-T&&(v[o]=0)}else v={x:0,y:0,z:0,scaleX:1,scaleY:1,scaleZ:1,skewX:0,perspective:0,rotation:0,rotationX:0,rotationY:0,zOrigin:0};return i&&(t._gsTransform=v),v.xPercent=v.yPercent=0,v},Se=function(t){var e,i,s=this.data,r=-s.rotation*M,n=r+s.skewX*M,a=1e5,o=(0|Math.cos(r)*s.scaleX*a)/a,h=(0|Math.sin(r)*s.scaleX*a)/a,l=(0|Math.sin(n)*-s.scaleY*a)/a,_=(0|Math.cos(n)*s.scaleY*a)/a,u=this.t.style,p=this.t.currentStyle;if(p){i=h,h=-l,l=-i,e=p.filter,u.filter="";var c,m,d=this.t.offsetWidth,g=this.t.offsetHeight,v="absolute"!==p.position,w="progid:DXImageTransform.Microsoft.Matrix(M11="+o+", M12="+h+", M21="+l+", M22="+_,x=s.x+d*s.xPercent/100,b=s.y+g*s.yPercent/100;if(null!=s.ox&&(c=(s.oxp?.01*d*s.ox:s.ox)-d/2,m=(s.oyp?.01*g*s.oy:s.oy)-g/2,x+=c-(c*o+m*h),b+=m-(c*l+m*_)),v?(c=d/2,m=g/2,w+=", Dx="+(c-(c*o+m*h)+x)+", Dy="+(m-(c*l+m*_)+b)+")"):w+=", sizingMethod='auto expand')",u.filter=-1!==e.indexOf("DXImageTransform.Microsoft.Matrix(")?e.replace(O,w):w+" "+e,(0===t||1===t)&&1===o&&0===h&&0===l&&1===_&&(v&&-1===w.indexOf("Dx=0, Dy=0")||T.test(e)&&100!==parseFloat(RegExp.$1)||-1===e.indexOf("gradient("&&e.indexOf("Alpha"))&&u.removeAttribute("filter")),!v){var P,S,k,R=8>f?1:-1;for(c=s.ieOffsetX||0,m=s.ieOffsetY||0,s.ieOffsetX=Math.round((d-((0>o?-o:o)*d+(0>h?-h:h)*g))/2+x),s.ieOffsetY=Math.round((g-((0>_?-_:_)*g+(0>l?-l:l)*d))/2+b),fe=0;4>fe;fe++)S=J[fe],P=p[S],i=-1!==P.indexOf("px")?parseFloat(P):Q(this.t,S,parseFloat(P),P.replace(y,""))||0,k=i!==s[S]?2>fe?-s.ieOffsetX:-s.ieOffsetY:2>fe?c-s.ieOffsetX:m-s.ieOffsetY,u[S]=(s[S]=Math.round(i-k*(0===fe||2===fe?1:R)))+"px"}}},ke=N.set3DTransformRatio=function(t){var e,i,s,r,n,a,o,h,l,_,u,c,f,m,d,g,v,y,T,w,x,b,P,S=this.data,k=this.t.style,R=S.rotation*M,A=S.scaleX,C=S.scaleY,O=S.scaleZ,D=S.x,z=S.y,I=S.z,E=S.perspective;if(!(1!==t&&0!==t||"auto"!==S.force3D||S.rotationY||S.rotationX||1!==O||E||I))return Re.call(this,t),void 0;if(p){var L=1e-4;L>A&&A>-L&&(A=O=2e-5),L>C&&C>-L&&(C=O=2e-5),!E||S.z||S.rotationX||S.rotationY||(E=0)}if(R||S.skewX)y=Math.cos(R),T=Math.sin(R),e=y,n=T,S.skewX&&(R-=S.skewX*M,y=Math.cos(R),T=Math.sin(R),"simple"===S.skewType&&(w=Math.tan(S.skewX*M),w=Math.sqrt(1+w*w),y*=w,T*=w)),i=-T,a=y;else{if(!(S.rotationY||S.rotationX||1!==O||E))return k[ye]=(S.xPercent||S.yPercent?"translate("+S.xPercent+"%,"+S.yPercent+"%) translate3d(":"translate3d(")+D+"px,"+z+"px,"+I+"px)"+(1!==A||1!==C?" scale("+A+","+C+")":""),void 0;e=a=1,i=n=0}u=1,s=r=o=h=l=_=c=f=m=0,d=E?-1/E:0,g=S.zOrigin,v=1e5,R=S.rotationY*M,R&&(y=Math.cos(R),T=Math.sin(R),l=u*-T,f=d*-T,s=e*T,o=n*T,u*=y,d*=y,e*=y,n*=y),R=S.rotationX*M,R&&(y=Math.cos(R),T=Math.sin(R),w=i*y+s*T,x=a*y+o*T,b=_*y+u*T,P=m*y+d*T,s=i*-T+s*y,o=a*-T+o*y,u=_*-T+u*y,d=m*-T+d*y,i=w,a=x,_=b,m=P),1!==O&&(s*=O,o*=O,u*=O,d*=O),1!==C&&(i*=C,a*=C,_*=C,m*=C),1!==A&&(e*=A,n*=A,l*=A,f*=A),g&&(c-=g,r=s*c,h=o*c,c=u*c+g),r=(w=(r+=D)-(r|=0))?(0|w*v+(0>w?-.5:.5))/v+r:r,h=(w=(h+=z)-(h|=0))?(0|w*v+(0>w?-.5:.5))/v+h:h,c=(w=(c+=I)-(c|=0))?(0|w*v+(0>w?-.5:.5))/v+c:c,k[ye]=(S.xPercent||S.yPercent?"translate("+S.xPercent+"%,"+S.yPercent+"%) matrix3d(":"matrix3d(")+[(0|e*v)/v,(0|n*v)/v,(0|l*v)/v,(0|f*v)/v,(0|i*v)/v,(0|a*v)/v,(0|_*v)/v,(0|m*v)/v,(0|s*v)/v,(0|o*v)/v,(0|u*v)/v,(0|d*v)/v,r,h,c,E?1+-c/E:1].join(",")+")"},Re=N.set2DTransformRatio=function(t){var e,i,s,r,n,a=this.data,o=this.t,h=o.style,l=a.x,_=a.y;return a.rotationX||a.rotationY||a.z||a.force3D===!0||"auto"===a.force3D&&1!==t&&0!==t?(this.setRatio=ke,ke.call(this,t),void 0):(a.rotation||a.skewX?(e=a.rotation*M,i=e-a.skewX*M,s=1e5,r=a.scaleX*s,n=a.scaleY*s,h[ye]=(a.xPercent||a.yPercent?"translate("+a.xPercent+"%,"+a.yPercent+"%) matrix(":"matrix(")+(0|Math.cos(e)*r)/s+","+(0|Math.sin(e)*r)/s+","+(0|Math.sin(i)*-n)/s+","+(0|Math.cos(i)*n)/s+","+l+","+_+")"):h[ye]=(a.xPercent||a.yPercent?"translate("+a.xPercent+"%,"+a.yPercent+"%) matrix(":"matrix(")+a.scaleX+",0,0,"+a.scaleY+","+l+","+_+")",void 0)};de("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,transformPerspective,directionalRotation,parseTransform,force3D,skewType,xPercent,yPercent",{parser:function(t,e,i,s,n,o,h){if(s._transform)return n;var l,_,u,p,c,f,m,d=s._transform=Pe(t,r,!0,h.parseTransform),g=t.style,v=1e-6,y=ve.length,T=h,w={};if("string"==typeof T.transform&&ye)u=L.style,u[ye]=T.transform,u.display="block",u.position="absolute",E.body.appendChild(L),l=Pe(L,null,!1),E.body.removeChild(L);else if("object"==typeof T){if(l={scaleX:se(null!=T.scaleX?T.scaleX:T.scale,d.scaleX),scaleY:se(null!=T.scaleY?T.scaleY:T.scale,d.scaleY),scaleZ:se(T.scaleZ,d.scaleZ),x:se(T.x,d.x),y:se(T.y,d.y),z:se(T.z,d.z),xPercent:se(T.xPercent,d.xPercent),yPercent:se(T.yPercent,d.yPercent),perspective:se(T.transformPerspective,d.perspective)},m=T.directionalRotation,null!=m)if("object"==typeof m)for(u in m)T[u]=m[u];else T.rotation=m;"string"==typeof T.x&&-1!==T.x.indexOf("%")&&(l.x=0,l.xPercent=se(T.x,d.xPercent)),"string"==typeof T.y&&-1!==T.y.indexOf("%")&&(l.y=0,l.yPercent=se(T.y,d.yPercent)),l.rotation=re("rotation"in T?T.rotation:"shortRotation"in T?T.shortRotation+"_short":"rotationZ"in T?T.rotationZ:d.rotation,d.rotation,"rotation",w),xe&&(l.rotationX=re("rotationX"in T?T.rotationX:"shortRotationX"in T?T.shortRotationX+"_short":d.rotationX||0,d.rotationX,"rotationX",w),l.rotationY=re("rotationY"in T?T.rotationY:"shortRotationY"in T?T.shortRotationY+"_short":d.rotationY||0,d.rotationY,"rotationY",w)),l.skewX=null==T.skewX?d.skewX:re(T.skewX,d.skewX),l.skewY=null==T.skewY?d.skewY:re(T.skewY,d.skewY),(_=l.skewY-d.skewY)&&(l.skewX+=_,l.rotation+=_)}for(xe&&null!=T.force3D&&(d.force3D=T.force3D,f=!0),d.skewType=T.skewType||d.skewType||a.defaultSkewType,c=d.force3D||d.z||d.rotationX||d.rotationY||l.z||l.rotationX||l.rotationY||l.perspective,c||null==T.scale||(l.scaleZ=1);--y>-1;)i=ve[y],p=l[i]-d[i],(p>v||-v>p||null!=I[i])&&(f=!0,n=new pe(d,i,d[i],p,n),i in w&&(n.e=w[i]),n.xs0=0,n.plugin=o,s._overwriteProps.push(n.n));return p=T.transformOrigin,(p||xe&&c&&d.zOrigin)&&(ye?(f=!0,i=we,p=(p||W(t,i,r,!1,"50% 50%"))+"",n=new pe(g,i,0,0,n,-1,"transformOrigin"),n.b=g[i],n.plugin=o,xe?(u=d.zOrigin,p=p.split(" "),d.zOrigin=(p.length>2&&(0===u||"0px"!==p[2])?parseFloat(p[2]):u)||0,n.xs0=n.e=p[0]+" "+(p[1]||"50%")+" 0px",n=new pe(d,"zOrigin",0,0,n,-1,n.n),n.b=u,n.xs0=n.e=d.zOrigin):n.xs0=n.e=p):ee(p+"",d)),f&&(s._transformType=c||3===this._transformType?3:2),n},prefix:!0}),de("boxShadow",{defaultValue:"0px 0px 0px 0px #999",prefix:!0,color:!0,multi:!0,keyword:"inset"}),de("borderRadius",{defaultValue:"0px",parser:function(t,e,i,n,a){e=this.format(e);var o,h,l,_,u,p,c,f,m,d,g,v,y,T,w,x,b=["borderTopLeftRadius","borderTopRightRadius","borderBottomRightRadius","borderBottomLeftRadius"],P=t.style;for(m=parseFloat(t.offsetWidth),d=parseFloat(t.offsetHeight),o=e.split(" "),h=0;b.length>h;h++)this.p.indexOf("border")&&(b[h]=V(b[h])),u=_=W(t,b[h],r,!1,"0px"),-1!==u.indexOf(" ")&&(_=u.split(" "),u=_[0],_=_[1]),p=l=o[h],c=parseFloat(u),v=u.substr((c+"").length),y="="===p.charAt(1),y?(f=parseInt(p.charAt(0)+"1",10),p=p.substr(2),f*=parseFloat(p),g=p.substr((f+"").length-(0>f?1:0))||""):(f=parseFloat(p),g=p.substr((f+"").length)),""===g&&(g=s[i]||v),g!==v&&(T=Q(t,"borderLeft",c,v),w=Q(t,"borderTop",c,v),"%"===g?(u=100*(T/m)+"%",_=100*(w/d)+"%"):"em"===g?(x=Q(t,"borderLeft",1,"em"),u=T/x+"em",_=w/x+"em"):(u=T+"px",_=w+"px"),y&&(p=parseFloat(u)+f+g,l=parseFloat(_)+f+g)),a=ce(P,b[h],u+" "+_,p+" "+l,!1,"0px",a);return a},prefix:!0,formatter:le("0px 0px 0px 0px",!1,!0)}),de("backgroundPosition",{defaultValue:"0 0",parser:function(t,e,i,s,n,a){var o,h,l,_,u,p,c="background-position",m=r||G(t,null),d=this.format((m?f?m.getPropertyValue(c+"-x")+" "+m.getPropertyValue(c+"-y"):m.getPropertyValue(c):t.currentStyle.backgroundPositionX+" "+t.currentStyle.backgroundPositionY)||"0 0"),g=this.format(e);if(-1!==d.indexOf("%")!=(-1!==g.indexOf("%"))&&(p=W(t,"backgroundImage").replace(k,""),p&&"none"!==p)){for(o=d.split(" "),h=g.split(" "),F.setAttribute("src",p),l=2;--l>-1;)d=o[l],_=-1!==d.indexOf("%"),_!==(-1!==h[l].indexOf("%"))&&(u=0===l?t.offsetWidth-F.width:t.offsetHeight-F.height,o[l]=_?parseFloat(d)/100*u+"px":100*(parseFloat(d)/u)+"%");d=o.join(" ")}return this.parseComplex(t.style,d,g,n,a)},formatter:ee}),de("backgroundSize",{defaultValue:"0 0",formatter:ee}),de("perspective",{defaultValue:"0px",prefix:!0}),de("perspectiveOrigin",{defaultValue:"50% 50%",prefix:!0}),de("transformStyle",{prefix:!0}),de("backfaceVisibility",{prefix:!0}),de("userSelect",{prefix:!0}),de("margin",{parser:_e("marginTop,marginRight,marginBottom,marginLeft")}),de("padding",{parser:_e("paddingTop,paddingRight,paddingBottom,paddingLeft")}),de("clip",{defaultValue:"rect(0px,0px,0px,0px)",parser:function(t,e,i,s,n,a){var o,h,l;return 9>f?(h=t.currentStyle,l=8>f?" ":",",o="rect("+h.clipTop+l+h.clipRight+l+h.clipBottom+l+h.clipLeft+")",e=this.format(e).split(",").join(l)):(o=this.format(W(t,this.p,r,!1,this.dflt)),e=this.format(e)),this.parseComplex(t.style,o,e,n,a)}}),de("textShadow",{defaultValue:"0px 0px 0px #999",color:!0,multi:!0}),de("autoRound,strictUnits",{parser:function(t,e,i,s,r){return r}}),de("border",{defaultValue:"0px solid #000",parser:function(t,e,i,s,n,a){return this.parseComplex(t.style,this.format(W(t,"borderTopWidth",r,!1,"0px")+" "+W(t,"borderTopStyle",r,!1,"solid")+" "+W(t,"borderTopColor",r,!1,"#000")),this.format(e),n,a)},color:!0,formatter:function(t){var e=t.split(" ");return e[0]+" "+(e[1]||"solid")+" "+(t.match(he)||["#000"])[0]}}),de("borderWidth",{parser:_e("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")}),de("float,cssFloat,styleFloat",{parser:function(t,e,i,s,r){var n=t.style,a="cssFloat"in n?"cssFloat":"styleFloat";return new pe(n,a,0,0,r,-1,i,!1,0,n[a],e)}});var Ae=function(t){var e,i=this.t,s=i.filter||W(this.data,"filter"),r=0|this.s+this.c*t;100===r&&(-1===s.indexOf("atrix(")&&-1===s.indexOf("radient(")&&-1===s.indexOf("oader(")?(i.removeAttribute("filter"),e=!W(this.data,"filter")):(i.filter=s.replace(x,""),e=!0)),e||(this.xn1&&(i.filter=s=s||"alpha(opacity="+r+")"),-1===s.indexOf("pacity")?0===r&&this.xn1||(i.filter=s+" alpha(opacity="+r+")"):i.filter=s.replace(T,"opacity="+r))};de("opacity,alpha,autoAlpha",{defaultValue:"1",parser:function(t,e,i,s,n,a){var o=parseFloat(W(t,"opacity",r,!1,"1")),h=t.style,l="autoAlpha"===i;return"string"==typeof e&&"="===e.charAt(1)&&(e=("-"===e.charAt(0)?-1:1)*parseFloat(e.substr(2))+o),l&&1===o&&"hidden"===W(t,"visibility",r)&&0!==e&&(o=0),U?n=new pe(h,"opacity",o,e-o,n):(n=new pe(h,"opacity",100*o,100*(e-o),n),n.xn1=l?1:0,h.zoom=1,n.type=2,n.b="alpha(opacity="+n.s+")",n.e="alpha(opacity="+(n.s+n.c)+")",n.data=t,n.plugin=a,n.setRatio=Ae),l&&(n=new pe(h,"visibility",0,0,n,-1,null,!1,0,0!==o?"inherit":"hidden",0===e?"hidden":"inherit"),n.xs0="inherit",s._overwriteProps.push(n.n),s._overwriteProps.push(i)),n}});var Ce=function(t,e){e&&(t.removeProperty?("ms"===e.substr(0,2)&&(e="M"+e.substr(1)),t.removeProperty(e.replace(P,"-$1").toLowerCase())):t.removeAttribute(e))},Oe=function(t){if(this.t._gsClassPT=this,1===t||0===t){this.t.setAttribute("class",0===t?this.b:this.e);for(var e=this.data,i=this.t.style;e;)e.v?i[e.p]=e.v:Ce(i,e.p),e=e._next;1===t&&this.t._gsClassPT===this&&(this.t._gsClassPT=null)}else this.t.getAttribute("class")!==this.e&&this.t.setAttribute("class",this.e)};de("className",{parser:function(t,e,s,n,a,o,h){var l,_,u,p,c,f=t.getAttribute("class")||"",m=t.style.cssText;if(a=n._classNamePT=new pe(t,s,0,0,a,2),a.setRatio=Oe,a.pr=-11,i=!0,a.b=f,_=$(t,r),u=t._gsClassPT){for(p={},c=u.data;c;)p[c.p]=1,c=c._next;u.setRatio(1)}return t._gsClassPT=a,a.e="="!==e.charAt(1)?e:f.replace(RegExp("\\s*\\b"+e.substr(2)+"\\b"),"")+("+"===e.charAt(0)?" "+e.substr(2):""),n._tween._duration&&(t.setAttribute("class",a.e),l=H(t,_,$(t),h,p),t.setAttribute("class",f),a.data=l.firstMPT,t.style.cssText=m,a=a.xfirst=n.parse(t,l.difs,a,o)),a}});var De=function(t){if((1===t||0===t)&&this.data._totalTime===this.data._totalDuration&&"isFromStart"!==this.data.data){var e,i,s,r,n=this.t.style,a=o.transform.parse;if("all"===this.e)n.cssText="",r=!0;else for(e=this.e.split(","),s=e.length;--s>-1;)i=e[s],o[i]&&(o[i].parse===a?r=!0:i="transformOrigin"===i?we:o[i].p),Ce(n,i);r&&(Ce(n,ye),this.t._gsTransform&&delete this.t._gsTransform)}};for(de("clearProps",{parser:function(t,e,s,r,n){return n=new pe(t,s,0,0,n,2),n.setRatio=De,n.e=e,n.pr=-10,n.data=r._tween,i=!0,n}}),h="bezier,throwProps,physicsProps,physics2D".split(","),fe=h.length;fe--;)ge(h[fe]);h=a.prototype,h._firstPT=null,h._onInitTween=function(t,e,o){if(!t.nodeType)return!1;this._target=t,this._tween=o,this._vars=e,l=e.autoRound,i=!1,s=e.suffixMap||a.suffixMap,r=G(t,""),n=this._overwriteProps;var h,p,f,m,d,g,v,y,T,x=t.style;if(_&&""===x.zIndex&&(h=W(t,"zIndex",r),("auto"===h||""===h)&&this._addLazySet(x,"zIndex",0)),"string"==typeof e&&(m=x.cssText,h=$(t,r),x.cssText=m+";"+e,h=H(t,h,$(t)).difs,!U&&w.test(e)&&(h.opacity=parseFloat(RegExp.$1)),e=h,x.cssText=m),this._firstPT=p=this.parse(t,e,null),this._transformType){for(T=3===this._transformType,ye?u&&(_=!0,""===x.zIndex&&(v=W(t,"zIndex",r),("auto"===v||""===v)&&this._addLazySet(x,"zIndex",0)),c&&this._addLazySet(x,"WebkitBackfaceVisibility",this._vars.WebkitBackfaceVisibility||(T?"visible":"hidden"))):x.zoom=1,f=p;f&&f._next;)f=f._next;y=new pe(t,"transform",0,0,null,2),this._linkCSSP(y,null,f),y.setRatio=T&&xe?ke:ye?Re:Se,y.data=this._transform||Pe(t,r,!0),n.pop()}if(i){for(;p;){for(g=p._next,f=m;f&&f.pr>p.pr;)f=f._next;(p._prev=f?f._prev:d)?p._prev._next=p:m=p,(p._next=f)?f._prev=p:d=p,p=g}this._firstPT=m}return!0},h.parse=function(t,e,i,n){var a,h,_,u,p,c,f,m,d,g,v=t.style;for(a in e)c=e[a],h=o[a],h?i=h.parse(t,c,a,this,i,n,e):(p=W(t,a,r)+"",d="string"==typeof c,"color"===a||"fill"===a||"stroke"===a||-1!==a.indexOf("Color")||d&&b.test(c)?(d||(c=oe(c),c=(c.length>3?"rgba(":"rgb(")+c.join(",")+")"),i=ce(v,a,p,c,!0,"transparent",i,0,n)):!d||-1===c.indexOf(" ")&&-1===c.indexOf(",")?(_=parseFloat(p),f=_||0===_?p.substr((_+"").length):"",(""===p||"auto"===p)&&("width"===a||"height"===a?(_=te(t,a,r),f="px"):"left"===a||"top"===a?(_=Z(t,a,r),f="px"):(_="opacity"!==a?0:1,f="")),g=d&&"="===c.charAt(1),g?(u=parseInt(c.charAt(0)+"1",10),c=c.substr(2),u*=parseFloat(c),m=c.replace(y,"")):(u=parseFloat(c),m=d?c.substr((u+"").length)||"":""),""===m&&(m=a in s?s[a]:f),c=u||0===u?(g?u+_:u)+m:e[a],f!==m&&""!==m&&(u||0===u)&&_&&(_=Q(t,a,_,f),"%"===m?(_/=Q(t,a,100,"%")/100,e.strictUnits!==!0&&(p=_+"%")):"em"===m?_/=Q(t,a,1,"em"):"px"!==m&&(u=Q(t,a,u,m),m="px"),g&&(u||0===u)&&(c=u+_+m)),g&&(u+=_),!_&&0!==_||!u&&0!==u?void 0!==v[a]&&(c||"NaN"!=c+""&&null!=c)?(i=new pe(v,a,u||_||0,0,i,-1,a,!1,0,p,c),i.xs0="none"!==c||"display"!==a&&-1===a.indexOf("Style")?c:p):j("invalid "+a+" tween value: "+e[a]):(i=new pe(v,a,_,u-_,i,0,a,l!==!1&&("px"===m||"zIndex"===a),0,p,c),i.xs0=m)):i=ce(v,a,p,c,!0,null,i,0,n)),n&&i&&!i.plugin&&(i.plugin=n);
return i},h.setRatio=function(t){var e,i,s,r=this._firstPT,n=1e-6;if(1!==t||this._tween._time!==this._tween._duration&&0!==this._tween._time)if(t||this._tween._time!==this._tween._duration&&0!==this._tween._time||this._tween._rawPrevTime===-1e-6)for(;r;){if(e=r.c*t+r.s,r.r?e=Math.round(e):n>e&&e>-n&&(e=0),r.type)if(1===r.type)if(s=r.l,2===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2;else if(3===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3;else if(4===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3+r.xn3+r.xs4;else if(5===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3+r.xn3+r.xs4+r.xn4+r.xs5;else{for(i=r.xs0+e+r.xs1,s=1;r.l>s;s++)i+=r["xn"+s]+r["xs"+(s+1)];r.t[r.p]=i}else-1===r.type?r.t[r.p]=r.xs0:r.setRatio&&r.setRatio(t);else r.t[r.p]=e+r.xs0;r=r._next}else for(;r;)2!==r.type?r.t[r.p]=r.b:r.setRatio(t),r=r._next;else for(;r;)2!==r.type?r.t[r.p]=r.e:r.setRatio(t),r=r._next},h._enableTransforms=function(t){this._transformType=t||3===this._transformType?3:2,this._transform=this._transform||Pe(this._target,r,!0)};var Me=function(){this.t[this.p]=this.e,this.data._linkCSSP(this,this._next,null,!0)};h._addLazySet=function(t,e,i){var s=this._firstPT=new pe(t,e,0,0,this._firstPT,2);s.e=i,s.setRatio=Me,s.data=this},h._linkCSSP=function(t,e,i,s){return t&&(e&&(e._prev=t),t._next&&(t._next._prev=t._prev),t._prev?t._prev._next=t._next:this._firstPT===t&&(this._firstPT=t._next,s=!0),i?i._next=t:s||null!==this._firstPT||(this._firstPT=t),t._next=e,t._prev=i),t},h._kill=function(e){var i,s,r,n=e;if(e.autoAlpha||e.alpha){n={};for(s in e)n[s]=e[s];n.opacity=1,n.autoAlpha&&(n.visibility=1)}return e.className&&(i=this._classNamePT)&&(r=i.xfirst,r&&r._prev?this._linkCSSP(r._prev,i._next,r._prev._prev):r===this._firstPT&&(this._firstPT=i._next),i._next&&this._linkCSSP(i._next,i._next._next,r._prev),this._classNamePT=null),t.prototype._kill.call(this,n)};var ze=function(t,e,i){var s,r,n,a;if(t.slice)for(r=t.length;--r>-1;)ze(t[r],e,i);else for(s=t.childNodes,r=s.length;--r>-1;)n=s[r],a=n.type,n.style&&(e.push($(n)),i&&i.push(n)),1!==a&&9!==a&&11!==a||!n.childNodes.length||ze(n,e,i)};return a.cascadeTo=function(t,i,s){var r,n,a,o=e.to(t,i,s),h=[o],l=[],_=[],u=[],p=e._internals.reservedProps;for(t=o._targets||o.target,ze(t,l,u),o.render(i,!0),ze(t,_),o.render(0,!0),o._enabled(!0),r=u.length;--r>-1;)if(n=H(u[r],l[r],_[r]),n.firstMPT){n=n.difs;for(a in s)p[a]&&(n[a]=s[a]);h.push(e.to(u[r],i,n))}return h},t.activate([a]),a},!0),function(){var t=_gsScope._gsDefine.plugin({propName:"roundProps",priority:-1,API:2,init:function(t,e,i){return this._tween=i,!0}}),e=t.prototype;e._onInitAllProps=function(){for(var t,e,i,s=this._tween,r=s.vars.roundProps instanceof Array?s.vars.roundProps:s.vars.roundProps.split(","),n=r.length,a={},o=s._propLookup.roundProps;--n>-1;)a[r[n]]=1;for(n=r.length;--n>-1;)for(t=r[n],e=s._firstPT;e;)i=e._next,e.pg?e.t._roundProps(a,!0):e.n===t&&(this._add(e.t,t,e.s,e.c),i&&(i._prev=e._prev),e._prev?e._prev._next=i:s._firstPT===e&&(s._firstPT=i),e._next=e._prev=null,s._propLookup[t]=o),e=i;return!1},e._add=function(t,e,i,s){this._addTween(t,e,i,i+s,e,!0),this._overwriteProps.push(e)}}(),_gsScope._gsDefine.plugin({propName:"attr",API:2,version:"0.3.3",init:function(t,e){var i,s,r;if("function"!=typeof t.setAttribute)return!1;this._target=t,this._proxy={},this._start={},this._end={};for(i in e)this._start[i]=this._proxy[i]=s=t.getAttribute(i),r=this._addTween(this._proxy,i,parseFloat(s),e[i],i),this._end[i]=r?r.s+r.c:e[i],this._overwriteProps.push(i);return!0},set:function(t){this._super.setRatio.call(this,t);for(var e,i=this._overwriteProps,s=i.length,r=1===t?this._end:t?this._proxy:this._start;--s>-1;)e=i[s],this._target.setAttribute(e,r[e]+"")}}),_gsScope._gsDefine.plugin({propName:"directionalRotation",version:"0.2.1",API:2,init:function(t,e){"object"!=typeof e&&(e={rotation:e}),this.finals={};var i,s,r,n,a,o,h=e.useRadians===!0?2*Math.PI:360,l=1e-6;for(i in e)"useRadians"!==i&&(o=(e[i]+"").split("_"),s=o[0],r=parseFloat("function"!=typeof t[i]?t[i]:t[i.indexOf("set")||"function"!=typeof t["get"+i.substr(3)]?i:"get"+i.substr(3)]()),n=this.finals[i]="string"==typeof s&&"="===s.charAt(1)?r+parseInt(s.charAt(0)+"1",10)*Number(s.substr(2)):Number(s)||0,a=n-r,o.length&&(s=o.join("_"),-1!==s.indexOf("short")&&(a%=h,a!==a%(h/2)&&(a=0>a?a+h:a-h)),-1!==s.indexOf("_cw")&&0>a?a=(a+9999999999*h)%h-(0|a/h)*h:-1!==s.indexOf("ccw")&&a>0&&(a=(a-9999999999*h)%h-(0|a/h)*h)),(a>l||-l>a)&&(this._addTween(t,i,r,r+a,i),this._overwriteProps.push(i)));return!0},set:function(t){var e;if(1!==t)this._super.setRatio.call(this,t);else for(e=this._firstPT;e;)e.f?e.t[e.p](this.finals[e.p]):e.t[e.p]=this.finals[e.p],e=e._next}})._autoCSS=!0,_gsScope._gsDefine("easing.Back",["easing.Ease"],function(t){var e,i,s,r=_gsScope.GreenSockGlobals||_gsScope,n=r.com.greensock,a=2*Math.PI,o=Math.PI/2,h=n._class,l=function(e,i){var s=h("easing."+e,function(){},!0),r=s.prototype=new t;return r.constructor=s,r.getRatio=i,s},_=t.register||function(){},u=function(t,e,i,s){var r=h("easing."+t,{easeOut:new e,easeIn:new i,easeInOut:new s},!0);return _(r,t),r},p=function(t,e,i){this.t=t,this.v=e,i&&(this.next=i,i.prev=this,this.c=i.v-e,this.gap=i.t-t)},c=function(e,i){var s=h("easing."+e,function(t){this._p1=t||0===t?t:1.70158,this._p2=1.525*this._p1},!0),r=s.prototype=new t;return r.constructor=s,r.getRatio=i,r.config=function(t){return new s(t)},s},f=u("Back",c("BackOut",function(t){return(t-=1)*t*((this._p1+1)*t+this._p1)+1}),c("BackIn",function(t){return t*t*((this._p1+1)*t-this._p1)}),c("BackInOut",function(t){return 1>(t*=2)?.5*t*t*((this._p2+1)*t-this._p2):.5*((t-=2)*t*((this._p2+1)*t+this._p2)+2)})),m=h("easing.SlowMo",function(t,e,i){e=e||0===e?e:.7,null==t?t=.7:t>1&&(t=1),this._p=1!==t?e:0,this._p1=(1-t)/2,this._p2=t,this._p3=this._p1+this._p2,this._calcEnd=i===!0},!0),d=m.prototype=new t;return d.constructor=m,d.getRatio=function(t){var e=t+(.5-t)*this._p;return this._p1>t?this._calcEnd?1-(t=1-t/this._p1)*t:e-(t=1-t/this._p1)*t*t*t*e:t>this._p3?this._calcEnd?1-(t=(t-this._p3)/this._p1)*t:e+(t-e)*(t=(t-this._p3)/this._p1)*t*t*t:this._calcEnd?1:e},m.ease=new m(.7,.7),d.config=m.config=function(t,e,i){return new m(t,e,i)},e=h("easing.SteppedEase",function(t){t=t||1,this._p1=1/t,this._p2=t+1},!0),d=e.prototype=new t,d.constructor=e,d.getRatio=function(t){return 0>t?t=0:t>=1&&(t=.999999999),(this._p2*t>>0)*this._p1},d.config=e.config=function(t){return new e(t)},i=h("easing.RoughEase",function(e){e=e||{};for(var i,s,r,n,a,o,h=e.taper||"none",l=[],_=0,u=0|(e.points||20),c=u,f=e.randomize!==!1,m=e.clamp===!0,d=e.template instanceof t?e.template:null,g="number"==typeof e.strength?.4*e.strength:.4;--c>-1;)i=f?Math.random():1/u*c,s=d?d.getRatio(i):i,"none"===h?r=g:"out"===h?(n=1-i,r=n*n*g):"in"===h?r=i*i*g:.5>i?(n=2*i,r=.5*n*n*g):(n=2*(1-i),r=.5*n*n*g),f?s+=Math.random()*r-.5*r:c%2?s+=.5*r:s-=.5*r,m&&(s>1?s=1:0>s&&(s=0)),l[_++]={x:i,y:s};for(l.sort(function(t,e){return t.x-e.x}),o=new p(1,1,null),c=u;--c>-1;)a=l[c],o=new p(a.x,a.y,o);this._prev=new p(0,0,0!==o.t?o:o.next)},!0),d=i.prototype=new t,d.constructor=i,d.getRatio=function(t){var e=this._prev;if(t>e.t){for(;e.next&&t>=e.t;)e=e.next;e=e.prev}else for(;e.prev&&e.t>=t;)e=e.prev;return this._prev=e,e.v+(t-e.t)/e.gap*e.c},d.config=function(t){return new i(t)},i.ease=new i,u("Bounce",l("BounceOut",function(t){return 1/2.75>t?7.5625*t*t:2/2.75>t?7.5625*(t-=1.5/2.75)*t+.75:2.5/2.75>t?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375}),l("BounceIn",function(t){return 1/2.75>(t=1-t)?1-7.5625*t*t:2/2.75>t?1-(7.5625*(t-=1.5/2.75)*t+.75):2.5/2.75>t?1-(7.5625*(t-=2.25/2.75)*t+.9375):1-(7.5625*(t-=2.625/2.75)*t+.984375)}),l("BounceInOut",function(t){var e=.5>t;return t=e?1-2*t:2*t-1,t=1/2.75>t?7.5625*t*t:2/2.75>t?7.5625*(t-=1.5/2.75)*t+.75:2.5/2.75>t?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375,e?.5*(1-t):.5*t+.5})),u("Circ",l("CircOut",function(t){return Math.sqrt(1-(t-=1)*t)}),l("CircIn",function(t){return-(Math.sqrt(1-t*t)-1)}),l("CircInOut",function(t){return 1>(t*=2)?-.5*(Math.sqrt(1-t*t)-1):.5*(Math.sqrt(1-(t-=2)*t)+1)})),s=function(e,i,s){var r=h("easing."+e,function(t,e){this._p1=t||1,this._p2=e||s,this._p3=this._p2/a*(Math.asin(1/this._p1)||0)},!0),n=r.prototype=new t;return n.constructor=r,n.getRatio=i,n.config=function(t,e){return new r(t,e)},r},u("Elastic",s("ElasticOut",function(t){return this._p1*Math.pow(2,-10*t)*Math.sin((t-this._p3)*a/this._p2)+1},.3),s("ElasticIn",function(t){return-(this._p1*Math.pow(2,10*(t-=1))*Math.sin((t-this._p3)*a/this._p2))},.3),s("ElasticInOut",function(t){return 1>(t*=2)?-.5*this._p1*Math.pow(2,10*(t-=1))*Math.sin((t-this._p3)*a/this._p2):.5*this._p1*Math.pow(2,-10*(t-=1))*Math.sin((t-this._p3)*a/this._p2)+1},.45)),u("Expo",l("ExpoOut",function(t){return 1-Math.pow(2,-10*t)}),l("ExpoIn",function(t){return Math.pow(2,10*(t-1))-.001}),l("ExpoInOut",function(t){return 1>(t*=2)?.5*Math.pow(2,10*(t-1)):.5*(2-Math.pow(2,-10*(t-1)))})),u("Sine",l("SineOut",function(t){return Math.sin(t*o)}),l("SineIn",function(t){return-Math.cos(t*o)+1}),l("SineInOut",function(t){return-.5*(Math.cos(Math.PI*t)-1)})),h("easing.EaseLookup",{find:function(e){return t.map[e]}},!0),_(r.SlowMo,"SlowMo","ease,"),_(i,"RoughEase","ease,"),_(e,"SteppedEase","ease,"),f},!0)}),_gsScope._gsDefine&&_gsScope._gsQueue.pop()(),function(t,e){"use strict";var i=t.GreenSockGlobals=t.GreenSockGlobals||t;if(!i.TweenLite){var s,r,n,a,o,h=function(t){var e,s=t.split("."),r=i;for(e=0;s.length>e;e++)r[s[e]]=r=r[s[e]]||{};return r},l=h("com.greensock"),_=1e-10,u=function(t){var e,i=[],s=t.length;for(e=0;e!==s;i.push(t[e++]));return i},p=function(){},c=function(){var t=Object.prototype.toString,e=t.call([]);return function(i){return null!=i&&(i instanceof Array||"object"==typeof i&&!!i.push&&t.call(i)===e)}}(),f={},m=function(s,r,n,a){this.sc=f[s]?f[s].sc:[],f[s]=this,this.gsClass=null,this.func=n;var o=[];this.check=function(l){for(var _,u,p,c,d=r.length,g=d;--d>-1;)(_=f[r[d]]||new m(r[d],[])).gsClass?(o[d]=_.gsClass,g--):l&&_.sc.push(this);if(0===g&&n)for(u=("com.greensock."+s).split("."),p=u.pop(),c=h(u.join("."))[p]=this.gsClass=n.apply(n,o),a&&(i[p]=c,"function"==typeof define&&define.amd?define((t.GreenSockAMDPath?t.GreenSockAMDPath+"/":"")+s.split(".").pop(),[],function(){return c}):s===e&&"undefined"!=typeof module&&module.exports&&(module.exports=c)),d=0;this.sc.length>d;d++)this.sc[d].check()},this.check(!0)},d=t._gsDefine=function(t,e,i,s){return new m(t,e,i,s)},g=l._class=function(t,e,i){return e=e||function(){},d(t,[],function(){return e},i),e};d.globals=i;var v=[0,0,1,1],y=[],T=g("easing.Ease",function(t,e,i,s){this._func=t,this._type=i||0,this._power=s||0,this._params=e?v.concat(e):v},!0),w=T.map={},x=T.register=function(t,e,i,s){for(var r,n,a,o,h=e.split(","),_=h.length,u=(i||"easeIn,easeOut,easeInOut").split(",");--_>-1;)for(n=h[_],r=s?g("easing."+n,null,!0):l.easing[n]||{},a=u.length;--a>-1;)o=u[a],w[n+"."+o]=w[o+n]=r[o]=t.getRatio?t:t[o]||new t};for(n=T.prototype,n._calcEnd=!1,n.getRatio=function(t){if(this._func)return this._params[0]=t,this._func.apply(null,this._params);var e=this._type,i=this._power,s=1===e?1-t:2===e?t:.5>t?2*t:2*(1-t);return 1===i?s*=s:2===i?s*=s*s:3===i?s*=s*s*s:4===i&&(s*=s*s*s*s),1===e?1-s:2===e?s:.5>t?s/2:1-s/2},s=["Linear","Quad","Cubic","Quart","Quint,Strong"],r=s.length;--r>-1;)n=s[r]+",Power"+r,x(new T(null,null,1,r),n,"easeOut",!0),x(new T(null,null,2,r),n,"easeIn"+(0===r?",easeNone":"")),x(new T(null,null,3,r),n,"easeInOut");w.linear=l.easing.Linear.easeIn,w.swing=l.easing.Quad.easeInOut;var b=g("events.EventDispatcher",function(t){this._listeners={},this._eventTarget=t||this});n=b.prototype,n.addEventListener=function(t,e,i,s,r){r=r||0;var n,h,l=this._listeners[t],_=0;for(null==l&&(this._listeners[t]=l=[]),h=l.length;--h>-1;)n=l[h],n.c===e&&n.s===i?l.splice(h,1):0===_&&r>n.pr&&(_=h+1);l.splice(_,0,{c:e,s:i,up:s,pr:r}),this!==a||o||a.wake()},n.removeEventListener=function(t,e){var i,s=this._listeners[t];if(s)for(i=s.length;--i>-1;)if(s[i].c===e)return s.splice(i,1),void 0},n.dispatchEvent=function(t){var e,i,s,r=this._listeners[t];if(r)for(e=r.length,i=this._eventTarget;--e>-1;)s=r[e],s.up?s.c.call(s.s||i,{type:t,target:i}):s.c.call(s.s||i)};var P=t.requestAnimationFrame,S=t.cancelAnimationFrame,k=Date.now||function(){return(new Date).getTime()},R=k();for(s=["ms","moz","webkit","o"],r=s.length;--r>-1&&!P;)P=t[s[r]+"RequestAnimationFrame"],S=t[s[r]+"CancelAnimationFrame"]||t[s[r]+"CancelRequestAnimationFrame"];g("Ticker",function(t,e){var i,s,r,n,h,l=this,u=k(),c=e!==!1&&P,f=500,m=33,d=function(t){var e,a,o=k()-R;o>f&&(u+=o-m),R+=o,l.time=(R-u)/1e3,e=l.time-h,(!i||e>0||t===!0)&&(l.frame++,h+=e+(e>=n?.004:n-e),a=!0),t!==!0&&(r=s(d)),a&&l.dispatchEvent("tick")};b.call(l),l.time=l.frame=0,l.tick=function(){d(!0)},l.lagSmoothing=function(t,e){f=t||1/_,m=Math.min(e,f,0)},l.sleep=function(){null!=r&&(c&&S?S(r):clearTimeout(r),s=p,r=null,l===a&&(o=!1))},l.wake=function(){null!==r?l.sleep():l.frame>10&&(R=k()-f+5),s=0===i?p:c&&P?P:function(t){return setTimeout(t,0|1e3*(h-l.time)+1)},l===a&&(o=!0),d(2)},l.fps=function(t){return arguments.length?(i=t,n=1/(i||60),h=this.time+n,l.wake(),void 0):i},l.useRAF=function(t){return arguments.length?(l.sleep(),c=t,l.fps(i),void 0):c},l.fps(t),setTimeout(function(){c&&(!r||5>l.frame)&&l.useRAF(!1)},1500)}),n=l.Ticker.prototype=new l.events.EventDispatcher,n.constructor=l.Ticker;var A=g("core.Animation",function(t,e){if(this.vars=e=e||{},this._duration=this._totalDuration=t||0,this._delay=Number(e.delay)||0,this._timeScale=1,this._active=e.immediateRender===!0,this.data=e.data,this._reversed=e.reversed===!0,B){o||a.wake();var i=this.vars.useFrames?j:B;i.add(this,i._time),this.vars.paused&&this.paused(!0)}});a=A.ticker=new l.Ticker,n=A.prototype,n._dirty=n._gc=n._initted=n._paused=!1,n._totalTime=n._time=0,n._rawPrevTime=-1,n._next=n._last=n._onUpdate=n._timeline=n.timeline=null,n._paused=!1;var C=function(){o&&k()-R>2e3&&a.wake(),setTimeout(C,2e3)};C(),n.play=function(t,e){return null!=t&&this.seek(t,e),this.reversed(!1).paused(!1)},n.pause=function(t,e){return null!=t&&this.seek(t,e),this.paused(!0)},n.resume=function(t,e){return null!=t&&this.seek(t,e),this.paused(!1)},n.seek=function(t,e){return this.totalTime(Number(t),e!==!1)},n.restart=function(t,e){return this.reversed(!1).paused(!1).totalTime(t?-this._delay:0,e!==!1,!0)},n.reverse=function(t,e){return null!=t&&this.seek(t||this.totalDuration(),e),this.reversed(!0).paused(!1)},n.render=function(){},n.invalidate=function(){return this},n.isActive=function(){var t,e=this._timeline,i=this._startTime;return!e||!this._gc&&!this._paused&&e.isActive()&&(t=e.rawTime())>=i&&i+this.totalDuration()/this._timeScale>t},n._enabled=function(t,e){return o||a.wake(),this._gc=!t,this._active=this.isActive(),e!==!0&&(t&&!this.timeline?this._timeline.add(this,this._startTime-this._delay):!t&&this.timeline&&this._timeline._remove(this,!0)),!1},n._kill=function(){return this._enabled(!1,!1)},n.kill=function(t,e){return this._kill(t,e),this},n._uncache=function(t){for(var e=t?this:this.timeline;e;)e._dirty=!0,e=e.timeline;return this},n._swapSelfInParams=function(t){for(var e=t.length,i=t.concat();--e>-1;)"{self}"===t[e]&&(i[e]=this);return i},n.eventCallback=function(t,e,i,s){if("on"===(t||"").substr(0,2)){var r=this.vars;if(1===arguments.length)return r[t];null==e?delete r[t]:(r[t]=e,r[t+"Params"]=c(i)&&-1!==i.join("").indexOf("{self}")?this._swapSelfInParams(i):i,r[t+"Scope"]=s),"onUpdate"===t&&(this._onUpdate=e)}return this},n.delay=function(t){return arguments.length?(this._timeline.smoothChildTiming&&this.startTime(this._startTime+t-this._delay),this._delay=t,this):this._delay},n.duration=function(t){return arguments.length?(this._duration=this._totalDuration=t,this._uncache(!0),this._timeline.smoothChildTiming&&this._time>0&&this._time<this._duration&&0!==t&&this.totalTime(this._totalTime*(t/this._duration),!0),this):(this._dirty=!1,this._duration)},n.totalDuration=function(t){return this._dirty=!1,arguments.length?this.duration(t):this._totalDuration},n.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),this.totalTime(t>this._duration?this._duration:t,e)):this._time},n.totalTime=function(t,e,i){if(o||a.wake(),!arguments.length)return this._totalTime;if(this._timeline){if(0>t&&!i&&(t+=this.totalDuration()),this._timeline.smoothChildTiming){this._dirty&&this.totalDuration();var s=this._totalDuration,r=this._timeline;if(t>s&&!i&&(t=s),this._startTime=(this._paused?this._pauseTime:r._time)-(this._reversed?s-t:t)/this._timeScale,r._dirty||this._uncache(!1),r._timeline)for(;r._timeline;)r._timeline._time!==(r._startTime+r._totalTime)/r._timeScale&&r.totalTime(r._totalTime,!0),r=r._timeline}this._gc&&this._enabled(!0,!1),(this._totalTime!==t||0===this._duration)&&(this.render(t,e,!1),I.length&&q())}return this},n.progress=n.totalProgress=function(t,e){return arguments.length?this.totalTime(this.duration()*t,e):this._time/this.duration()},n.startTime=function(t){return arguments.length?(t!==this._startTime&&(this._startTime=t,this.timeline&&this.timeline._sortChildren&&this.timeline.add(this,t-this._delay)),this):this._startTime},n.timeScale=function(t){if(!arguments.length)return this._timeScale;if(t=t||_,this._timeline&&this._timeline.smoothChildTiming){var e=this._pauseTime,i=e||0===e?e:this._timeline.totalTime();this._startTime=i-(i-this._startTime)*this._timeScale/t}return this._timeScale=t,this._uncache(!1)},n.reversed=function(t){return arguments.length?(t!=this._reversed&&(this._reversed=t,this.totalTime(this._timeline&&!this._timeline.smoothChildTiming?this.totalDuration()-this._totalTime:this._totalTime,!0)),this):this._reversed},n.paused=function(t){if(!arguments.length)return this._paused;if(t!=this._paused&&this._timeline){o||t||a.wake();var e=this._timeline,i=e.rawTime(),s=i-this._pauseTime;!t&&e.smoothChildTiming&&(this._startTime+=s,this._uncache(!1)),this._pauseTime=t?i:null,this._paused=t,this._active=this.isActive(),!t&&0!==s&&this._initted&&this.duration()&&this.render(e.smoothChildTiming?this._totalTime:(i-this._startTime)/this._timeScale,!0,!0)}return this._gc&&!t&&this._enabled(!0,!1),this};var O=g("core.SimpleTimeline",function(t){A.call(this,0,t),this.autoRemoveChildren=this.smoothChildTiming=!0});n=O.prototype=new A,n.constructor=O,n.kill()._gc=!1,n._first=n._last=null,n._sortChildren=!1,n.add=n.insert=function(t,e){var i,s;if(t._startTime=Number(e||0)+t._delay,t._paused&&this!==t._timeline&&(t._pauseTime=t._startTime+(this.rawTime()-t._startTime)/t._timeScale),t.timeline&&t.timeline._remove(t,!0),t.timeline=t._timeline=this,t._gc&&t._enabled(!0,!0),i=this._last,this._sortChildren)for(s=t._startTime;i&&i._startTime>s;)i=i._prev;return i?(t._next=i._next,i._next=t):(t._next=this._first,this._first=t),t._next?t._next._prev=t:this._last=t,t._prev=i,this._timeline&&this._uncache(!0),this},n._remove=function(t,e){return t.timeline===this&&(e||t._enabled(!1,!0),t._prev?t._prev._next=t._next:this._first===t&&(this._first=t._next),t._next?t._next._prev=t._prev:this._last===t&&(this._last=t._prev),t._next=t._prev=t.timeline=null,this._timeline&&this._uncache(!0)),this},n.render=function(t,e,i){var s,r=this._first;for(this._totalTime=this._time=this._rawPrevTime=t;r;)s=r._next,(r._active||t>=r._startTime&&!r._paused)&&(r._reversed?r.render((r._dirty?r.totalDuration():r._totalDuration)-(t-r._startTime)*r._timeScale,e,i):r.render((t-r._startTime)*r._timeScale,e,i)),r=s},n.rawTime=function(){return o||a.wake(),this._totalTime};var D=g("TweenLite",function(e,i,s){if(A.call(this,i,s),this.render=D.prototype.render,null==e)throw"Cannot tween a null target.";this.target=e="string"!=typeof e?e:D.selector(e)||e;var r,n,a,o=e.jquery||e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType),h=this.vars.overwrite;if(this._overwrite=h=null==h?Y[D.defaultOverwrite]:"number"==typeof h?h>>0:Y[h],(o||e instanceof Array||e.push&&c(e))&&"number"!=typeof e[0])for(this._targets=a=u(e),this._propLookup=[],this._siblings=[],r=0;a.length>r;r++)n=a[r],n?"string"!=typeof n?n.length&&n!==t&&n[0]&&(n[0]===t||n[0].nodeType&&n[0].style&&!n.nodeType)?(a.splice(r--,1),this._targets=a=a.concat(u(n))):(this._siblings[r]=V(n,this,!1),1===h&&this._siblings[r].length>1&&G(n,this,null,1,this._siblings[r])):(n=a[r--]=D.selector(n),"string"==typeof n&&a.splice(r+1,1)):a.splice(r--,1);else this._propLookup={},this._siblings=V(e,this,!1),1===h&&this._siblings.length>1&&G(e,this,null,1,this._siblings);(this.vars.immediateRender||0===i&&0===this._delay&&this.vars.immediateRender!==!1)&&(this._time=-_,this.render(-this._delay))},!0),M=function(e){return e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType)},z=function(t,e){var i,s={};for(i in t)U[i]||i in e&&"transform"!==i&&"x"!==i&&"y"!==i&&"width"!==i&&"height"!==i&&"className"!==i&&"border"!==i||!(!F[i]||F[i]&&F[i]._autoCSS)||(s[i]=t[i],delete t[i]);t.css=s};n=D.prototype=new A,n.constructor=D,n.kill()._gc=!1,n.ratio=0,n._firstPT=n._targets=n._overwrittenProps=n._startAt=null,n._notifyPluginsOfEnabled=n._lazy=!1,D.version="1.13.1",D.defaultEase=n._ease=new T(null,null,1,1),D.defaultOverwrite="auto",D.ticker=a,D.autoSleep=!0,D.lagSmoothing=function(t,e){a.lagSmoothing(t,e)},D.selector=t.$||t.jQuery||function(e){var i=t.$||t.jQuery;return i?(D.selector=i,i(e)):"undefined"==typeof document?e:document.querySelectorAll?document.querySelectorAll(e):document.getElementById("#"===e.charAt(0)?e.substr(1):e)};var I=[],E={},L=D._internals={isArray:c,isSelector:M,lazyTweens:I},F=D._plugins={},N=L.tweenLookup={},X=0,U=L.reservedProps={ease:1,delay:1,overwrite:1,onComplete:1,onCompleteParams:1,onCompleteScope:1,useFrames:1,runBackwards:1,startAt:1,onUpdate:1,onUpdateParams:1,onUpdateScope:1,onStart:1,onStartParams:1,onStartScope:1,onReverseComplete:1,onReverseCompleteParams:1,onReverseCompleteScope:1,onRepeat:1,onRepeatParams:1,onRepeatScope:1,easeParams:1,yoyo:1,immediateRender:1,repeat:1,repeatDelay:1,data:1,paused:1,reversed:1,autoCSS:1,lazy:1},Y={none:0,all:1,auto:2,concurrent:3,allOnStart:4,preexisting:5,"true":1,"false":0},j=A._rootFramesTimeline=new O,B=A._rootTimeline=new O,q=L.lazyRender=function(){var t=I.length;for(E={};--t>-1;)s=I[t],s&&s._lazy!==!1&&(s.render(s._lazy,!1,!0),s._lazy=!1);I.length=0};B._startTime=a.time,j._startTime=a.frame,B._active=j._active=!0,setTimeout(q,1),A._updateRoot=D.render=function(){var t,e,i;if(I.length&&q(),B.render((a.time-B._startTime)*B._timeScale,!1,!1),j.render((a.frame-j._startTime)*j._timeScale,!1,!1),I.length&&q(),!(a.frame%120)){for(i in N){for(e=N[i].tweens,t=e.length;--t>-1;)e[t]._gc&&e.splice(t,1);0===e.length&&delete N[i]}if(i=B._first,(!i||i._paused)&&D.autoSleep&&!j._first&&1===a._listeners.tick.length){for(;i&&i._paused;)i=i._next;i||a.sleep()}}},a.addEventListener("tick",A._updateRoot);var V=function(t,e,i){var s,r,n=t._gsTweenID;if(N[n||(t._gsTweenID=n="t"+X++)]||(N[n]={target:t,tweens:[]}),e&&(s=N[n].tweens,s[r=s.length]=e,i))for(;--r>-1;)s[r]===e&&s.splice(r,1);return N[n].tweens},G=function(t,e,i,s,r){var n,a,o,h;if(1===s||s>=4){for(h=r.length,n=0;h>n;n++)if((o=r[n])!==e)o._gc||o._enabled(!1,!1)&&(a=!0);else if(5===s)break;return a}var l,u=e._startTime+_,p=[],c=0,f=0===e._duration;for(n=r.length;--n>-1;)(o=r[n])===e||o._gc||o._paused||(o._timeline!==e._timeline?(l=l||W(e,0,f),0===W(o,l,f)&&(p[c++]=o)):u>=o._startTime&&o._startTime+o.totalDuration()/o._timeScale>u&&((f||!o._initted)&&2e-10>=u-o._startTime||(p[c++]=o)));for(n=c;--n>-1;)o=p[n],2===s&&o._kill(i,t)&&(a=!0),(2!==s||!o._firstPT&&o._initted)&&o._enabled(!1,!1)&&(a=!0);return a},W=function(t,e,i){for(var s=t._timeline,r=s._timeScale,n=t._startTime;s._timeline;){if(n+=s._startTime,r*=s._timeScale,s._paused)return-100;s=s._timeline}return n/=r,n>e?n-e:i&&n===e||!t._initted&&2*_>n-e?_:(n+=t.totalDuration()/t._timeScale/r)>e+_?0:n-e-_};n._init=function(){var t,e,i,s,r,n=this.vars,a=this._overwrittenProps,o=this._duration,h=!!n.immediateRender,l=n.ease;if(n.startAt){this._startAt&&(this._startAt.render(-1,!0),this._startAt.kill()),r={};for(s in n.startAt)r[s]=n.startAt[s];if(r.overwrite=!1,r.immediateRender=!0,r.lazy=h&&n.lazy!==!1,r.startAt=r.delay=null,this._startAt=D.to(this.target,0,r),h)if(this._time>0)this._startAt=null;else if(0!==o)return}else if(n.runBackwards&&0!==o)if(this._startAt)this._startAt.render(-1,!0),this._startAt.kill(),this._startAt=null;else{i={};for(s in n)U[s]&&"autoCSS"!==s||(i[s]=n[s]);if(i.overwrite=0,i.data="isFromStart",i.lazy=h&&n.lazy!==!1,i.immediateRender=h,this._startAt=D.to(this.target,0,i),h){if(0===this._time)return}else this._startAt._init(),this._startAt._enabled(!1)}if(this._ease=l=l?l instanceof T?l:"function"==typeof l?new T(l,n.easeParams):w[l]||D.defaultEase:D.defaultEase,n.easeParams instanceof Array&&l.config&&(this._ease=l.config.apply(l,n.easeParams)),this._easeType=this._ease._type,this._easePower=this._ease._power,this._firstPT=null,this._targets)for(t=this._targets.length;--t>-1;)this._initProps(this._targets[t],this._propLookup[t]={},this._siblings[t],a?a[t]:null)&&(e=!0);else e=this._initProps(this.target,this._propLookup,this._siblings,a);if(e&&D._onPluginEvent("_onInitAllProps",this),a&&(this._firstPT||"function"!=typeof this.target&&this._enabled(!1,!1)),n.runBackwards)for(i=this._firstPT;i;)i.s+=i.c,i.c=-i.c,i=i._next;this._onUpdate=n.onUpdate,this._initted=!0},n._initProps=function(e,i,s,r){var n,a,o,h,l,_;if(null==e)return!1;E[e._gsTweenID]&&q(),this.vars.css||e.style&&e!==t&&e.nodeType&&F.css&&this.vars.autoCSS!==!1&&z(this.vars,e);for(n in this.vars){if(_=this.vars[n],U[n])_&&(_ instanceof Array||_.push&&c(_))&&-1!==_.join("").indexOf("{self}")&&(this.vars[n]=_=this._swapSelfInParams(_,this));else if(F[n]&&(h=new F[n])._onInitTween(e,this.vars[n],this)){for(this._firstPT=l={_next:this._firstPT,t:h,p:"setRatio",s:0,c:1,f:!0,n:n,pg:!0,pr:h._priority},a=h._overwriteProps.length;--a>-1;)i[h._overwriteProps[a]]=this._firstPT;(h._priority||h._onInitAllProps)&&(o=!0),(h._onDisable||h._onEnable)&&(this._notifyPluginsOfEnabled=!0)}else this._firstPT=i[n]=l={_next:this._firstPT,t:e,p:n,f:"function"==typeof e[n],n:n,pg:!1,pr:0},l.s=l.f?e[n.indexOf("set")||"function"!=typeof e["get"+n.substr(3)]?n:"get"+n.substr(3)]():parseFloat(e[n]),l.c="string"==typeof _&&"="===_.charAt(1)?parseInt(_.charAt(0)+"1",10)*Number(_.substr(2)):Number(_)-l.s||0;l&&l._next&&(l._next._prev=l)}return r&&this._kill(r,e)?this._initProps(e,i,s,r):this._overwrite>1&&this._firstPT&&s.length>1&&G(e,this,i,this._overwrite,s)?(this._kill(i,e),this._initProps(e,i,s,r)):(this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration)&&(E[e._gsTweenID]=!0),o)},n.render=function(t,e,i){var s,r,n,a,o=this._time,h=this._duration,l=this._rawPrevTime;if(t>=h)this._totalTime=this._time=h,this.ratio=this._ease._calcEnd?this._ease.getRatio(1):1,this._reversed||(s=!0,r="onComplete"),0===h&&(this._initted||!this.vars.lazy||i)&&(this._startTime===this._timeline._duration&&(t=0),(0===t||0>l||l===_)&&l!==t&&(i=!0,l>_&&(r="onReverseComplete")),this._rawPrevTime=a=!e||t||l===t?t:_);else if(1e-7>t)this._totalTime=this._time=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0,(0!==o||0===h&&l>0&&l!==_)&&(r="onReverseComplete",s=this._reversed),0>t?(this._active=!1,0===h&&(this._initted||!this.vars.lazy||i)&&(l>=0&&(i=!0),this._rawPrevTime=a=!e||t||l===t?t:_)):this._initted||(i=!0);else if(this._totalTime=this._time=t,this._easeType){var u=t/h,p=this._easeType,c=this._easePower;(1===p||3===p&&u>=.5)&&(u=1-u),3===p&&(u*=2),1===c?u*=u:2===c?u*=u*u:3===c?u*=u*u*u:4===c&&(u*=u*u*u*u),this.ratio=1===p?1-u:2===p?u:.5>t/h?u/2:1-u/2}else this.ratio=this._ease.getRatio(t/h);if(this._time!==o||i){if(!this._initted){if(this._init(),!this._initted||this._gc)return;if(!i&&this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration))return this._time=this._totalTime=o,this._rawPrevTime=l,I.push(this),this._lazy=t,void 0;this._time&&!s?this.ratio=this._ease.getRatio(this._time/h):s&&this._ease._calcEnd&&(this.ratio=this._ease.getRatio(0===this._time?0:1))}for(this._lazy!==!1&&(this._lazy=!1),this._active||!this._paused&&this._time!==o&&t>=0&&(this._active=!0),0===o&&(this._startAt&&(t>=0?this._startAt.render(t,e,i):r||(r="_dummyGS")),this.vars.onStart&&(0!==this._time||0===h)&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||y))),n=this._firstPT;n;)n.f?n.t[n.p](n.c*this.ratio+n.s):n.t[n.p]=n.c*this.ratio+n.s,n=n._next;this._onUpdate&&(0>t&&this._startAt&&this._startTime&&this._startAt.render(t,e,i),e||(this._time!==o||s)&&this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||y)),r&&(!this._gc||i)&&(0>t&&this._startAt&&!this._onUpdate&&this._startTime&&this._startAt.render(t,e,i),s&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[r]&&this.vars[r].apply(this.vars[r+"Scope"]||this,this.vars[r+"Params"]||y),0===h&&this._rawPrevTime===_&&a!==_&&(this._rawPrevTime=0))}},n._kill=function(t,e){if("all"===t&&(t=null),null==t&&(null==e||e===this.target))return this._lazy=!1,this._enabled(!1,!1);e="string"!=typeof e?e||this._targets||this.target:D.selector(e)||e;var i,s,r,n,a,o,h,l;if((c(e)||M(e))&&"number"!=typeof e[0])for(i=e.length;--i>-1;)this._kill(t,e[i])&&(o=!0);else{if(this._targets){for(i=this._targets.length;--i>-1;)if(e===this._targets[i]){a=this._propLookup[i]||{},this._overwrittenProps=this._overwrittenProps||[],s=this._overwrittenProps[i]=t?this._overwrittenProps[i]||{}:"all";break}}else{if(e!==this.target)return!1;a=this._propLookup,s=this._overwrittenProps=t?this._overwrittenProps||{}:"all"}if(a){h=t||a,l=t!==s&&"all"!==s&&t!==a&&("object"!=typeof t||!t._tempKill);for(r in h)(n=a[r])&&(n.pg&&n.t._kill(h)&&(o=!0),n.pg&&0!==n.t._overwriteProps.length||(n._prev?n._prev._next=n._next:n===this._firstPT&&(this._firstPT=n._next),n._next&&(n._next._prev=n._prev),n._next=n._prev=null),delete a[r]),l&&(s[r]=1);!this._firstPT&&this._initted&&this._enabled(!1,!1)}}return o},n.invalidate=function(){return this._notifyPluginsOfEnabled&&D._onPluginEvent("_onDisable",this),this._firstPT=null,this._overwrittenProps=null,this._onUpdate=null,this._startAt=null,this._initted=this._active=this._notifyPluginsOfEnabled=this._lazy=!1,this._propLookup=this._targets?{}:[],this},n._enabled=function(t,e){if(o||a.wake(),t&&this._gc){var i,s=this._targets;if(s)for(i=s.length;--i>-1;)this._siblings[i]=V(s[i],this,!0);else this._siblings=V(this.target,this,!0)}return A.prototype._enabled.call(this,t,e),this._notifyPluginsOfEnabled&&this._firstPT?D._onPluginEvent(t?"_onEnable":"_onDisable",this):!1},D.to=function(t,e,i){return new D(t,e,i)},D.from=function(t,e,i){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,new D(t,e,i)},D.fromTo=function(t,e,i,s){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,new D(t,e,s)},D.delayedCall=function(t,e,i,s,r){return new D(e,0,{delay:t,onComplete:e,onCompleteParams:i,onCompleteScope:s,onReverseComplete:e,onReverseCompleteParams:i,onReverseCompleteScope:s,immediateRender:!1,useFrames:r,overwrite:0})},D.set=function(t,e){return new D(t,0,e)},D.getTweensOf=function(t,e){if(null==t)return[];t="string"!=typeof t?t:D.selector(t)||t;var i,s,r,n;if((c(t)||M(t))&&"number"!=typeof t[0]){for(i=t.length,s=[];--i>-1;)s=s.concat(D.getTweensOf(t[i],e));for(i=s.length;--i>-1;)for(n=s[i],r=i;--r>-1;)n===s[r]&&s.splice(i,1)}else for(s=V(t).concat(),i=s.length;--i>-1;)(s[i]._gc||e&&!s[i].isActive())&&s.splice(i,1);return s},D.killTweensOf=D.killDelayedCallsTo=function(t,e,i){"object"==typeof e&&(i=e,e=!1);for(var s=D.getTweensOf(t,e),r=s.length;--r>-1;)s[r]._kill(i,t)};var Q=g("plugins.TweenPlugin",function(t,e){this._overwriteProps=(t||"").split(","),this._propName=this._overwriteProps[0],this._priority=e||0,this._super=Q.prototype},!0);if(n=Q.prototype,Q.version="1.10.1",Q.API=2,n._firstPT=null,n._addTween=function(t,e,i,s,r,n){var a,o;
return null!=s&&(a="number"==typeof s||"="!==s.charAt(1)?Number(s)-i:parseInt(s.charAt(0)+"1",10)*Number(s.substr(2)))?(this._firstPT=o={_next:this._firstPT,t:t,p:e,s:i,c:a,f:"function"==typeof t[e],n:r||e,r:n},o._next&&(o._next._prev=o),o):void 0},n.setRatio=function(t){for(var e,i=this._firstPT,s=1e-6;i;)e=i.c*t+i.s,i.r?e=Math.round(e):s>e&&e>-s&&(e=0),i.f?i.t[i.p](e):i.t[i.p]=e,i=i._next},n._kill=function(t){var e,i=this._overwriteProps,s=this._firstPT;if(null!=t[this._propName])this._overwriteProps=[];else for(e=i.length;--e>-1;)null!=t[i[e]]&&i.splice(e,1);for(;s;)null!=t[s.n]&&(s._next&&(s._next._prev=s._prev),s._prev?(s._prev._next=s._next,s._prev=null):this._firstPT===s&&(this._firstPT=s._next)),s=s._next;return!1},n._roundProps=function(t,e){for(var i=this._firstPT;i;)(t[this._propName]||null!=i.n&&t[i.n.split(this._propName+"_").join("")])&&(i.r=e),i=i._next},D._onPluginEvent=function(t,e){var i,s,r,n,a,o=e._firstPT;if("_onInitAllProps"===t){for(;o;){for(a=o._next,s=r;s&&s.pr>o.pr;)s=s._next;(o._prev=s?s._prev:n)?o._prev._next=o:r=o,(o._next=s)?s._prev=o:n=o,o=a}o=e._firstPT=r}for(;o;)o.pg&&"function"==typeof o.t[t]&&o.t[t]()&&(i=!0),o=o._next;return i},Q.activate=function(t){for(var e=t.length;--e>-1;)t[e].API===Q.API&&(F[(new t[e])._propName]=t[e]);return!0},d.plugin=function(t){if(!(t&&t.propName&&t.init&&t.API))throw"illegal plugin definition.";var e,i=t.propName,s=t.priority||0,r=t.overwriteProps,n={init:"_onInitTween",set:"setRatio",kill:"_kill",round:"_roundProps",initAll:"_onInitAllProps"},a=g("plugins."+i.charAt(0).toUpperCase()+i.substr(1)+"Plugin",function(){Q.call(this,i,s),this._overwriteProps=r||[]},t.global===!0),o=a.prototype=new Q(i);o.constructor=a,a.API=t.API;for(e in n)"function"==typeof t[e]&&(o[n[e]]=t[e]);return a.version=t.version,Q.activate([a]),a},s=t._gsQueue){for(r=0;s.length>r;r++)s[r]();for(n in f)f[n].func||t.console.log("GSAP encountered missing dependency: com.greensock."+n)}o=!1}}("undefined"!=typeof module&&module.exports&&"undefined"!=typeof global?global:this||window,"TweenMax");

/*!
 * VERSION: 0.10.5
 * DATE: 2014-07-17
 * UPDATES AND DOCS AT: http://www.greensock.com
 *
 * Requires TweenLite and CSSPlugin version 1.11.0 or later (TweenMax contains both TweenLite and CSSPlugin). ThrowPropsPlugin is required for momentum-based continuation of movement after the mouse/touch is released (ThrowPropsPlugin is a membership benefit of Club GreenSock - http://www.greensock.com/club/).
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * This work is subject to the terms at http://www.greensock.com/terms_of_use.html or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 */
var _gsScope="undefined"!=typeof module&&module.exports&&"undefined"!=typeof global?global:this||window;(_gsScope._gsQueue||(_gsScope._gsQueue=[])).push(function(){"use strict";_gsScope._gsDefine("utils.Draggable",["events.EventDispatcher","TweenLite"],function(t,e){var i,s,r,n,a,o={css:{}},h={css:{}},l={css:{}},u={css:{}},_={},c=document,p=c.documentElement||{},f=[],d=function(){return!1},m=180/Math.PI,g=999999999999999,v=Date.now||function(){return(new Date).getTime()},y=c.all&&!c.addEventListener,T=[],w={},x=0,b=/^(?:a|input|textarea|button|select)$/i,P=0,S=0,C=function(){for(var t=T.length;--t>-1;)T[t]()},k=function(t){T.push(t),1===T.length&&e.ticker.addEventListener("tick",C,this,!1,1)},R=function(t){for(var i=T.length;--i>-1;)T[i]===t&&T.splice(i,1);e.to(A,0,{overwrite:"all",delay:15,onComplete:A})},A=function(){T.length||e.ticker.removeEventListener("tick",C)},D=function(t,e){var i;for(i in e)void 0===t[i]&&(t[i]=e[i]);return t},O=function(){return null!=window.pageYOffset?window.pageYOffset:null!=c.scrollTop?c.scrollTop:p.scrollTop||c.body.scrollTop||0},M=function(){return null!=window.pageXOffset?window.pageXOffset:null!=c.scrollLeft?c.scrollLeft:p.scrollLeft||c.body.scrollLeft||0},L=function(t,e){return t=t||window.event,_.pageX=t.clientX+c.body.scrollLeft+p.scrollLeft,_.pageY=t.clientY+c.body.scrollTop+p.scrollTop,e&&(t.returnValue=!1),_},I=function(t){return t?("string"==typeof t&&(t=e.selector(t)),t.length&&t!==window&&t[0]&&t[0].style&&!t.nodeType&&(t=t[0]),t===window||t.nodeType&&t.style?t:null):t},E=function(t,e){var s,r,n,a=t.style;if(void 0===a[e]){for(n=["O","Moz","ms","Ms","Webkit"],r=5,s=e.charAt(0).toUpperCase()+e.substr(1);--r>-1&&void 0===a[n[r]+s];);if(0>r)return"";i=3===r?"ms":n[r],e=i+s}return e},N=function(t,e,i){var s=t.style;void 0===s[e]&&(e=E(t,e)),null==i?s.removeProperty?s.removeProperty(e.replace(/([A-Z])/g,"-$1").toLowerCase()):s.removeAttribute(e):void 0!==s[e]&&(s[e]=i)},z=c.defaultView?c.defaultView.getComputedStyle:d,X=/(?:Left|Right|Width)/i,F=/(?:\d|\-|\+|=|#|\.)*/g,Y=function(t,e,i,s,r){if("px"===s||!s)return i;if("auto"===s||!i)return 0;var n,a=X.test(e),o=t,h=q.style,l=0>i;return l&&(i=-i),"%"===s&&-1!==e.indexOf("border")?n=i/100*(a?t.clientWidth:t.clientHeight):(h.cssText="border:0 solid red;position:"+B(t,"position",!0)+";line-height:0;","%"!==s&&o.appendChild?h[a?"borderLeftWidth":"borderTopWidth"]=i+s:(o=t.parentNode||c.body,h[a?"width":"height"]=i+s),o.appendChild(q),n=parseFloat(q[a?"offsetWidth":"offsetHeight"]),o.removeChild(q),0!==n||r||(n=Y(t,e,i,s,!0))),l?-n:n},U=function(t,e){if("absolute"!==B(t,"position",!0))return 0;var i="left"===e?"Left":"Top",s=B(t,"margin"+i,!0);return t["offset"+i]-(Y(t,e,parseFloat(s),s.replace(F,""))||0)},B=function(t,e,i){var s,r=(t._gsTransform||{})[e];return r||0===r?r:(t.style[e]?r=t.style[e]:(s=z(t))?(r=s.getPropertyValue(e.replace(/([A-Z])/g,"-$1").toLowerCase()),r=r||s.length?r:s[e]):t.currentStyle&&(r=t.currentStyle[e]),"auto"!==r||"top"!==e&&"left"!==e||(r=U(t,e)),i?r:parseFloat(r)||0)},j=function(t,e,i){var s=t.vars,r=s[i],n=t._listeners[e];"function"==typeof r&&r.apply(s[i+"Scope"]||t,s[i+"Params"]||[t.pointerEvent]),n&&t.dispatchEvent(e)},W=function(t,e){var i,s,r,n=I(t);return n?ne(n,e):void 0!==t.left?(r=te(e),{left:t.left-r.x,top:t.top-r.y,width:t.width,height:t.height}):(s=t.min||t.minX||t.minRotation||0,i=t.min||t.minY||0,{left:s,top:i,width:(t.max||t.maxX||t.maxRotation||0)-s,height:(t.max||t.maxY||0)-i})},q=c.createElement("div"),H=""!==E(q,"perspective"),G=E(q,"transformOrigin").replace(/^ms/g,"Ms").replace(/([A-Z])/g,"-$1").toLowerCase(),V=E(q,"transform"),Q=V.replace(/^ms/g,"Ms").replace(/([A-Z])/g,"-$1").toLowerCase(),Z={},$={},K=function(){if(!y){var t="http://www.w3.org/2000/svg",e=c.createElementNS(t,"svg"),i=c.createElementNS(t,"rect");return i.setAttributeNS(null,"width","10"),i.setAttributeNS(null,"height","10"),e.appendChild(i),e}}(),J=function(t){if(!t.getBoundingClientRect||!t.parentNode)return{offsetTop:0,offsetLeft:0,offsetParent:p};for(var e,i,s,r=t,n=t.style.cssText;!r.offsetParent&&r.parentNode;)r=r.parentNode;return t.parentNode.insertBefore(K,t),t.parentNode.removeChild(t),K.style.cssText=n,K.style[V]="none",K.setAttribute("class",t.getAttribute("class")),e=K.getBoundingClientRect(),s=r.offsetParent,s?(s===c.body&&p&&(s=p),i=s.getBoundingClientRect()):i={top:-O(),left:-M()},K.parentNode.insertBefore(t,K),t.parentNode.removeChild(K),{offsetLeft:e.left-i.left,offsetTop:e.top-i.top,offsetParent:r.offsetParent||p}},te=function(t,e){if(e=e||{},!t||t===p||!t.parentNode)return{x:0,y:0};var i=z(t),s=G&&i?i.getPropertyValue(G):"50% 50%",r=s.split(" "),n=-1!==s.indexOf("left")?"0%":-1!==s.indexOf("right")?"100%":r[0],a=-1!==s.indexOf("top")?"0%":-1!==s.indexOf("bottom")?"100%":r[1];return("center"===a||null==a)&&(a="50%"),("center"===n||isNaN(parseFloat(n)))&&(n="50%"),e.x=-1!==n.indexOf("%")?t.offsetWidth*parseFloat(n)/100:parseFloat(n),e.y=-1!==a.indexOf("%")?t.offsetHeight*parseFloat(a)/100:parseFloat(a),e},ee=function(t,e,i){var s,r,a,o,h,l;return t!==window&&t&&t.parentNode?(s=z(t),r=s?s.getPropertyValue(Q):t.currentStyle?t.currentStyle[V]:"1,0,0,1,0,0",r=(r+"").match(/(?:\-|\b)[\d\-\.e]+\b/g)||[1,0,0,1,0,0],r.length>6&&(r=[r[0],r[1],r[4],r[5],r[12],r[13]]),e&&(a=t.parentNode,l=void 0===t.offsetLeft&&"svg"===t.nodeName.toLowerCase()?J(t):t,o=l.offsetParent,h=a===p||a===c.body,r[4]=Number(r[4])+e.x+(l.offsetLeft||0)-i.x-(h?0:a.scrollLeft)+(o?parseInt(B(o,"borderLeftWidth"),10)||0:0),r[5]=Number(r[5])+e.y+(l.offsetTop||0)-i.y-(h?0:a.scrollTop)+(o?parseInt(B(o,"borderTopWidth"),10)||0:0),o||"fixed"!==B(t,"position",s)||(r[4]+=M(),r[5]+=O()),void 0===n&&c.body&&V&&(n=function(){var t,e,i=c.createElement("div"),s=c.createElement("div");return s.style.position="absolute",c.body.appendChild(i),i.appendChild(s),t=s.offsetParent,i.style[V]="rotate(1deg)",e=s.offsetParent===t,c.body.removeChild(i),e}()),!a||a.offsetParent!==o||n&&"100100"!==ee(a).join("")||(r[4]-=a.offsetLeft||0,r[5]-=a.offsetTop||0)),r):[1,0,0,1,0,0]},ie=function(t,e){for(var i,s,r,n,a,o,h,l,u=te(t,Z),_=te(t.parentNode,$),c=ee(t,u,_);(t=t.parentNode)&&t.parentNode&&t!==p;)u=_,_=te(t.parentNode,u===Z?$:Z),h=ee(t,u,_),i=c[0],s=c[1],r=c[2],n=c[3],a=c[4],o=c[5],c[0]=i*h[0]+s*h[2],c[1]=i*h[1]+s*h[3],c[2]=r*h[0]+n*h[2],c[3]=r*h[1]+n*h[3],c[4]=a*h[0]+o*h[2]+h[4],c[5]=a*h[1]+o*h[3]+h[5];return e&&(i=c[0],s=c[1],r=c[2],n=c[3],a=c[4],o=c[5],l=i*n-s*r,c[0]=n/l,c[1]=-s/l,c[2]=-r/l,c[3]=i/l,c[4]=(r*o-n*a)/l,c[5]=-(i*o-s*a)/l),c},se=function(t,e,i){var s=ie(t),r=e.x,n=e.y;return i=i===!0?e:i||{},i.x=r*s[0]+n*s[2]+s[4],i.y=r*s[1]+n*s[3]+s[5],i},re=function(t,e,i){var s=t.x*e[0]+t.y*e[2]+e[4],r=t.x*e[1]+t.y*e[3]+e[5];return t.x=s*i[0]+r*i[2]+i[4],t.y=s*i[1]+r*i[3]+i[5],t},ne=function(t,e){var i,s,r,n,a,o,h,l,u,_,f;return t===window?(n=O(),s=M(),r=s+(p.clientWidth||t.innerWidth||c.body.clientWidth||0),a=n+((t.innerHeight||0)-20<p.clientHeight?p.clientHeight:t.innerHeight||c.body.clientHeight||0)):(i=te(t),s=-i.x,r=s+t.offsetWidth,n=-i.y,a=n+t.offsetHeight),t===e?{left:s,top:n,width:r-s,height:a-n}:(o=ie(t),h=ie(e,!0),l=re({x:s,y:n},o,h),u=re({x:r,y:n},o,h),_=re({x:r,y:a},o,h),f=re({x:s,y:a},o,h),s=Math.min(l.x,u.x,_.x,f.x),n=Math.min(l.y,u.y,_.y,f.y),{left:s,top:n,width:Math.max(l.x,u.x,_.x,f.x)-s,height:Math.max(l.y,u.y,_.y,f.y)-n})},ae=function(t){return t.length&&t[0]&&(t[0].nodeType&&t[0].style&&!t.nodeType||t[0].length&&t[0][0])?!0:!1},oe=function(t){var e,i,s,r=[],n=t.length;for(e=0;n>e;e++)if(i=t[e],ae(i))for(s=i.length,s=0;i.length>s;s++)r.push(i[s]);else r.push(i);return r},he="ontouchstart"in p&&"orientation"in window,le=function(t){for(var e=t.split(","),i=(void 0!==q.onpointerdown?"pointerdown,pointermove,pointerup,pointercancel":void 0!==q.onmspointerdown?"MSPointerDown,MSPointerMove,MSPointerUp,MSPointerCancel":t).split(","),s={},r=7;--r>-1;)s[e[r]]=i[r],s[i[r]]=e[r];return s}("touchstart,touchmove,touchend,touchcancel"),ue=function(t,e,i){t.addEventListener?t.addEventListener(le[e]||e,i,!1):t.attachEvent&&t.attachEvent("on"+e,i)},_e=function(t,e,i){t.removeEventListener?t.removeEventListener(le[e]||e,i):t.detachEvent&&t.detachEvent("on"+e,i)},ce=function(t){s=t.touches&&t.touches.length>P,_e(t.target,"touchend",ce)},pe=function(t){s=t.touches&&t.touches.length>P,ue(t.target,"touchend",ce)},fe=function(t,e,i,s,r,n){var a,o,h,l={};if(e)if(1!==r&&e instanceof Array)for(l.end=a=[],h=e.length,o=0;h>o;o++)a[o]=e[o]*r;else l.end="function"==typeof e?function(i){return e.call(t,i)*r}:e;return(i||0===i)&&(l.max=i),(s||0===s)&&(l.min=s),n&&(l.velocity=0),l},de=function(t){var e;return t&&t.getAttribute&&"BODY"!==t.nodeName?"true"===(e=t.getAttribute("data-clickable"))||"false"!==e&&(t.onclick||b.test(t.nodeName+""))?!0:de(t.parentNode):!1},me=function(){var t,e=c.createElement("div"),i=c.createElement("div"),s=i.style,r=c.body||q;return s.display="inline-block",s.position="relative",e.style.cssText=i.innerHTML="width:90px; height:40px; padding:10px; overflow:auto; visibility: hidden",e.appendChild(i),r.appendChild(e),a=i.offsetHeight+18>e.scrollHeight,s.width="100%",V||(s.paddingRight="500px",t=e.scrollLeft=e.scrollWidth-e.clientWidth,s.left="-90px",t=t!==e.scrollLeft),r.removeChild(e),t}(),ge=function(t,i){t=I(t),i=i||{};var s,r,n,o,h,l,u=c.createElement("div"),_=u.style,p=t.firstChild,f=0,d=0,m=t.scrollTop,g=t.scrollLeft,v=t.scrollWidth,T=t.scrollHeight,w=0,x=0,b=0;H&&i.force3D!==!1?(h="translate3d(",l="px,0px)"):V&&(h="translate(",l="px)"),this.scrollTop=function(t,e){return arguments.length?(this.top(-t,e),void 0):-this.top()},this.scrollLeft=function(t,e){return arguments.length?(this.left(-t,e),void 0):-this.left()},this.left=function(s,r){if(!arguments.length)return-(t.scrollLeft+d);var n=t.scrollLeft-g,a=d;return(n>2||-2>n)&&!r?(g=t.scrollLeft,e.killTweensOf(this,!0,{left:1,scrollLeft:1}),this.left(-g),i.onKill&&i.onKill(),void 0):(s=-s,0>s?(d=0|s-.5,s=0):s>x?(d=0|s-x,s=x):d=0,(d||a)&&(h?this._suspendTransforms||(_[V]=h+-d+"px,"+-f+l):_.left=-d+"px",me&&d+w>=0&&(_.paddingRight=d+w+"px")),t.scrollLeft=0|s,g=t.scrollLeft,void 0)},this.top=function(s,r){if(!arguments.length)return-(t.scrollTop+f);var n=t.scrollTop-m,a=f;return(n>2||-2>n)&&!r?(m=t.scrollTop,e.killTweensOf(this,!0,{top:1,scrollTop:1}),this.top(-m),i.onKill&&i.onKill(),void 0):(s=-s,0>s?(f=0|s-.5,s=0):s>b?(f=0|s-b,s=b):f=0,(f||a)&&(h?this._suspendTransforms||(_[V]=h+-d+"px,"+-f+l):_.top=-f+"px"),t.scrollTop=0|s,m=t.scrollTop,void 0)},this.maxScrollTop=function(){return b},this.maxScrollLeft=function(){return x},this.disable=function(){for(p=u.firstChild;p;)o=p.nextSibling,t.appendChild(p),p=o;t===u.parentNode&&t.removeChild(u)},this.enable=function(){if(p=t.firstChild,p!==u){for(;p;)o=p.nextSibling,u.appendChild(p),p=o;t.appendChild(u),this.calibrate()}},this.calibrate=function(e){var i,o,h=t.clientWidth===s;m=t.scrollTop,g=t.scrollLeft,(!h||t.clientHeight!==r||u.offsetHeight!==n||v!==t.scrollWidth||T!==t.scrollHeight||e)&&((f||d)&&(i=this.left(),o=this.top(),this.left(-t.scrollLeft),this.top(-t.scrollTop)),(!h||e)&&(_.display="block",_.width="auto",_.paddingRight="0px",w=Math.max(0,t.scrollWidth-t.clientWidth),w&&(w+=B(t,"paddingLeft")+(a?B(t,"paddingRight"):0))),_.display="inline-block",_.position="relative",_.overflow="visible",_.width="100%",_.paddingRight=w+"px",a&&(_.paddingBottom=B(t,"paddingBottom",!0)),y&&(_.zoom="1"),s=t.clientWidth,r=t.clientHeight,v=t.scrollWidth,T=t.scrollHeight,x=t.scrollWidth-s,b=t.scrollHeight-r,n=u.offsetHeight,(i||o)&&(this.left(i),this.top(o)))},this.content=u,this.element=t,this._suspendTransforms=!1,this.enable()},ve=function(i,n){t.call(this,i),i=I(i),r||(r=(_gsScope.GreenSockGlobals||_gsScope).com.greensock.plugins.ThrowPropsPlugin),this.vars=n=n||{},this.target=i,this.x=this.y=this.rotation=0,this.dragResistance=parseFloat(n.dragResistance)||0,this.edgeResistance=isNaN(n.edgeResistance)?1:parseFloat(n.edgeResistance)||0,this.lockAxis=n.lockAxis;var a,_,p,T,b,C,A,O,M,E,z,X,F,Y,U,q,H,G,V,Q,Z,$,K,J,te,ee,re=(n.type||(y?"top,left":"x,y")).toLowerCase(),ne=-1!==re.indexOf("x")||-1!==re.indexOf("y"),ae=-1!==re.indexOf("rotation"),oe=ne?"x":"left",ce=ne?"y":"top",me=-1!==re.indexOf("x")||-1!==re.indexOf("left")||"scroll"===re,ye=-1!==re.indexOf("y")||-1!==re.indexOf("top")||"scroll"===re,Te=this,we=I(n.trigger||n.handle||i),xe={},be=0,Pe=function(t){if(G){var s=Te.x,r=Te.y,n=1e-6;n>s&&s>-n&&(s=0),n>r&&r>-n&&(r=0),ae?(Y.rotation=Te.rotation=Te.x,e.set(i,F)):_?(ye&&_.top(r),me&&_.left(s)):ne?(ye&&(Y.y=r),me&&(Y.x=s),e.set(i,F)):(ye&&(i.style.top=r+"px"),me&&(i.style.left=s+"px")),O&&!t&&j(Te,"drag","onDrag")}G=!1},Se=function(t,s){var r;ne?(i._gsTransform||e.set(i,{x:"+=0"}),Te.y=i._gsTransform.y,Te.x=i._gsTransform.x):ae?(i._gsTransform||e.set(i,{x:"+=0"}),Te.x=Te.rotation=i._gsTransform.rotation):_?(Te.y=_.top(),Te.x=_.left()):(Te.y=parseInt(i.style.top,10)||0,Te.x=parseInt(i.style.left,10)||0),!Q&&!Z||s||(Q&&(r=Q(Te.x),r!==Te.x&&(Te.x=r,ae&&(Te.rotation=r),G=!0)),Z&&(r=Z(Te.y),r!==Te.y&&(Te.y=r,G=!0)),G&&Pe(!0)),n.onThrowUpdate&&!t&&n.onThrowUpdate.apply(n.onThrowUpdateScope||Te,n.onThrowUpdateParams||f)},Ce=function(){var t,e,s,r;A=!1,_?(_.calibrate(),Te.minX=E=-_.maxScrollLeft(),Te.minY=X=-_.maxScrollTop(),Te.maxX=M=Te.maxY=z=0,A=!0):n.bounds&&(t=W(n.bounds,i.parentNode),ae?(Te.minX=E=t.left,Te.maxX=M=t.left+t.width,Te.minY=X=Te.maxY=z=0):void 0!==n.bounds.maxX||void 0!==n.bounds.maxY?(t=n.bounds,Te.minX=E=t.minX,Te.minY=X=t.minY,Te.maxX=M=t.maxX,Te.maxY=z=t.maxY):(e=W(i,i.parentNode),Te.minX=E=B(i,oe)+t.left-e.left,Te.minY=X=B(i,ce)+t.top-e.top,Te.maxX=M=E+(t.width-e.width),Te.maxY=z=X+(t.height-e.height)),E>M&&(Te.minX=M,Te.maxX=M=E,E=Te.minX),X>z&&(Te.minY=z,Te.maxY=z=X,X=Te.minY),ae&&(Te.minRotation=E,Te.maxRotation=M),A=!0),n.liveSnap&&(s=n.liveSnap===!0?n.snap||{}:n.liveSnap,r=s instanceof Array||"function"==typeof s,ae?(Q=Oe(r?s:s.rotation,E,M,1),Z=null):(me&&(Q=Oe(r?s:s.x||s.left||s.scrollLeft,E,M,_?-1:1)),ye&&(Z=Oe(r?s:s.y||s.top||s.scrollTop,X,z,_?-1:1))))},ke=function(t,e){var s,a,o;t&&r?(t===!0&&(s=n.snap||{},a=s instanceof Array||"function"==typeof s,t={resistance:(n.throwResistance||n.resistance||1e3)/(ae?10:1)},ae?t.rotation=fe(Te,a?s:s.rotation,M,E,1,e):(me&&(t[oe]=fe(Te,a?s:s.x||s.left||s.scrollLeft,M,E,_?-1:1,e||Te.lockAxis&&"x"===J)),ye&&(t[ce]=fe(Te,a?s:s.y||s.top||s.scrollTop,z,X,_?-1:1,e||Te.lockAxis&&"y"===J)))),Te.tween=o=r.to(_||i,{throwProps:t,ease:n.ease||Power3.easeOut,onComplete:n.onThrowComplete,onCompleteParams:n.onThrowCompleteParams,onCompleteScope:n.onThrowCompleteScope||Te,onUpdate:n.fastMode?n.onThrowUpdate:Se,onUpdateParams:n.fastMode?n.onThrowUpdateParams:null,onUpdateScope:n.onThrowUpdateScope||Te},isNaN(n.maxDuration)?2:n.maxDuration,isNaN(n.minDuration)?.5:n.minDuration,isNaN(n.overshootTolerance)?1-Te.edgeResistance+.2:n.overshootTolerance),n.fastMode||(_&&(_._suspendTransforms=!0),o.render(o.duration(),!0,!0),Se(!0,!0),Te.endX=Te.x,Te.endY=Te.y,ae&&(Te.endRotation=Te.x),o.play(0),Se(!0,!0),_&&(_._suspendTransforms=!1))):A&&Te.applyBounds()},Re=function(){te=ie(i.parentNode,!0),te[1]||te[2]||1!=te[0]||1!=te[3]||0!=te[4]||0!=te[5]||(te=null)},Ae=function(){var t=1-Te.edgeResistance;Re(),_?(Ce(),C=_.top(),b=_.left()):(De()?(Se(!0,!0),Ce()):Te.applyBounds(),ae?(H=se(i,{x:0,y:0}),Se(!0,!0),b=Te.x,C=Te.y=Math.atan2(H.y-T,p-H.x)*m):(C=B(i,ce),b=B(i,oe))),A&&t&&(b>M?b=M+(b-M)/t:E>b&&(b=E-(E-b)/t),ae||(C>z?C=z+(C-z)/t:X>C&&(C=X-(X-C)/t)))},De=function(){return Te.tween&&Te.tween.isActive()},Oe=function(t,e,i,s){return"function"==typeof t?function(r){var n=Te.isPressed?1-Te.edgeResistance:1;return t.call(Te,r>i?i+(r-i)*n:e>r?e+(r-e)*n:r)*s}:t instanceof Array?function(s){for(var r,n,a=t.length,o=0,h=g;--a>-1;)r=t[a],n=r-s,0>n&&(n=-n),h>n&&r>=e&&i>=r&&(o=a,h=n);return t[o]}:isNaN(t)?function(t){return t}:function(){return t*s}},Me=function(t){var s;if(a&&!Te.isPressed&&t){if(ee=De(),Te.pointerEvent=t,le[t.type]?(K=-1!==t.type.indexOf("touch")?we:c,ue(K,"touchend",Ie),ue(K,"touchmove",Le),ue(K,"touchcancel",Ie),ue(c,"touchstart",pe)):(K=null,ue(c,"mousemove",Le),ue(c,"mouseup",Ie)),$=de(t.target)&&!n.dragClickables)return ue(t.target,"change",Ie),void 0;y?t=L(t,!0):!_||t.touches&&t.touches.length>P+1||(t.preventDefault(),t.preventManipulation&&t.preventManipulation()),t.changedTouches?(t=U=t.changedTouches[0],q=t.identifier):t.pointerId?q=t.pointerId:U=null,P++,k(Pe),Te.tween&&Te.tween.kill(),e.killTweensOf(_||i,!0,xe),_&&e.killTweensOf(i,!0,{scrollTo:1}),T=Te.pointerY=t.pageY,p=Te.pointerX=t.pageX,Ae(),te&&(s=p*te[0]+T*te[2]+te[4],T=p*te[1]+T*te[3]+te[5],p=s),Te.tween=J=null,ae||_||n.zIndexBoost===!1||(i.style.zIndex=ve.zIndex++),Te.isPressed=!0,O=!(!n.onDrag&&!Te._listeners.drag),ae||N(we,"cursor",n.cursor||"move"),j(Te,"press","onPress")}},Le=function(t){if(a&&!s&&Te.isPressed){y?t=L(t,!0):(t.preventDefault(),t.preventManipulation&&t.preventManipulation()),Te.pointerEvent=t;var e,i,r,n,o,h,l,u,_,c=t.changedTouches,f=1-Te.dragResistance,d=1-Te.edgeResistance;if(c){if(t=c[0],t!==U&&t.identifier!==q){for(o=c.length;--o>-1&&(t=c[o]).identifier!==q;);if(0>o)return}}else if(t.pointerId&&q&&t.pointerId!==q)return;l=Te.pointerX=t.pageX,u=Te.pointerY=t.pageY,ae?(n=Math.atan2(H.y-t.pageY,t.pageX-H.x)*m,h=Te.y-n,Te.y=n,h>180?C-=360:-180>h&&(C+=360),r=b+(C-n)*f):(te&&(_=l*te[0]+u*te[2]+te[4],u=l*te[1]+u*te[3]+te[5],l=_),i=u-T,e=l-p,2>i&&i>-2&&(i=0),2>e&&e>-2&&(e=0),Te.lockAxis&&(e||i)&&("y"===J||!J&&Math.abs(e)>Math.abs(i)&&me?(i=0,J="y"):ye&&(e=0,J="x")),r=b+e*f,n=C+i*f),Q||Z?(Q&&(r=Q(r)),Z&&(n=Z(n))):A&&(r>M?r=M+(r-M)*d:E>r&&(r=E+(r-E)*d),ae||(n>z?n=z+(n-z)*d:X>n&&(n=X+(n-X)*d))),ae||(r=Math.round(r),n=Math.round(n)),(Te.x!==r||Te.y!==n&&!ae)&&(Te.x=Te.endX=r,ae?Te.endRotation=r:Te.y=Te.endY=n,G=!0,Te.isDragging||(Te.isDragging=!0,j(Te,"dragstart","onDragStart")))}},Ie=function(t,e){if(!(!a||t&&q&&!e&&t.pointerId&&t.pointerId!==q)){Te.isPressed=!1;var i,s,r=t,o=Te.isDragging;if(K?(_e(K,"touchend",Ie),_e(K,"touchmove",Le),_e(K,"touchcancel",Ie),_e(c,"touchstart",pe)):(_e(c,"mouseup",Ie),_e(c,"mousemove",Le)),G=!1,$)return t&&_e(t.target,"change",Ie),j(Te,"release","onRelease"),j(Te,"click","onClick"),$=!1,void 0;if(R(Pe),ae||N(we,"cursor",n.cursor||"move"),o&&(be=S=v(),Te.isDragging=!1),P--,t){if(y&&(t=L(t,!1)),i=t.changedTouches,i&&(t=i[0],t!==U&&t.identifier!==q)){for(s=i.length;--s>-1&&(t=i[s]).identifier!==q;);if(0>s)return}Te.pointerEvent=r,Te.pointerX=t.pageX,Te.pointerY=t.pageY}return r&&!o?(ee&&n.snap&&ke(n.throwProps),j(Te,"release","onRelease"),j(Te,"click","onClick")):(ke(n.throwProps),y||!r||!n.dragClickables&&de(r.target)||!o||(r.preventDefault(),r.preventManipulation&&r.preventManipulation()),j(Te,"release","onRelease")),o&&j(Te,"dragend","onDragEnd"),!0}},Ee=function(t){(Te.isPressed||20>v()-be)&&(t.preventDefault?t.preventDefault():t.returnValue=!1,t.preventManipulation&&t.preventManipulation())};V=ve.get(this.target),V&&V.kill(),this.startDrag=function(t){Me(t),Te.isDragging||(Te.isDragging=!0,j(Te,"dragstart","onDragStart"))},this.drag=Le,this.endDrag=function(t){Ie(t,!0)},this.timeSinceDrag=function(){return Te.isDragging?0:(v()-be)/1e3},this.hitTest=function(t,e){return ve.hitTest(Te.target,t,e)},this.applyBounds=function(t){var e,i;return t&&n.bounds!==t?(n.bounds=t,Te.update(!0)):(Se(!0),Ce(),A&&(e=Te.x,i=Te.y,A&&(e>M?e=M:E>e&&(e=E),i>z?i=z:X>i&&(i=X)),(Te.x!==e||Te.y!==i)&&(Te.x=Te.endX=e,ae?Te.endRotation=e:Te.y=Te.endY=i,G=!0,Pe())),Te)},this.update=function(t){var e=Te.x,i=Te.y;return Re(),t?Te.applyBounds():Se(!0),Te.isPressed&&(Math.abs(e-Te.x)>.01||Math.abs(i-Te.y)>.01&&!ae)&&Ae(),Te},this.enable=function(t){var s;return"soft"!==t&&(ue(we,"mousedown",Me),ue(we,"touchstart",Me),ue(we,"click",Ee),ae||N(we,"cursor",n.cursor||"move"),we.ondragstart=we.onselectstart=d,N(we,"userSelect","none"),N(we,"touchCallout","none"),N(we,"touchAction","none")),a=!0,r&&"soft"!==t&&r.track(_||i,ne?"x,y":ae?"rotation":"top,left"),_&&_.enable(),i._gsDragID=s="d"+x++,w[s]=this,_&&(_.element._gsDragID=s),e.set(i,{x:"+=0"}),this.update(),Te},this.disable=function(t){var e=this.isDragging;return ae||N(we,"cursor",null),"soft"!==t&&(we.ondragstart=we.onselectstart=null,N(we,"userSelect","text"),N(we,"touchCallout","default"),N(we,"MSTouchAction","auto"),_e(we,"mousedown",Me),_e(we,"touchstart",Me),_e(we,"click",Ee),K&&(_e(K,"touchcancel",Ie),_e(K,"touchend",Ie),_e(K,"touchmove",Le)),_e(c,"mouseup",Ie),_e(c,"mousemove",Le)),a=!1,r&&"soft"!==t&&r.untrack(_||i,ne?"x,y":ae?"rotation":"top,left"),_&&_.disable(),R(Pe),this.isDragging=this.isPressed=$=!1,e&&j(this,"dragend","onDragEnd"),Te},this.enabled=function(t,e){return arguments.length?t?this.enable(e):this.disable(e):a},this.kill=function(){return e.killTweensOf(_||i,!0,xe),Te.disable(),delete w[i._gsDragID],Te},-1!==re.indexOf("scroll")&&(_=this.scrollProxy=new ge(i,D({onKill:function(){Te.isPressed&&Ie(null)}},n)),i.style.overflowY=ye&&!he?"auto":"hidden",i.style.overflowX=me&&!he?"auto":"hidden",i=_.content),n.force3D!==!1&&e.set(i,{force3D:!0}),ae?xe.rotation=1:(me&&(xe[oe]=1),ye&&(xe[ce]=1)),ae?(F=u,Y=F.css,F.overwrite=!1):ne&&(F=me&&ye?o:me?h:l,Y=F.css,F.overwrite=!1),this.enable()},ye=ve.prototype=new t;ye.constructor=ve,ye.pointerX=ye.pointerY=0,ye.isDragging=ye.isPressed=!1,ve.version="0.10.5",ve.zIndex=1e3,ue(c,"touchcancel",function(){}),ue(c,"contextmenu",function(){var t;for(t in w)w[t].isPressed&&w[t].endDrag()}),ve.create=function(t,i){"string"==typeof t&&(t=e.selector(t));for(var s=ae(t)?oe(t):[t],r=s.length;--r>-1;)s[r]=new ve(s[r],i);return s},ve.get=function(t){return w[(I(t)||{})._gsDragID]},ve.timeSinceDrag=function(){return(v()-S)/1e3};var Te=function(t,e){var i=t.pageX!==e?{left:t.pageX,top:t.pageY,right:t.pageX+1,bottom:t.pageY+1}:t.nodeType||t.left===e||t.top===e?I(t).getBoundingClientRect():t;return i.right===e&&i.width!==e?(i.right=i.left+i.width,i.bottom=i.top+i.height):i.width===e&&(i={width:i.right-i.left,height:i.bottom-i.top,right:i.right,left:i.left,bottom:i.bottom,top:i.top}),i};return ve.hitTest=function(t,e,i){if(t===e)return!1;var s,r,n,a=Te(t),o=Te(e),h=o.left>a.right||o.right<a.left||o.top>a.bottom||o.bottom<a.top;return h||!i?!h:(n=-1!==(i+"").indexOf("%"),i=parseFloat(i)||0,s={left:Math.max(a.left,o.left),top:Math.max(a.top,o.top)},s.width=Math.min(a.right,o.right)-s.left,s.height=Math.min(a.bottom,o.bottom)-s.top,0>s.width||0>s.height?!1:n?(i*=.01,r=s.width*s.height,r>=a.width*a.height*i||r>=o.width*o.height*i):s.width>i&&s.height>i)},ve},!0)}),_gsScope._gsDefine&&_gsScope._gsQueue.pop()(),function(t){"use strict";var e=function(){return(_gsScope.GreenSockGlobals||_gsScope)[t]};"function"==typeof define&&define.amd?define(["TweenLite"],e):"undefined"!=typeof module&&module.exports&&(require("../TweenLite.js"),require("../plugins/CSSPlugin.js"),module.exports=e())}("Draggable");


/*!
 * VERSION: 0.9.6
 * DATE: 2014-07-17
 * UPDATES AND DOCS AT: http://www.greensock.com
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * ThrowPropsPlugin is a Club GreenSock membership benefit; You must have a valid membership to use
 * this code without violating the terms of use. Visit http://www.greensock.com/club/ to sign up or get more details.
 * This work is subject to the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 */
var _gsScope="undefined"!=typeof module&&module.exports&&"undefined"!=typeof global?global:this||window;(_gsScope._gsQueue||(_gsScope._gsQueue=[])).push(function(){"use strict";_gsScope._gsDefine("plugins.ThrowPropsPlugin",["plugins.TweenPlugin","TweenLite","easing.Ease","utils.VelocityTracker"],function(t,e,i,s){var r,n,o,a,l=function(){t.call(this,"throwProps"),this._overwriteProps.length=0},h=999999999999999,u=1e-10,p=!1,f={x:1,y:1,z:2,scale:1,scaleX:1,scaleY:1,rotation:1,rotationZ:1,rotationX:2,rotationY:2,skewX:1,skewY:1},c=function(t,e,i,s){for(var r,n,o=e.length,a=0,l=h;--o>-1;)r=e[o],n=r-t,0>n&&(n=-n),l>n&&r>=s&&i>=r&&(a=o,l=n);return e[a]},_=function(t,e,i,s){if("auto"===t.end)return t;i=isNaN(i)?h:i,s=isNaN(s)?-h:s;var r="function"==typeof t.end?t.end(e):t.end instanceof Array?c(e,t.end,i,s):Number(t.end);return r>i?r=i:s>r&&(r=s),{max:r,min:r,unitFactor:t.unitFactor}},d=function(t,e,i){for(var s in e)void 0===t[s]&&s!==i&&(t[s]=e[s]);return t},m=l.calculateChange=function(t,s,r,n){null==n&&(n=.05);var o=s instanceof i?s:s?new i(s):e.defaultEase;return r*n*t/o.getRatio(n)},g=l.calculateDuration=function(t,s,r,n,o){o=o||.05;var a=n instanceof i?n:n?new i(n):e.defaultEase;return Math.abs((s-t)*a.getRatio(o)/r/o)},v=l.calculateTweenDuration=function(t,r,n,o,a,h){if("string"==typeof t&&(t=e.selector(t)),!t)return 0;null==n&&(n=10),null==o&&(o=.2),null==a&&(a=1),t.length&&(t=t[0]||t);var f,c,v,y,x,T,w,b,P,S,k=0,C=9999999999,R=r.throwProps||r,A=r.ease instanceof i?r.ease:r.ease?new i(r.ease):e.defaultEase,O=isNaN(R.checkpoint)?.05:Number(R.checkpoint),M=isNaN(R.resistance)?l.defaultResistance:Number(R.resistance);for(f in R)"resistance"!==f&&"checkpoint"!==f&&"preventOvershoot"!==f&&(c=R[f],"object"!=typeof c&&(P=P||s.getByTarget(t),P&&P.isTrackingProp(f)?c="number"==typeof c?{velocity:c}:{velocity:P.getVelocity(f)}:(y=Number(c)||0,v=y*M>0?y/M:y/-M)),"object"==typeof c&&(void 0!==c.velocity&&"number"==typeof c.velocity?y=Number(c.velocity)||0:(P=P||s.getByTarget(t),y=P&&P.isTrackingProp(f)?P.getVelocity(f):0),x=isNaN(c.resistance)?M:Number(c.resistance),v=y*x>0?y/x:y/-x,T="function"==typeof t[f]?t[f.indexOf("set")||"function"!=typeof t["get"+f.substr(3)]?f:"get"+f.substr(3)]():t[f]||0,w=T+m(y,A,v,O),void 0!==c.end&&(c=_(c,w,c.max,c.min),(h||p)&&(R[f]=d(c,R[f],"end"))),void 0!==c.max&&w>Number(c.max)+u?(S=c.unitFactor||l.defaultUnitFactors[f]||1,b=T>c.max&&c.min!==c.max||y*S>-15&&45>y*S?o+.1*(n-o):g(T,c.max,y,A,O),C>b+a&&(C=b+a)):void 0!==c.min&&Number(c.min)-u>w&&(S=c.unitFactor||l.defaultUnitFactors[f]||1,b=c.min>T&&c.min!==c.max||y*S>-45&&15>y*S?o+.1*(n-o):g(T,c.min,y,A,O),C>b+a&&(C=b+a)),b>k&&(k=b)),v>k&&(k=v));return k>C&&(k=C),k>n?n:o>k?o:k},y=l.prototype=new t("throwProps");return y.constructor=l,l.version="0.9.6",l.API=2,l._autoCSS=!0,l.defaultResistance=100,l.defaultUnitFactors={time:1e3,totalTime:1e3},l.track=function(t,e,i){return s.track(t,e,i)},l.untrack=function(t,e){s.untrack(t,e)},l.isTracking=function(t,e){return s.isTracking(t,e)},l.getVelocity=function(t,e){var i=s.getByTarget(t);return i?i.getVelocity(e):0/0},l._cssRegister=function(){var t=(_gsScope.GreenSockGlobals||_gsScope).com.greensock.plugins.CSSPlugin;if(t){var e=t._internals,i=e._parseToProxy,o=e._setPluginRatio,a=e.CSSPropTween;e._registerComplexSpecialProp("throwProps",{parser:function(t,e,h,u,p,c){c=new l;var _,d,m,g,v,y={},x={},T={},w={},b={},P={};n={};for(m in e)"resistance"!==m&&"preventOvershoot"!==m&&(d=e[m],"object"==typeof d?(void 0!==d.velocity&&"number"==typeof d.velocity?y[m]=Number(d.velocity)||0:(v=v||s.getByTarget(t),y[m]=v&&v.isTrackingProp(m)?v.getVelocity(m):0),void 0!==d.end&&(w[m]=d.end),void 0!==d.min&&(x[m]=d.min),void 0!==d.max&&(T[m]=d.max),d.preventOvershoot&&(P[m]=!0),void 0!==d.resistance&&(_=!0,b[m]=d.resistance)):"number"==typeof d?y[m]=d:(v=v||s.getByTarget(t),y[m]=v&&v.isTrackingProp(m)?v.getVelocity(m):d||0),f[m]&&u._enableTransforms(2===f[m]));g=i(t,y,u,p,c),r=g.proxy,y=g.end;for(m in r)n[m]={velocity:y[m],min:x[m],max:T[m],end:w[m],resistance:b[m],preventOvershoot:P[m]};return null!=e.resistance&&(n.resistance=e.resistance),e.preventOvershoot&&(n.preventOvershoot=!0),p=new a(t,"throwProps",0,0,g.pt,2),p.plugin=c,p.setRatio=o,p.data=g,c._onInitTween(r,n,u._tween),p}})}},l.to=function(t,i,s,l,h){i.throwProps||(i={throwProps:i}),0===h&&(i.throwProps.preventOvershoot=!0),p=!0;var u=new e(t,1,i);return u.render(0,!0,!0),u.vars.css?(u.duration(v(r,{throwProps:n,ease:i.ease},s,l,h)),u._delay&&!u.vars.immediateRender?u.invalidate():o._onInitTween(r,a,u),p=!1,u):(u.kill(),u=new e(t,v(t,i,s,l,h),i),p=!1,u)},y._onInitTween=function(t,e,i){this.target=t,this._props=[],o=this,a=e;var r,n,l,h,u,f,c,g,v,y=i._ease,x=isNaN(e.checkpoint)?.05:Number(e.checkpoint),T=i._duration,w=e.preventOvershoot,b=0;for(r in e)if("resistance"!==r&&"checkpoint"!==r&&"preventOvershoot"!==r){if(n=e[r],"number"==typeof n)u=Number(n)||0;else if("object"!=typeof n||isNaN(n.velocity)){if(v=v||s.getByTarget(t),!v||!v.isTrackingProp(r))throw"ERROR: No velocity was defined in the throwProps tween of "+t+" property: "+r;u=v.getVelocity(r)}else u=Number(n.velocity);f=m(u,y,T,x),g=0,h="function"==typeof t[r],l=h?t[r.indexOf("set")||"function"!=typeof t["get"+r.substr(3)]?r:"get"+r.substr(3)]():t[r],"object"==typeof n&&(c=l+f,void 0!==n.end&&(n=_(n,c,n.max,n.min),p&&(e[r]=d(n,e[r],"end"))),void 0!==n.max&&c>Number(n.max)?w||n.preventOvershoot?f=n.max-l:g=n.max-l-f:void 0!==n.min&&Number(n.min)>c&&(w||n.preventOvershoot?f=n.min-l:g=n.min-l-f)),this._props[b++]={p:r,s:l,c1:f,c2:g,f:h,r:!1},this._overwriteProps[b]=r}return!0},y._kill=function(e){for(var i=this._props.length;--i>-1;)null!=e[this._props[i].p]&&this._props.splice(i,1);return t.prototype._kill.call(this,e)},y._roundProps=function(t,e){for(var i=this._props,s=i.length;--s>-1;)(t[i[s]]||t.throwProps)&&(i[s].r=e)},y.setRatio=function(t){for(var e,i,s=this._props.length;--s>-1;)e=this._props[s],i=e.s+e.c1*t+e.c2*t*t,e.r&&(i=Math.round(i)),e.f?this.target[e.p](i):this.target[e.p]=i},t.activate([l]),l},!0),_gsScope._gsDefine("utils.VelocityTracker",["TweenLite"],function(t){var e,i,s,r,n=/([A-Z])/g,o={},a={x:1,y:1,z:2,scale:1,scaleX:1,scaleY:1,rotation:1,rotationZ:1,rotationX:2,rotationY:2,skewX:1,skewY:1},l=document.defaultView?document.defaultView.getComputedStyle:function(){},h=function(t,e,i){var s=(t._gsTransform||o)[e];return s||0===s?s:(t.style[e]?s=t.style[e]:(i=i||l(t,null))?(t=i.getPropertyValue(e.replace(n,"-$1").toLowerCase()),s=t||i.length?t:i[e]):t.currentStyle&&(i=t.currentStyle,s=i[e]),parseFloat(s)||0)},u=t.ticker,p=function(t,e,i){this.p=t,this.f=e,this.v1=this.v2=0,this.t1=this.t2=u.time,this.css=!1,this.type="",this._prev=null,i&&(this._next=i,i._prev=this)},f=function(){var t,i,n=e,o=u.time;if(o-s>=.03)for(r=s,s=o;n;){for(i=n._firstVP;i;)t=i.css?h(n.target,i.p):i.f?n.target[i.p]():n.target[i.p],(t!==i.v1||o-i.t1>.15)&&(i.v2=i.v1,i.v1=t,i.t2=i.t1,i.t1=o),i=i._next;n=n._next}},c=function(t){this._lookup={},this.target=t,this.elem=t.style&&t.nodeType?!0:!1,i||(u.addEventListener("tick",f,null,!1,-100),s=r=u.time,i=!0),e&&(this._next=e,e._prev=this),e=this},_=c.getByTarget=function(t){for(var i=e;i;){if(i.target===t)return i;i=i._next}},d=c.prototype;return d.addProp=function(e,i){if(!this._lookup[e]){var s=this.target,r="function"==typeof s[e],n=r?this._altProp(e):e,o=this._firstVP;this._firstVP=this._lookup[e]=this._lookup[n]=o=new p(n!==e&&0===e.indexOf("set")?n:e,r,o),o.css=this.elem&&(void 0!==this.target.style[o.p]||a[o.p]),o.css&&a[o.p]&&!s._gsTransform&&t.set(s,{x:"+=0"}),o.type=i||o.css&&0===e.indexOf("rotation")?"deg":"",o.v1=o.v2=o.css?h(s,o.p):r?s[o.p]():s[o.p]}},d.removeProp=function(t){var e=this._lookup[t];e&&(e._prev?e._prev._next=e._next:e===this._firstVP&&(this._firstVP=e._next),e._next&&(e._next._prev=e._prev),this._lookup[t]=0,e.f&&(this._lookup[this._altProp(t)]=0))},d.isTrackingProp=function(t){return this._lookup[t]instanceof p},d.getVelocity=function(t){var e,i,s,r=this._lookup[t],n=this.target;if(!r)throw"The velocity of "+t+" is not being tracked.";return e=r.css?h(n,r.p):r.f?n[r.p]():n[r.p],i=e-r.v2,("rad"===r.type||"deg"===r.type)&&(s="rad"===r.type?2*Math.PI:360,i%=s,i!==i%(s/2)&&(i=0>i?i+s:i-s)),i/(u.time-r.t2)},d._altProp=function(t){var e=t.substr(0,3),i=("get"===e?"set":"set"===e?"get":e)+t.substr(3);return"function"==typeof this.target[i]?i:t},c.getByTarget=function(i){var s=e;for("string"==typeof i&&(i=t.selector(i)),i.length&&i!==window&&i[0]&&i[0].style&&!i.nodeType&&(i=i[0]);s;){if(s.target===i)return s;s=s._next}},c.track=function(t,e,i){var s=_(t),r=e.split(","),n=r.length;for(i=(i||"").split(","),s||(s=new c(t));--n>-1;)s.addProp(r[n],i[n]||i[0]);return s},c.untrack=function(t,i){var s=_(t),r=(i||"").split(","),n=r.length;if(s){for(;--n>-1;)s.removeProp(r[n]);s._firstVP&&i||(s._prev?s._prev._next=s._next:s===e&&(e=s._next),s._next&&(s._next._prev=s._prev))}},c.isTracking=function(t,e){var i=_(t);return i?!e&&i._firstVP?!0:i.isTrackingProp(e):!1},c},!0)}),_gsScope._gsDefine&&_gsScope._gsQueue.pop()(),function(t){"use strict";var e=function(){return(_gsScope.GreenSockGlobals||_gsScope)[t]};"function"==typeof define&&define.amd?define(["TweenLite"],e):"undefined"!=typeof module&&module.exports&&(require("../TweenLite.js"),module.exports=e())}("ThrowPropsPlugin");