const path = require("path");
const webpack = require("webpack");
const CopyPlugin = require("copy-webpack-plugin");
const DependencyExtractionWebpackPlugin = require("@wordpress/dependency-extraction-webpack-plugin");

module.exports = {
  entry: {
    blocks: path.resolve(process.cwd(), "src/blocks", "index.ts"),
    style: path.resolve(process.cwd(), "src/blocks", "style.scss"),
    editor: path.resolve(process.cwd(), "src/blocks", "editor.scss")
  },
  output: {
    path: path.resolve(process.cwd(), "build"),
    filename: "[name].min.js",
    libraryTarget: "this"
  },
  resolve: {
    extensions: [".ts", ".tsx", ".js", ".jsx"]
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
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
    new CopyPlugin({
      patterns: [
        {
          from: "./src/blocks/**/block.json",
          to({ absoluteFilename }) {
            return path.resolve(
              __dirname,
              "build",
              path.basename(path.dirname(absoluteFilename)),
              "block.json"
            );
          }
        }
      ]
    }),
    new webpack.HotModuleReplacementPlugin(),
    new DependencyExtractionWebpackPlugin()
  ],

  externals: {
    react: "React",
    "react-dom": "ReactDOM"
  }
};
