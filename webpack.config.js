const path = require('path');
const glob = require('glob-all');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { PurgeCSSPlugin } = require('purgecss-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const themeDir = path.resolve(__dirname, 'wp-content/themes/maristela-medeiros-2022');
const srcDir = path.resolve(themeDir, 'gulp');

module.exports = (env, argv) => {
  const isProduction = argv.mode === 'production';

  return {
    entry: {
      'js/scripts.min': path.resolve(srcDir, 'js/main.js'),
      'css/style': path.resolve(srcDir, 'scss/style.scss'),
      'css/home': path.resolve(srcDir, 'scss/home.scss'),
      'css/critical': path.resolve(srcDir, 'scss/critical.scss'),
    },
    output: {
      path: themeDir,
      filename: '[name].js',
      clean: false,
    },
    module: {
      rules: [
        {
          test: /\.s[ac]ss$/i,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader',
              options: {
                url: false,
              },
            },
            {
              loader: 'sass-loader',
              options: {
                api: 'modern-compiler',
                sassOptions: {
                  includePaths: [
                    path.resolve(__dirname),
                    path.resolve(__dirname, 'node_modules'),
                  ],
                  silenceDeprecations: ['import', 'legacy-js-api', 'color-functions', 'global-builtin'],
                },
              },
            },
          ],
        },
      ],
    },
    plugins: [
      {
        apply: (compiler) => {
          compiler.hooks.compilation.tap('RemoveCssJsAssetsPlugin', (compilation) => {
            compilation.hooks.processAssets.tap(
              {
                name: 'RemoveCssJsAssetsPlugin',
                stage: compiler.webpack.Compilation.PROCESS_ASSETS_STAGE_SUMMARIZE,
              },
              (assets) => {
                Object.keys(assets).forEach((assetName) => {
                  if (assetName.startsWith('css/') && assetName.endsWith('.js')) {
                    delete assets[assetName];
                  }
                });
              }
            );
          });
        },
      },
      new MiniCssExtractPlugin({
        filename: '[name].css',
      }),
      new PurgeCSSPlugin({
        paths: glob.sync([`${themeDir}/**/*.php`], { nodir: true }),
        safelist: {
          standard: [/^nav/, /nav$/, 'show', 'fade', 'modal', 'active', 'open', 'collapsed', 'collapsing'],
          greedy: [/^nav/, /^modal/, /^tab-/],
        },
      }),
      new CopyPlugin({
        patterns: [
          {
            from: path.resolve(srcDir, 'images'),
            to: path.resolve(themeDir, 'images'),
            noErrorOnMissing: true,
          },
          {
            from: path.resolve(srcDir, 'js/main.js'),
            to: path.resolve(srcDir, 'js/scripts.js'),
            noErrorOnMissing: true,
          },
        ],
      }),
      new BrowserSyncPlugin(
        {
          host: 'localhost',
          port: 3000,
          proxy: 'http://localhost/maristela-medeiros/',
          files: [
            `${themeDir}/**/*.php`,
            `${themeDir}/css/*.css`,
            `${themeDir}/js/*.js`,
          ],
          notify: true,
        },
        {
          reload: false,
        }
      ),
    ],
    optimization: {
      minimize: isProduction,
      minimizer: [
        new TerserPlugin({
          extractComments: false,
          terserOptions: {
            format: {
              comments: false,
            },
          },
        }),
        new ImageMinimizerPlugin({
          minimizer: {
            implementation: ImageMinimizerPlugin.imageminMinify,
            options: {
              plugins: [
                ['gifsicle', { interlaced: true }],
                ['mozjpeg', { quality: 80, progressive: true }],
                ['pngquant', { quality: [0.65, 0.90], speed: 4 }],
                [
                  'svgo',
                  {
                    plugins: [
                      {
                        name: 'preset-default',
                        params: {
                          overrides: {
                            removeViewBox: false,
                          },
                        },
                      },
                    ],
                  },
                ],
              ],
            },
          },
        }),
      ],
    },
  };
};
