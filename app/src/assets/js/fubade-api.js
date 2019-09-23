window.FussballdeWidgetAPI = () => {
  const widgetObj = {};

  window.addEventListener(
    'message',
    evt => {
      const currentIframe = document.querySelector('#' + evt.data.container + ' > iframe');

      if ('setHeight' === evt.data.type) {
        currentIframe.setAttribute('height', evt.data.value + 'px');
        currentIframe.style.height = '';
        currentIframe.style.minHeight = '200px';
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

  /** Support for Divi-Tabs & Fusion-Tabs */
  // noinspection XHTMLIncompatabilitiesJS
  if (document.body.classList.contains('et_divi_theme')) {
    const tabs = document.querySelectorAll('.et_pb_tabs_controls a, .fusion-tabs a.tab-link');
    const iframes = document.querySelectorAll(
      '.et_pb_tab_content [id^="fubade_"] > iframe, .fusion-tabs .tab_content [id^="fubade_"] > iframe');
    if (0 < tabs.length) {
      Array.from(tabs)
        .forEach(diviTab => {
          diviTab.addEventListener(
            'click',
            () => {
              // noinspection JSCheckFunctionSignatures
              setTimeout(
                Array.from(iframes)
                  .forEach(iframe => {
                    iframe.src += '';
                  }), 800);
            },
            false
          );
        });
    }
  }

  return widgetObj;
};
