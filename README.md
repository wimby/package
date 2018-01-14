# Skeleton for Github PHP packages
Command-line tool for `generating` Composer package skeleton (file structure, basic coding standard checkers and code analysing tools, pre-commit hooks...) suitable for Github.

## Features
1) File structure according to [PDS/Skeleton](https://github.com/php-pds/skeleton)
2) Code style checker compliant with [PSR-2](http://http://www.php-fig.org/psr/psr-2/)
3) Pre-commit hook for PHP lint and code style check
4) Suggests other useful libraries

## Why?
Mainly because of my laziness. It helps me create package with all the juicy files like `.editorconfig`, `.gitattributes` and helps me jump strait to a new project.
Second reason is that if I change some basic code style checking tool, I would like to have an easy way to upgrade this tool in all my projects.

## Installation
### Step 1: Composer
Run following command for adding wimby/skeleton as your development dependency:
```bash
composer require-dev wimby/skeleton
```

### Step 2: Configuration
You need to add the following lines to your `composer.json` file:
```json
"scripts": {
    "post-create-project-cmd": "Wimby\\Skeleton::postCreateProject"
}
```

### Step 3: Invoking
```bash
composer create-project
```
or
```bash
composer run-script post-create-project-cmd
```

## License
[WTFPL](http://www.wtfpl.net/) - Do What the Fuck You Want to Public License
