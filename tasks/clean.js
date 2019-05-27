/**
 * Cleaner
 */
import del from "del";

import config from "./utils/config";

export const cleanBuild = () => del(config.root.build);

export const cleanDist = () => del(config.root.dist);
