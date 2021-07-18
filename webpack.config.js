const path = require('path')

const PnpWebpackPlugin = require('pnp-webpack-plugin')
const CopyPlugin = require('copy-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')

const defaultConfig = require('./wordpress.webpack.config')

const commonConfig = {
  ...defaultConfig,
  mode: 'production',
  optimization: {
    minimizer: [
      new TerserPlugin({
        terserOptions: {
          compress: {
            unused: false
          },
          mangle: {
            reserved: ['FussballdeWidgetAPI', '__']
          }
        }
      })
    ]
  },
  resolve: {
    plugins: [PnpWebpackPlugin]
  },
  resolveLoader: {
    plugins: [PnpWebpackPlugin.moduleLoader(module)]
  }
}

const blockConfig = {
  ...commonConfig,
  entry: './src/Blocks/index.js',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'assets/js/blocks.js'
  },
  plugins: [
    ...defaultConfig.plugins,
    new MiniCssExtractPlugin({
      filename: 'assets/css/blocks-[name].css'
    })
  ],
  module: {
    rules: [
      ...defaultConfig.module.rules,
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: require.resolve('sass-loader'),
            options: {
              implementation: require('sass')
            }
          }
        ]
      }
    ]
  }
}

const fubadeConfig = {
  ...commonConfig,
  entry: './src/assets/js/fubade-api.js',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'assets/js/fubade-api.js'
  },
  plugins: [
    ...defaultConfig.plugins,
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
