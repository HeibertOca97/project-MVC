const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
//const webpack = require('webpack');

module.exports = {
    mode: "production",
    entry: {
        app: [
            "./resources/js/app.js",
            "./resources/sass/app.scss"
        ]
    },
    output: {
        filename: "js/[name].bundle.js",
        path: path.resolve(__dirname, 'public/src/'),
        clean: true,
    },
    resolve: {
        extensions: ['.ts', '.js']
    },
    devtool: false,/*false, 'source-map', 'inline-source-map'*/
    devServer: {
        static: path.resolve(__dirname, 'public'),
    },
    performance: {
        hints: false, // false, warning, error
        maxAssetSize: 100000,
        maxEntrypointSize: 400000,
        // assetFilter: null,
    },
    optimization: {
        removeAvailableModules: false,
        removeEmptyChunks: false,
        splitChunks: false,
    },
    module: {
        rules: [
            {
                test: /\.js$/i,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                }
            },
            {
                test: /\.ts$/i,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'ts-loader',
                        // options: {
                        //     transpileOnly: true
                        // }
                    }
                ]
            },
            {
                test: /\.(css|s[ac]ss)$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    "css-loader",
                    "sass-loader",
                ],
            },
            {
                test: /\.(png|jpe?g|gif)$/i,
                use: [
                    {
                        loader: 'file-loader',
                    },
                ],
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "css/[name].bundle.css",
        }),
        /*new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        }),*/
    ]
}
