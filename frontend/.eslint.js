module.exports = {
    env: {
        es2021: true,
        node: true,
    },
    extends: [
        'standard',
        'plugin:vue/vue3-essential',
        'airbnb-base',
    ],
    parserOptions: {
        ecmaVersion: 12,
        sourceType: 'module',
    },
    plugins: [
        'vue',
    ],
    rules: {
        'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
        'no-plusplus': 'off',
        'no-return-assign': 'off',
        'max-len': 'off',
        'no-param-reassign': [
            'error',
            {
                props: true,
                ignorePropertyModificationsFor: ['agg', 'state'],
            },
        ],
    },
};
