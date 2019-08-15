const path = require('path');

const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');

const defaultConfig = require('./node_modules/@wordpress/scripts/config/webpack.config');

const commonConfig = {
  ...defaultConfig,
  optimization: {
    minimizer: [
      new TerserPlugin({
        terserOptions: {
          compress: {
            unused: false
          },
          mangle: {
            reserved: [ 'FussballdeWidgetAPI', '__' ]
          }
        }
      })
    ]
  }
};

const blockConfig = {
  ...commonConfig,
  entry: './app/src/Blocks/index.js',
  output: {
    path: path.resolve(__dirname, 'app', 'dist'),
    filename: 'assets/js/blocks.js'
  },
  module: {
    rules: [
      ...defaultConfig.module.rules,
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      }
    ]
  },
  plugins: [
    ...defaultConfig.plugins,
    new MiniCssExtractPlugin({
      path: path.resolve(__dirname, 'app', 'dist'),
      filename: 'assets/css/blocks-[name].css'
    })
  ]
};

const fubadeConfig = {
  ...commonConfig,
  entry: './app/src/assets/js/fubade-api.js',
  output: {
    path: path.resolve(__dirname, 'app', 'dist'),
    filename: 'assets/js/fubade-api.js'
  },
  plugins: [
    ...defaultConfig.plugins,
    new CopyPlugin([
      { from: '**/*.php', to: '../dist/', context: 'app/src' },
      { from: '*/images/*', to: '../dist/', context: 'app/src' },
      { from: '../../LICENSE', to: './', context: 'app/dist' },
      { from: '../../readme.txt', to: './', context: 'app/dist' }
    ])
  ]
};

module.exports = [ blockConfig, fubadeConfig ];
