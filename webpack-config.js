const path = require("path");
const webpack = require("webpack");
const DependencyExtractionWebpackPlugin = require("@wordpress/dependency-extraction-webpack-plugin");

module.exports = {
  entry: {
    index: [
      "react-hot-loader/patch",
      path.resolve(process.cwd(), "./src/blocks", "index.ts")
    ],
    style: path.resolve(process.cwd(), "./src/blocks", "style.scss"),
    editor: path.resolve(process.cwd(), "./src/blocks", "editor.scss")
  },
  output: {
    path: path.resolve(__dirname, "build"),
    filename: "[name].js"
  },
  resolve: {
    extensions: [".ts", ".tsx", ".js", ".jsx"]
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        use: "ts-loader",
        exclude: /node_modules/
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: [
              "@babel/preset-env",
              "@babel/preset-react",
              "@wordpress/babel-preset-default"
            ]
          }
        }
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          "style-loader",
          "css-loader",
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                plugins: [["autoprefixer", {}]]
              }
            }
          },
          "sass-loader"
        ]
      }
    ]
  },
  plugins: [
    new webpack.HotModuleReplacementPlugin(),
    new DependencyExtractionWebpackPlugin()
  ],
  devServer: {
    contentBase: path.resolve(__dirname, "build"),
    publicPath: "/build/",
    hot: true,
    watchContentBase: true,
    port: 8080,
    headers: {
      "Access-Control-Allow-Origin": "*"
    }
  },
  externals: {
    react: "React",
    "react-dom": "ReactDOM"
  }
};
