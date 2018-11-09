const path = require("path");

module.exports = {
  entry: path.resolve(
    __dirname,
    "./src/js/blocks-include-fussball-de-widgets.js"
  ),
  output: {
    filename: "blocks-include-fussball-de-widgets.js",
    path: path.resolve(__dirname, "./dist/js")
  },
  devtool: "source-map",
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: "babel-loader"
      }
    ]
  }
};
