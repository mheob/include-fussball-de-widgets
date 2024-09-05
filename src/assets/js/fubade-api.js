import './fubade-api.legacy.js';

(function initialize() {
	const containerClass = 'fussballde_widget';

	function generateSecureRandomId(length) {
		const randomValues = new Uint32Array(length);
		window.crypto.getRandomValues(randomValues);

		const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		let result = '';
		for (let i = 0; i < length; i++) {
			const randomIndex = randomValues[i] % characters.length;
			result += characters[randomIndex];
		}
		return result;
	}

	function initializeWidget(container) {
		const widgetId = container.dataset.id;
		const widgetType = container.dataset.type;

		if (container && widgetId) {
			const iframeName = `${generateSecureRandomId(4)}_fussballde_widget-${widgetId}`;
			const iframe = document.createElement('iframe');
			iframe.setAttribute('src', `https://next.fussball.de/widget/${widgetType}/${widgetId}`);
			iframe.setAttribute('name', iframeName);
			iframe.style.width = '100%';
			iframe.style.border = 'none';
			iframe.setAttribute('frameborder', '0');
			iframe.setAttribute('scrolling', 'no');

			container.append(iframe);

			window.addEventListener('message', function (event) {
				if (
					event.data.type === 'fussballde_widget:resize' &&
					// eslint-disable-next-line eqeqeq
					event.data.iframeName == iframeName
				) {
					iframe.style.height = `${event.data.height}px`;
				}
			});
		} else {
			console.error(`Widget container not initialized: #${widgetId}`);
		}
	}

	function loadWidgets() {
		const containers = [...document.querySelectorAll(containerClass)];
		for (const element of containers) {
			initializeWidget(element);
		}
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', loadWidgets);
	} else {
		loadWidgets();
	}
})();
