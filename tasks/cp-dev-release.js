/* eslint-disable no-console */

import os from 'node:os';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

import cpr from 'cpr';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

const homedir = os.homedir();

const source = path.join(__dirname, '..', '/dist');
const dest = path.join(
	homedir,
	'/dev/DevKinsta/public/default-test-environment/wp-content/plugins/include-fussball-de-widgets',
);

cpr(source, dest, { deleteFirst: true }, () => {
	console.log(`Copy the compiled files from ${source} to ${dest}`);
});
