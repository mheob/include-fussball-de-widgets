/**
 * Generate the POT file
 */
import { join } from 'path';

import { dest, src } from 'gulp';
import wpPot from 'gulp-wp-pot';

import config from './utils/config';

const outPath = config.modeProduction ? config.root.build : config.root.dist;

export const i18n = () =>
	src(join(config.root.src, config.i18n.src, config.i18n.extensions))
		.pipe(
			wpPot({
				domain: 'include-fussball-de-widgets',
				package: 'Include Fussball.de Widgets',
			})
		)
		.pipe(dest(join(outPath, config.i18n.out)));

export default i18n;
