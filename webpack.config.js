const path = require('path')

const MiniCSSExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const CopyPlugin = require('copy-webpack-plugin')
const postcssPlugins = require('@wordpress/postcss-plugins-preset')

const isProduction = process.env.NODE_ENV === 'production'

const commonConfig = {
  mode: isProduction ? 'production' : 'development',
  resolve: {
    alias: { 'lodash-es': 'lodash' }
  },
  optimization: {
    concatenateModules: isProduction,
    splitChunks: {
      cacheGroups: {
        style: {
          type: 'css/mini-extract',
          test: /[\\/]style(\.module)?\.(sc|sa|c)ss$/,
          chunks: 'all',
          enforce: true,
          name(module, chunks, cacheGroupKey) {
            return `${cacheGroupKey}-${chunks[0].name}`
          }
        },
        default: false
      }
    },
    minimizer: [
      new TerserPlugin({
        parallel: true,
        terserOptions: {
          output: { comments: /translators:/i },
          compress: { passes: 2 },
          mangle: { reserved: ['FussballdeWidgetAPI', '__', '_n', '_nx', '_x'] }
        },
        extractComments: false
      })
    ]
  },
  module: {
    rules: [
      !isProduction && {
        test: /\.js$/,
        exclude: [/node_modules/],
        use: require.resolve('source-map-loader'),
        enforce: 'pre'
      },
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: [
          {
            loader: require.resolve('babel-loader'),
            options: {
              cacheDirectory: process.env.BABEL_CACHE_DIRECTORY || true,
              babelrc: false,
              configFile: false,
              presets: [require.resolve('@wordpress/babel-preset-default')]
            }
          }
        ]
      }
    ]
  },
  stats: { children: false },
  devtool: !isProduction && (process.env.WP_DEVTOOL || 'source-map')
}

const blockConfig = {
  ...commonConfig,
  entry: {
    index: path.resolve(process.cwd(), 'src', 'Blocks', 'index.js')
  },
  output: {
    filename: 'assets/js/blocks.js',
    path: path.resolve(process.cwd(), 'dist')
  },
  plugins: [new MiniCSSExtractPlugin({ filename: 'assets/css/blocks-main.css' })].filter(Boolean),
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
              sourceMap: !isProduction,
              modules: { auto: true }
            }
          },
          {
            loader: require.resolve('postcss-loader'),
            options: {
              postcssOptions: {
                ident: 'postcss',
                sourceMap: !isProduction,
                plugins: isProduction
                  ? [
                      ...postcssPlugins,
                      require('cssnano')({
                        preset: ['default', { discardComments: { removeAll: true } }]
                      })
                    ]
                  : postcssPlugins
              }
            }
          },
          {
            loader: require.resolve('sass-loader'),
            options: { sourceMap: !isProduction }
          }
        ]
      }
    ]
  }
}

const fubadeConfig = {
  ...commonConfig,
  entry: path.resolve(process.cwd(), 'src', 'assets', 'js', 'fubade-api.js'),
  output: {
    filename: 'assets/js/fubade-api.js',
    path: path.resolve(process.cwd(), 'dist')
  },
  plugins: [
    new CopyPlugin({
      patterns: [
        { from: '**/*.php', to: '../dist/', context: 'src' },
        { from: '*/images/*', to: '../dist/', context: 'src' },
        { from: '../LICENSE', to: './', context: 'dist' },
        { from: '../readme.txt', to: './', context: 'dist' }
      ]
    })
  ]
}

module.exports = [blockConfig, fubadeConfig]
