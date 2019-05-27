/**
 * Build styles
 */
import { dest, src } from "gulp";
import sass from "gulp-sass";
import sourcemaps from "gulp-sourcemaps";
import { join } from "path";

import config from "./utils/config";

const outPath = config.modeProduction ? config.root.build : config.root.dist;

const style = () =>
  src(join(config.root.src, config.styles.src, config.styles.extensions))
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        includePaths: [ "./node_modules" ],
        outputStyle: config.modeProduction ? "compressed" : "expanded",
        sourceMap: true,
        errLogToConsole: true,
      })
    )
    .pipe(sourcemaps.write("."))
    .pipe(dest(join(outPath, config.styles.out)));

export default style;
