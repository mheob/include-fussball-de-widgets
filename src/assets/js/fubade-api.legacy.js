/* global attr */
/* eslint-disable no-console */

window.fussballDeWidgetAPI = () => {
	const devTools = typeof attr !== 'undefined' && !!attr.devtools;

	window.addEventListener(
		'message',
		evt => {
			if (devTools) {
				console.info('window.fussballDeWidgetAPI -> evt.data.container', evt.data.container);
			}

			const currentIframe = document.querySelector(`#${evt.data.container} iframe`);

			if (!currentIframe) return;

			if (evt.data.type === 'setHeight') {
				currentIframe.setAttribute('height', `${evt.data.value}px`);
				currentIframe.style.height = '';
				currentIframe.style.minHeight = '200px';
			}

			if (evt.data.type === 'setWidth') {
				if (currentIframe.getAttribute('width') !== '100%') {
					currentIframe.setAttribute('width', `${evt.data.value}px`);
				}

				currentIframe.style.width = '';
			}
		},
		false,
	);

	// Support for Divi-Tabs, Fusion-Tabs, Kadence-Blocks-Tabs, Shortcodes Ultimate,
	//             WPBakery Page Builder, Olevmedia Shortcode
	if (
		document.body.classList.contains('et_divi_theme') ||
		document.body.classList.contains('fusion-body') ||
		document.body.classList.contains('elementor-page') ||
		document.querySelectorAll('.wp-block-kadence-tabs').length > 0 ||
		document.querySelectorAll('.su-spoiler').length > 0 ||
		document.querySelectorAll('.vc_tta-tabs').length > 0 ||
		document.querySelectorAll('.omsc-tabs-control').length > 0
	) {
		const tabs = document.querySelectorAll(
			'.et_pb_tabs_controls a, .fusion-tabs a.tab-link, .kt-tabs-title-list a, .su-spoiler-title, .vc_tta-tab a, .omsc-tabs-control a, .elementor-tab-title, .elementor-toggle',
		);
		if (tabs.length > 0) {
			Array.from(tabs).forEach(tab => {
				tab.addEventListener(
					'click',
					() => {
						const iFrames = document.querySelectorAll('iframe');
						setTimeout(
							Array.from(iFrames).forEach(iFrame => {
								iFrame.src += '';
							}),
							700,
						);
						if (devTools) {
							console.info('window.fussballDeWidgetAPI -> tab', tab);
							console.info('window.fussballDeWidgetAPI -> iFrames', iFrames);
						}
					},
					false,
				);
			});
		}
	}
};
