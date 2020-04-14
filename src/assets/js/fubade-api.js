window.FussballdeWidgetAPI = () => {
  const widgetObj = {};

  window.addEventListener(
    'message',
    (evt) => {
      const currentIframe = document.querySelector('#' + evt.data.container + ' > iframe');

      if (evt.data.type === 'setHeight') {
        currentIframe.setAttribute('height', evt.data.value + 'px');
        currentIframe.style.height = '';
        currentIframe.style.minHeight = '200px';
      }

      if (evt.data.type === 'setWidth') {
        if (currentIframe.getAttribute('width') !== '100%') {
          currentIframe.setAttribute('width', evt.data.value + 'px');
        }

        currentIframe.style.width = '';
      }
    },
    false
  );

  /** Support for Divi-Tabs, Fusion-Tabs and Kadence-Blocks-Tabs */
  if (
    document.body.classList.contains('et_divi_theme') ||
    document.body.classList.contains('fusion-body') ||
    document.querySelectorAll('.wp-block-kadence-tabs').length > 0
  ) {
    const tabs = document.querySelectorAll('.et_pb_tabs_controls a, .fusion-tabs a.tab-link, .kt-tabs-title-list a');
    const iframes = document.querySelectorAll(
      '.et_pb_tab_content [id^="fubade_"] > iframe, ' +
        '.fusion-tabs .tab_content [id^="fubade_"] > iframe, ' +
        '.wp-block-kadence-tab [id^="fubade_"] > iframe'
    );
    if (tabs.length > 0) {
      Array.from(tabs).forEach((tab) => {
        tab.addEventListener(
          'click',
          () => {
            setTimeout(
              Array.from(iframes).forEach((iframe) => {
                iframe.src += '';
              }),
              800
            );
            console.log('Tab clicked', tab);
          },
          false
        );
      });
    }
  }

  return widgetObj;
};
