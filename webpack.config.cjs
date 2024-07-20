const path = require('node:path');
const process = require('node:process');

const MiniCSSExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const postcssPlugins = require('@wordpress/postcss-plugins-preset');

const isProduction = process.env.NODE_ENV === 'production';

const commonConfig = {
	devtool: !isProduction && (process.env.WP_DEVTOOL || 'source-map'),
	mode: isProduction ? 'production' : 'development',
	module: {
		rules: [
			{
				exclude: /node_modules/,
				test: /\.jsx?$/,
				use: [
					{
						loader: require.resolve('babel-loader'),
						options: {
							babelrc: false,
							cacheDirectory: process.env.BABEL_CACHE_DIRECTORY || true,
							configFile: false,
							presets: [require.resolve('@wordpress/babel-preset-default')],
						},
					},
				],
			},
		],
	},
	optimization: {
		concatenateModules: isProduction,
		minimizer: [
			new TerserPlugin({
				extractComments: false,
				parallel: true,
				terserOptions: {
					compress: { passes: 2 },
					mangle: { reserved: ['fussballDeWidgetAPI', '__', '_n', '_nx', '_x'] },
					output: { comments: /translators:/i },
				},
			}),
		],
		splitChunks: {
			cacheGroups: {
				default: false,
				style: {
					chunks: 'all',
					enforce: true,
					name(module, chunks, cacheGroupKey) {
						return `${cacheGroupKey}-${chunks[0].name}`;
					},
					test: /[\\/]style(\.module)?\.(sc|sa|c)ss$/,
					type: 'css/mini-extract',
				},
			},
		},
	},
	resolve: {
		alias: { 'lodash-es': 'lodash' },
	},
	stats: { children: false },
};

if (!isProduction) {
	commonConfig.module.rules.unshift({
		enforce: 'pre',
		exclude: [/node_modules/],
		test: /\.js$/,
		use: require.resolve('source-map-loader'),
	});
}

const blockConfig = {
	...commonConfig,
	entry: {
		index: path.resolve(process.cwd(), 'src', 'Blocks', 'index.js'),
	},
	module: {
		rules: [
			...commonConfig.module.rules,
			{
				test: /\.(sc|sa)ss$/,
				use: [
					{ loader: MiniCSSExtractPlugin.loader },
					{
						loader: require.resolve('css-loader'),
						options: {
							modules: { auto: true },
							sourceMap: !isProduction,
						},
					},
					{
						loader: require.resolve('postcss-loader'),
						options: {
							postcssOptions: {
								ident: 'postcss',
								plugins: isProduction
									? [
											...postcssPlugins,
											require('cssnano')({
												preset: ['default', { discardComments: { removeAll: true } }],
											}),
										]
									: postcssPlugins,
								sourceMap: !isProduction,
							},
						},
					},
					{
						loader: require.resolve('sass-loader'),
						options: { sourceMap: !isProduction },
					},
				],
			},
		],
	},
	output: {
		filename: 'assets/js/blocks.js',
		path: path.resolve(process.cwd(), 'dist'),
	},
	plugins: [new MiniCSSExtractPlugin({ filename: 'assets/css/blocks-main.css' })].filter(Boolean),
};

const fubadeConfig = {
	...commonConfig,
	entry: path.resolve(process.cwd(), 'src', 'assets', 'js', 'fubade-api.js'),
	output: {
		filename: 'assets/js/fubade-api.js',
		path: path.resolve(process.cwd(), 'dist'),
	},
	plugins: [
		new CopyPlugin({
			patterns: [
				{ context: 'src', from: '**/*.php', to: '../dist/' },
				{ context: 'src', from: '*/images/*', to: '../dist/' },
				{ context: 'dist', from: '../LICENSE', to: './' },
				{ context: 'dist', from: '../readme.txt', to: './' },
			],
		}),
	],
};

module.exports = [blockConfig, fubadeConfig];
