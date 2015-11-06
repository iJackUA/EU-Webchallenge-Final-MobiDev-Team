module.exports = {
    entry: "./web/js/app.js",
    output: {
        path: "./web/js",
        publicPath: "/web/js/",
        filename: "build.js"
    },
    module: {
        loaders: [
            {test: /\.html$/, loader: "html"}
        ]
    }
}
