/* eslint-disable no-console, unicorn/prevent-abbreviations */

import os from 'node:os';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

import cpr from 'cpr';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

const homedir = os.homedir();

const source = path.join(__dirname, '..', '/dist');
const destination = path.join(
	homedir,
	'/dev/DevKinsta/public/default-test-environment/wp-content/plugins/include-fussball-de-widgets',
);

cpr(source, destination, { deleteFirst: true }, () => {
	console.log(`Copy the compiled files from ${source} to ${destination}`);
});
