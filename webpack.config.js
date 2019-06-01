const path = require('path');

const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

const defaultConfig = require('./node_modules/@wordpress/scripts/config/webpack.config');

const commonConfig = {
  ...defaultConfig,
  module: {
    rules: [
      ...defaultConfig.module.rules,
      {
        test: /\.scss$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'css/[name]-block.css'
            }
          },
          {
            loader: 'extract-loader'
          },
          {
            loader: 'css-loader?-url'
          },
          {
            loader: 'postcss-loader'
          },
          {
            loader: 'sass-loader'
          }
        ]
      }
    ]
  }
};

const blockConfig = {
  ...commonConfig,
  entry: [
    './app/src/block/index.js',
    './app/src/block/editor.scss'
    // './app/src/block/frontend.scss'
  ],
  output: {
    path: path.resolve(__dirname, 'app', 'dist'),
    filename: 'js/fubade-block.js'
  }
};

const fubadeConfig = {
  ...commonConfig,
  entry: './app/src/fubade-api.js',
  output: {
    path: path.resolve(__dirname, 'app', 'dist'),
    filename: 'js/fubade-api.js'
  },
  optimization: {
    minimizer: [
      new TerserPlugin({
        terserOptions: {
          compress: {
            unused: false
          },
          mangle: {
            reserved: [ 'FussballdeWidgetAPI' ]
          }
        }
      })
    ]
  },
  plugins: [
    new CopyPlugin([
      { from: '*.php', to: '../dist/', context: 'app/src' },
      { from: 'languages', to: '../dist/languages', context: 'app/src' }
    ])
  ]
};

module.exports = [ blockConfig, fubadeConfig ];
