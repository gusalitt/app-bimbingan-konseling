const path = require('path');

module.exports = {
    mode: "development",
    entry: "./public/assets/js/apexcharts.js",
    output: {
        filename: "apexcharts.bundle.js",
        path: path.resolve(__dirname, "public/assets/js"),
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
            },
        ],
    },
    resolve: {
        alias: {
            apexcharts: path.resolve(__dirname, "node_modules/apexcharts"),
            '@public': path.resolve(__dirname, "public/assets/js/apexcharts-config"),
        }
    },
    watch: true, 
	watchOptions: {
		ignored: /node_modules/,
		aggregateTimeout: 300,
		poll: 1000,
	},
};