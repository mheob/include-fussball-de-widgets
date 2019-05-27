/**
 * Browser Sync
 */
import browserSync from "browser-sync";

import config from "./utils/config";

export const liveServer = done => {
  browserSync.init({
    port: config.browserSync.port,
    ui: {
      port: config.browserSync.port + 1,
    },
    browser: "google-chrome-stable",
    server: {
      baseDir: config.modeProduction ? config.root.build : config.root.dist,
    },
  });
  done();
};

export const liveReload = done => {
  browserSync.reload();
  done();
};
