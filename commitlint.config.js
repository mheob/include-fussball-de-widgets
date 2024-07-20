import defaultConfig from '@mheob/commitlint-config';

/** @type {import('cz-git').UserConfig} */
const config = { ...defaultConfig, prompt: { ...defaultConfig.prompt, allowEmptyScopes: true } };

export default config;
