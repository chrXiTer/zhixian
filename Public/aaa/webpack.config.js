var webpack = require("webpack");

module.exports = {
    entry: {
        main: './component/main.jsx',
    },
    output: {
        path: __dirname,
        filename: 'build/[name].js'
    },
    resolve: {
        extensions: ['', '.js', '.jsx']
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        }),
        new webpack.DefinePlugin({
            "process.env": {
                NODE_ENV: JSON.stringify("production")
            }
        })
    ],
    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                loader: 'babel-loader',
                query: {
                    presets: ['react', 'es2015']
                }
            },
            {   
                test: /\.css$/, 
                loader: "style!css" 
            }
        ]
    },

    
}


/*
./node_modules/webpack/bin/webpack.js

        loaders: [
            {
                test: /\.jsx?$/,
                loaders: ['babel', 'jsx'],
                query:{
                    presets: ['es2015']
                }
            },
        ]
        */