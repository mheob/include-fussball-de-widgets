const path = require('path')
const cpr = require('cpr')

let source
let dest

if (process.platform === 'win32') {
  source = 'E:\\Dev\\wordpress\\plugins\\ifdw\\dist\\'
  dest = 'E:\\Env\\www\\wp-default\\public_html\\wp-content\\plugins\\include-fussball-de-widgets\\'
} else {
  source = path.join(__dirname, '..', '/dist')
  dest = path.join(__dirname, '..', '..', '/wordpress/wp-content/plugins/include-fussball-de-widgets')
}

cpr(source, dest, { deleteFirst: true }, () => {
  console.log(`Copy the compiled files from ${source} to ${dest}`)
})
