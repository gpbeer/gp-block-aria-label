# GP Block Aria Label

Use hooks to add attribute aria-label to WordPress core/blocks.

## Requirements
* PHP 7.3 or higher
* Wordpress version 5 or higher
* Composer [Composer](https://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable).
* NodeJs with npm [Node.js](https://nodejs.org/).

## Development
All the required npm and composer packages will be automatically installed after the command :
* `npm install`

### Front Installation
To add the necessary packages run `npm install`. Here are the other list of npm scripts for testing.

## Code quality

|  | PHP | JS | SCSS |
| :- | :- | :- | :- |
| tool | [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) | [eslint](https://eslint.org/) | [stylelint](https://stylelint.io/) |
| config | `.phpcs.xml` | `.eslintrc.js` | `.stylelintrc` |
| run manually | `composer lint <file>` | `npm run lint:js` | `npm run lint:scss` |
| autofix ✨ | `composer lint:fix <file>` | `npm run lint:js:fix` | `npm run lint:scss:fix` |

### Install package using **`COMPOSER`**
Add to your `composer.json`
```
"repositories": [
   ...
    {
      "type": "vcs",
      "url": "git@github.com:german-pichardo/gp-block-aria-label.git"
    }
],
```

Run
```bash
composer require gp/gp-block-aria-label
```

### Development wordpress coding helper
https://make.wordpress.org/core/handbook/best-practices/coding-standards/
https://wpvip.com/documentation/vip-go/code-review-blockers-warnings-notices/

### Author

* [github/german-pichardo](https://github.com/german-pichardo)
* [http://german-pichardo.com](http://german-pichardo.com)

## Add Additional options

```JavaScript
/**
 * Make additional options
 *
 * @param {Array} options Available options.
 *
 * @return {Array} Filtered options array.
 */
function filterButtonAttributesOptions(options) {

  const customOptions = [
    {
      value: 'data-title',
      label: 'Data Title',
    },
    {
      value: 'data-foo-title',
      label: 'Data Foo Title',
    },
  ];

  options = [...options, ...customOptions];

  return options;

}

wp.hooks.addFilter('gp_block_aria-label.html_attributes_options', 'my_namespace.html_attributes_options', filterButtonAttributesOptions);
```
