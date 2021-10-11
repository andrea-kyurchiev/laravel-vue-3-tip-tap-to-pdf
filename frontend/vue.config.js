module.exports = {
    configureWebpack: {
        devServer: {
            watchOptions: {
                ignored: /(node_modules|.env)/,
            },
        },
    },
};
