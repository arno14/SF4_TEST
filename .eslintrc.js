//  On vs code 
//  disable prettier extension
//  and add in settings.json "editor.codeActionsOnSave": { "source.fixAll.eslint": true}
module.exports = {
  env: {
    browser: true,
    es6: true,
    amd: true,
  },
  extends: [
    "plugin:vue/essential",
    "airbnb-base",
    "eslint:recommended",
    "plugin:prettier/recommended",
  ],
  globals: {
    Atomics: "readonly",
    SharedArrayBuffer: "readonly",
  },
  parserOptions: {
    ecmaVersion: 2018,
    sourceType: "module",
  },
  plugins: ["vue", "prettier"],
  rules: {
    "prettier/prettier": [
      "error",
      {
        singleQuote: true,
        //   tabWidth: 4,
        trailingComma: "all",
      },
    ],
    //conflict with prettier
    "comma-dangle": "off",
    "arrow-parens": "off",
  },
};
