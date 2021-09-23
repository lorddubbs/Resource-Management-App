const { VueLoaderPlugin } = require("vue-loader");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const webpack = require("webpack");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const path = require("path");

const publicPath = "/";

module.exports = {
    entry: {
      main: path.resolve(__dirname, "./src/main.js")
    },
    output: {
      path: path.resolve(__dirname, "./dist"),
      filename: "[name].[contenthash:8].bundle.js",
      publicPath: publicPath
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: ["babel-loader"]
        },
        {
          test: /\.vue$/,
          loader: "vue-loader"
        },
        {
          test: /\.(woff|woff2|eot|ttf|svg)(\?.*$|$)/,
          use: [
            {
              loader: "file-loader",
              options: {
                name: "fonts/[name].[contenthash:8].[ext]",
                esModule: false
              }
            }
          ]
        },
        {
          test: /\.(?:ico|gif|png|jpg|jpeg)$/i,
          use: [
            {
              loader: "file-loader",
              options: {
                name: "img/[name].[contenthash:8].[ext]",
                esModule: false
              }
            }
          ],
          type: "javascript/auto"
        },
        {
          test: /\.(sass|scss|css)$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: "css-loader"
            },
            {
              loader: "postcss-loader",
              options: {
                postcssOptions: {
                  plugins: [["autoprefixer"]]
                }
              }
            },
            "resolve-url-loader",
            {
              loader: "sass-loader",
              options: {
                sourceMap: true
              }
            }
          ]
        }
      ]
    },
    plugins: [
      new VueLoaderPlugin(),
      new CleanWebpackPlugin(),
      new MiniCssExtractPlugin({
        filename: "css/[name].[contenthash:8].css"
      }),
      new webpack.DefinePlugin({
        "process.env": {
          BASE_URL: JSON.stringify("/"),
          API_URL: JSON.stringify("http://localhost/app/v1")
        }
      }),
      new HtmlWebpackPlugin({
        title: "SRM",
        template: path.resolve(__dirname, "public", "index.html"),
        favicon: "./public/favicon.ico"
      }),
      new webpack.HotModuleReplacementPlugin()
    ],
    resolve: {
      alias: {
        vue$: "vue/dist/vue.runtime.esm.js",
        "@": path.resolve(__dirname, "src"),
      },
      extensions: ["*", ".js", ".vue", ".json"]
    },
    optimization: {
      moduleIds: "deterministic",
      runtimeChunk: "single",
      splitChunks: {
        cacheGroups: {
          vendor: {
            test: /[\\/]node_modules[\\/]/,
            name: "vendors",
            priority: -10,
            chunks: "all"
          }
        }
      },
      minimize: true,
      minimizer: [
        // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
        // `...`,
        new CssMinimizerPlugin()
      ]
    }
  };