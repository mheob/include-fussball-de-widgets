window.FussballdeWidgetAPI = () => {
  const widgetObj = {}

  // eslint-disable-next-line no-undef
  const devTools = typeof attr !== 'undefined' && !!attr.devtools

  window.addEventListener(
    'message',
    (evt) => {
      if (devTools) console.log('window.FussballdeWidgetAPI -> evt.data.container', evt.data.container)

      const currentIframe = document.querySelector('#' + evt.data.container + ' iframe')

      if (!currentIframe) return

      if (evt.data.type === 'setHeight') {
        currentIframe.setAttribute('height', evt.data.value + 'px')
        currentIframe.style.height = ''
        currentIframe.style.minHeight = '200px'
      }

      if (evt.data.type === 'setWidth') {
        if (currentIframe.getAttribute('width') !== '100%') {
          currentIframe.setAttribute('width', evt.data.value + 'px')
        }

        currentIframe.style.width = ''
      }
    },
    false
  )

  // Support for Divi-Tabs, Fusion-Tabs, Kadence-Blocks-Tabs, Shortcodes Ultimate, WPBakery Page Builder
  if (
    document.body.classList.contains('et_divi_theme') ||
    document.body.classList.contains('fusion-body') ||
    document.querySelectorAll('.wp-block-kadence-tabs').length > 0 ||
    document.querySelectorAll('.su-spoiler').length > 0 ||
    document.querySelectorAll('.vc_tta-tabs').length > 0
  ) {
    const tabs = document.querySelectorAll(
      '.et_pb_tabs_controls a, .fusion-tabs a.tab-link, .kt-tabs-title-list a, .su-spoiler-title, .vc_tta-tab a'
    )
    const iframes = document.querySelectorAll('iframe')
    if (tabs.length > 0) {
      Array.from(tabs).forEach((tab) => {
        tab.addEventListener(
          'click',
          () => {
            setTimeout(
              Array.from(iframes).forEach((iframe) => {
                iframe.src += ''
              }),
              800
            )
            if (devTools) {
              console.log('window.FussballdeWidgetAPI -> tab', tab)
              console.log('window.FussballdeWidgetAPI -> iframes', iframes)
            }
          },
          false
        )
      })
    }
  }

  return widgetObj
}
