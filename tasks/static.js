/**
 * Copy static files
 */
import { join } from "path";

import { dest, series, src } from "gulp";

import config from "./utils/config";

const outPath = config.modeProduction ? config.root.build : config.root.dist;

// TODO: add PHP

export const copyHtml = () =>
  src(join(config.root.src, config.html.src, config.html.extensions)).pipe(
    dest(join(outPath, config.html.out))
  );

export const copyStatic = series(copyHtml);

export default copyStatic;
