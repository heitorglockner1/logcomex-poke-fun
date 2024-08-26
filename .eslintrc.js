module.exports = {
    // https://eslint.org/docs/user-guide/configuring#configuration-cascading-and-hierarchy
    // This option interrupts the configuration hierarchy at this file
    // Remove this if you have an higher level ESLint config file (it usually happens into a monorepos)
    root: true,

    parserOptions: {
        parser: "@babel/eslint-parser",
        ecmaVersion: 2018, // Allows for the parsing of modern ECMAScript features
        sourceType: "module", // Allows for the use of imports
    },

    env: {
        browser: true,
    },

    // Rules order is important, please avoid shuffling them
    extends: [
        // Base ESLint recommended rules
        // 'eslint:recommended',

        // Uncomment any of the lines below to choose desired strictness,
        // but leave only one uncommented!
        // See https://eslint.vuejs.org/rules/#available-rules
        "plugin:vue/vue3-essential", // Priority A: Essential (Error Prevention)
        "plugin:vue/vue3-strongly-recommended", // Priority B: Strongly Recommended (Improving Readability)
        "plugin:vue/vue3-recommended", // Priority C: Recommended (Minimizing Arbitrary Choices and Cognitive Overhead)

        // https://github.com/prettier/eslint-config-prettier#installation
        // usage with Prettier, provided by 'eslint-config-prettier'.
        "prettier",
    ],

    plugins: [
        // https://eslint.vuejs.org/user-guide/#why-doesn-t-it-work-on-vue-file
        // required to lint *.vue files
        "vue",

        // https://github.com/typescript-eslint/typescript-eslint/issues/389#issuecomment-509292674
        // Prettier has not been included as plugin to avoid performance impact
        // add it as an extension for your IDE
    ],

    globals: {
        __statics: "readonly",
        process: "readonly",
        Capacitor: "readonly",
        chrome: "readonly",
    },

    // add your custom rules here
    rules: {
        "vue/max-attributes-per-line": ["error", { singleline: 5 }],
        "vue/no-spaces-around-equal-signs-in-attribute": ["error"],
        "vue/attribute-hyphenation": ["error", "always"],
        "vue/html-closing-bracket-newline": [
            "error",
            {
                singleline: "never",
                multiline: "never",
            },
        ],
        "vue/html-closing-bracket-spacing": [
            "error",
            {
                startTag: "never",
                endTag: "never",
                selfClosingTag: "always",
            },
        ],
        "vue/singleline-html-element-content-newline": [
            "error",
            {
                ignoreWhenNoAttributes: true,
                ignoreWhenEmpty: true,
                ignores: [
                    "pre",
                    "textarea",
                    "p",
                    "span",
                    "b",
                    "h1",
                    "h2",
                    "h3",
                    "h4",
                    "h5",
                    "h6",
                    "i",
                    "label",
                    "strong",
                ],
            },
        ],
        "vue/html-quotes": ["error", "double", { avoidEscape: false }],
        "vue/next-tick-style": ["error", "promise"],
        "vue/no-multi-spaces": ["error", { ignoreProperties: false }],
        "vue/require-explicit-emits": ["error", { allowProps: false }],
        "vue/component-tags-order": [
            "error",
            {
                order: ["template", "script", "style"],
            },
        ],
        "vue/no-static-inline-styles": ["error", { allowBinding: false }],
        "vue/no-this-in-before-route-enter": "error",
        "vue/padding-line-between-blocks": "warn",
        complexity: ["warn", 16],
        "prefer-promise-reject-errors": "off",
        "generator-star-spacing": "off",
        "arrow-parens": "off",
        "one-var": "off",
        "no-void": "off",
        "multiline-ternary": "off",
        "no-unreachable-loop": ["off"],
        "no-duplicate-imports": "error",
        eqeqeq: "error",
        "no-trailing-spaces": ["warn", { ignoreComments: true }],

        // allow debugger during development only
        "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
    },
};
