/* eslint-disable no-console */
/*
 * fussball.de widgetAPI
 */

const { __, sprintf } = wp.i18n;

const widget = {};

widget.url = '//www.fussball.de/widget2';
widget.referer = document.location.host ? encodeURIComponent(document.location.host) : 'unknown';

// eslint-disable-next-line no-unused-vars
window.FussballdeWidgetAPI = () => {
  const widgetObj = {};

  widgetObj.showWidget = (targetId, apiKey, fullWidth, isDevTools) => {
    if (
      undefined !== targetId &&
      null !== targetId &&
      '' !== targetId &&
      undefined !== apiKey &&
      null !== apiKey &&
      '' !== apiKey
    ) {
      if (document.getElementById(targetId)) {
        if ('' !== apiKey) {
          createIFrame(
            targetId,
            `${ widget.url }/-/schluessel/${ apiKey }/target/${ targetId }/caller/${ widget.referer }`,
            fullWidth
          );
        }
      } else {
        console.error(
          sprintf(
            /* translators: %s: the ID */
            __('Can\'t display the iframe. The DIV with the ID="%s" is missing.', 'include-fussball-de-widgets'),
            targetId
          )
        );
      }
    }

    if (isDevTools) {
      console.info(
        sprintf(__('Website for fussball.de registration: %s', 'include-fussball-de-widgets'), widget.referer)
      );
    }
  };

  window.addEventListener(
    'message',
    event => {
      const currentIframe = document.querySelector('#' + event.data.container + ' iframe');
      if ('setHeight' === event.data.type) {
        currentIframe.setAttribute('height', event.data.value + 'px');
      }
      if ('setWidth' === event.data.type) {
        if ('100%' !== currentIframe.getAttribute('width')) {
          currentIframe.setAttribute('width', event.data.value + 'px');
        }
      }
    },
    false
  );

  return widgetObj;
};

const createIFrame = (parentId, src, fullWidth) => {
  const iframe = document.createElement('iframe');
  const parent = document.getElementById(parentId);

  iframe.frameBorder = 0;
  iframe.setAttribute('src', src);
  iframe.setAttribute('scrolling', 'no');
  iframe.setAttribute('width', fullWidth ? '100%' : '900');
  iframe.setAttribute('height', '500');
  iframe.setAttribute('style', 'border: 1px solid #CECECE;');

  parent.innerHTML = '';
  parent.appendChild(iframe);
};
