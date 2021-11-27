const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    //mode: "production", // "production" | "development" | "none"
    entry: {
        app: [
            "@babel/polyfill",
            "./resources/js/app.js",
            "./resources/sass/app.scss"
        ],
    },
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: "src/js/[name].bundle.js"
    },
    resolve: {
        extensions: ['.js', '.css', '.scss']
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
                //option 1: /\.s[ac]ss$/i  
                //option 2: /\.css$/i
                //option 3: /\.(css|s[ac]ss)$/i 
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