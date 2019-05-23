import process from 'process';

const config = {
	modeProduction: 'production' === process.env.NODE_ENV,
	root: {
		src: './app/src',
		dist: './app/dist',
		build: './app/build',
		external: './node_modules',
	},
	html: {
		src: './',
		out: './',
		extensions: '**/*.+(html|php)',
	},
	styles: {
		src: 'sass',
		out: 'assets/css',
		extensions: '**/*.+(css|scss)',
	},
	scripts: {
		src: 'js',
		out: 'assets/js',
		extensions: '**/*.js',
	},
	i18n: {
		src: './',
		out: 'languages/include-fussball-de-widgets.pot',
		extensions: '**/*.+(php|js)',
	},
	browserSync: {
		port: 3333,
	},
	// TODO: Add the assets
};

export default config;
