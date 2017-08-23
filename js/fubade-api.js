/*
 * fussball.de widgetAPI
 */

var egmWidget2 = {};

egmWidget2.url = '//www.fussball.de/widget2';
egmWidget2.referer = location.host ? encodeURIComponent(location.host) : 'unknown';

var fussballdeWidgetAPI = function () {
  var widgetObj = {};

  widgetObj.showWidget = function (targetId, apiKey) {
    if (apiKey !== undefined && apiKey !== null && apiKey !== '' && targetId !== undefined && targetId !== null && targetId !== '') {
      if (document.getElementById(targetId)) {
        if (apiKey !== '') {
          createIFrame(targetId, egmWidget2.url + '/-/schluessel/' + apiKey + '/target/' + targetId + '/caller/' + egmWidget2.referer);
        }
      } else {
        // noinspection JSUnresolvedVariable
        log(fubade.missing_div + targetId);
      }
    }
  };

  window.addEventListener('message', function (event) {
    if (event.data.type === 'setHeight') {
      document.querySelectorAll('#' + event.data.container + ' iframe')[0].setAttribute('height', event.data.value + 'px');
    }
    if (event.data.type === 'setWidth') {
      document.querySelectorAll('#' + event.data.container + ' iframe')[0].setAttribute('width', event.data.value + 'px');
    }
  }, false);

  return widgetObj;
};

function createIFrame (parentId, src) {
  var parent = document.getElementById(parentId);
  var iframe = document.createElement('iframe');

  iframe.frameBorder = 0;
  iframe.setAttribute('src', src);
  iframe.setAttribute('scrolling', 'no');
  iframe.setAttribute('width', '900');
  iframe.setAttribute('height', '500');
  iframe.setAttribute('style', 'border: 1px solid #CECECE;');

  parent.innerHTML = '';
  parent.appendChild(iframe);
}
