const cpr = require('cpr');

let source;
let dest;

if (process.platform === 'win32') {
  source = 'E:\\Dev\\wordpress\\plugins\\ifdw\\dist\\';
  dest = 'E:\\Env\\www\\wp-default\\public_html\\wp-content\\plugins\\include-fussball-de-widgets\\';
  console.log(`Copied the compiled files from ${source} to ${dest}`);
} else {
  source = '';
  dest = '';
  console.log('Please set the folder for the unix operation system.');
}

cpr(source, dest, { deleteFirst: true });
