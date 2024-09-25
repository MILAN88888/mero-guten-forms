const path = require("path");
const webpack = require("webpack");
const CopyPlugin = require("copy-webpack-plugin");
const DependencyExtractionWebpackPlugin = require("@wordpress/dependency-extraction-webpack-plugin");
const BundleAnalyzerPlugin =
  require("webpack-bundle-analyzer").BundleAnalyzerPlugin;
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const ForkTsCheckerPlugin = require("fork-ts-checker-webpack-plugin");
const ReactRefreshWebpackPlugin = require("@pmmmwh/react-refresh-webpack-plugin");
const WebpackBar = require("webpackbar");

module.exports = (env, argv) => {
  const isDevelopment = argv.mode === "development";

  return {
    entry: {
      blocks: path.resolve(process.cwd(), "src/blocks", "index.ts")
    },
    output: {
      path: path.resolve(process.cwd(), "build"),
      filename: "[name].min.js",
      libraryTarget: "this",
      publicPath: "http://localhost:3000/dist"
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
              ],
              plugins: isDevelopment
                ? [require.resolve("react-refresh/babel")]
                : []
            }
          }
        },
        {
          test: /\.css$/i,
          use: [
            isDevelopment ? "style-loader" : MiniCSSExtractPlugin.loader,
            "css-loader"
          ]
        },
        {
          test: /\.scss$/i,
          use: [
            isDevelopment ? "style-loader" : MiniCSSExtractPlugin.loader,
            "css-loader",
            "sass-loader"
          ]
        }
      ]
    },
    optimization: {
      minimize: !isDevelopment
    },
    plugins: [
      new DependencyExtractionWebpackPlugin(),
      new ForkTsCheckerPlugin({
        async: false
      }),
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
      !isDevelopment &&
        new MiniCSSExtractPlugin({
          filename: "[name].css"
        }),
      new BundleAnalyzerPlugin({
        analyzerMode: isDevelopment ? "server" : "static",
        openAnalyzer: false
      }),
      isDevelopment &&
        new ReactRefreshWebpackPlugin({
          overlay: false
        }),
      new WebpackBar()
    ],
    devtool: isDevelopment ? "source-map" : false,
    devServer: {
      headers: { "Access-Control-Allow-Origin": "*" },
      allowedHosts: "all",
      host: "localhost",
      port: 3000,
      client: {
        overlay: false
      }
    },
    externals: {
      react: "React",
      "react-dom": "ReactDOM"
    }
  };
};
