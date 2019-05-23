import { parallel, series, watch } from "gulp";
import { join } from "path";

import config from "./tasks/utils/config";

import { liveReload, liveServer } from "./tasks/browserSync"; // *
import { cleanBuild, cleanDist } from "./tasks/clean"; // *
import scripts from "./tasks/scripts";
import { copyHtml } from "./tasks/static";
import styles from "./tasks/styles";

export const cleanAll = parallel(cleanBuild, cleanDist);

export const copyStatic = series(copyHtml);

export const build = series(cleanBuild, parallel(copyStatic, scripts, styles));

export const watchFiles = series(
  cleanDist,
  parallel(copyStatic, scripts, styles),
  liveServer,
  () => {
    watch(
      join(config.root.src, config.html.src, config.html.extensions),
      series(copyHtml, liveReload)
    );
    watch(join(config.root.src, config.img.src, config.img.extensions), series(liveReload));
    watch(
      join(config.root.src, config.scripts.src, config.scripts.extensions),
      series(scripts, liveReload)
    );
    watch(
      join(config.root.src, config.styles.src, config.styles.extensions),
      series(styles, liveReload)
    );
  }
);

export default watchFiles;
