import { resolve } from 'path';

module.exports = {
  mode: 'production',
  output: {
    filename: 'scripts.js'
  },
  module: {
    rules: [
      {
        test: /\.js?$/,
        include: [ resolve( __dirname, './src/assets/js' ) ],
        loader: 'babel-loader',
        exclude: '/node_modules/'
      }
    ]
  }
};

// module.exports = {
// 	entry: './js/block.js',
// 	output: {
// 		path: __dirname,
// 		filename: 'js/block.build.js',
// 	},
// 	module: {
// 		loaders: [
// 			{
// 				test: /.js$/,
// 				loader: 'babel-loader',
// 				exclude: /node_modules/,
// 			},
// 		],
// 	},
// };
