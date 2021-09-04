const path = require('path')
const cpr = require('cpr')

const homedir = require('os').homedir()
const source = path.join(__dirname, '..', '/dist')
const dest = path.join(
  homedir,
  '/dev/DevKinsta/public/default-test-environment/wp-content/plugins/include-fussball-de-widgets'
)

cpr(source, dest, { deleteFirst: true }, () => {
  console.log(`Copy the compiled files from ${source} to ${dest}`)
})
