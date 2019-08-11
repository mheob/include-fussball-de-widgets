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

  return widgetObj;
};
