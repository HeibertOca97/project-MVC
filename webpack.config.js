const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    //mode: "production", // "production" | "development" | "none"
    entry: {
        app: [
            //"@babel/polyfill", // Syntax JS
            "./resources/js/app.ts",
            "./resources/sass/app.scss"
        ],
    },
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: "src/js/[name].bundle.js"
    },
    resolve: {
        extensions: ['.js', '.ts']
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
                use:'ts-loader'
            },
            { 
                test: /\.(css|s[ac]ss)$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    // Creates `style` nodes from JS strings
                    // "style-loader",
                    // Translates CSS into CommonJS
                    "css-loader",
                    // Compiles Sass to CSS
                    "sass-loader",
                ],
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "src/css/[name].bundle.css",
            // chunkFilename: "[id].css",
        }),
    ]
}
