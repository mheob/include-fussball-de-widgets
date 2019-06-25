/* eslint-disable no-console */
import punycode from 'punycode';

import { version } from '../../package.json';

/**
 * fussball.de widgetAPI
 */

const { __ } = wp.i18n;

const host = punycode.toASCII(decodeURIComponent(document.location.host));

const widget = {
  url: '//www.fussball.de/widget2',
  referer: host ? encodeURIComponent(host) : 'unknown'
};

window.FussballdeWidgetAPI = () => {
  const widgetObj = {
    showWidget: (targetId, apiKey, isFullWidth, isDevTools) => {
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
              isFullWidth
            );
          }
        } else {
          console.error(__('Can\'t display the iframe. The DIV is missing: ', 'include-fussball-de-widgets'), targetId);
        }
      }

      if (isDevTools) {
        console.info(__('[FUBADE] Plugin Version: ', 'include-fussball-de-widgets'), version);
        console.info(__('[FUBADE] Website for registration: ', 'include-fussball-de-widgets'), widget.referer);
      }
    }
  };

  window.addEventListener(
    'message',
    evt => {
      const currentIframe = document.querySelector('#' + evt.data.container + ' iframe');

      if ('setHeight' === evt.data.type) {
        currentIframe.setAttribute('height', evt.data.value + 'px');
        currentIframe.style.height = '';
      }

      if ('setWidth' === evt.data.type) {
        if ('100%' !== currentIframe.getAttribute('width')) {
          currentIframe.setAttribute('width', evt.data.value + 'px');
        }

        currentIframe.style.width = '';
      }
    },
    false
  );

  return widgetObj;
};

const createIFrame = (parentId, src, isFullWidth) => {
  const iframe = document.createElement('iframe');
  const parent = document.getElementById(parentId);

  iframe.frameBorder = 0;
  iframe.setAttribute('src', src);
  iframe.setAttribute('scrolling', 'no');
  iframe.setAttribute('width', isFullWidth ? '100%' : '900');
  iframe.setAttribute('height', '500');
  iframe.setAttribute('style', 'border: 1px solid #CECECE;');

  parent.innerHTML = '';
  parent.appendChild(iframe);
};