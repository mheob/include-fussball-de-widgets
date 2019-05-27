/**
 * Generate scripts
 */
import { dest, src } from 'gulp';
import { join } from 'path';
import webpack from 'webpack';
import webpackStream from 'webpack-stream';

import webpackConfig from '../webpack.config';
import config from './utils/config';

const outPath = config.modeProduction ? config.root.build : config.root.dist;

const scripts = () =>
  src(join(config.root.src, config.scripts.src, 'scripts.js'))
    .pipe(webpackStream(webpackConfig, webpack))
    // folder only, filename is specified in webpack
    .pipe(dest(join(outPath, config.scripts.out)));

export default scripts;
