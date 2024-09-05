/* global attr */
/* eslint-disable no-console */

window.fussballDeWidgetAPI = () => {
	const developmentTools = typeof attr !== 'undefined' && Boolean(attr.devtools);

	window.addEventListener(
		'message',
		event => {
			if (developmentTools) {
				console.info('window.fussballDeWidgetAPI -> evt.data.container', event_.data.container);
			}

			const currentIframe = document.querySelector(`#${event_.data.container} iframe`);

			if (!currentIframe) return;

			if (event.data.type === 'setHeight') {
				currentIframe.setAttribute('height', `${event_.data.value}px`);
				currentIframe.style.height = '';
				currentIframe.style.minHeight = '200px';
			}

			if (event_.data.type === 'setWidth') {
				if (currentIframe.getAttribute('width') !== '100%') {
					currentIframe.setAttribute('width', `${event_.data.value}px`);
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
			for (const tab of tabs) {
				tab.addEventListener(
					'click',
					() => {
						const iFrames = document.querySelectorAll('iframe');
						setTimeout(
							// eslint-disable-next-line unicorn/no-array-for-each
							[...iFrames].forEach(iFrame => {
								iFrame.src += '';
							}),
							700,
						);
						if (developmentTools) {
							console.info('window.fussballDeWidgetAPI -> tab', tab);
							console.info('window.fussballDeWidgetAPI -> iFrames', iFrames);
						}
					},
					false,
				);
			}
		}
	}
};
