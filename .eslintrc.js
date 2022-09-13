const eslintConfig = {
	root: true,
	extends: [ 'plugin:@wordpress/eslint-plugin/recommended-with-formatting' ],
	rules: {
		'import/no-extraneous-dependencies': 'off',
		'import/no-global-event-listener': 'off',
	},
};

module.exports = eslintConfig;
