# buddy

A command line tool to help you execute a command in the direct location

## Example commands

```
buddy composer
buddy drush
```

## Example .buddy.yml

```yml
composer:
  mode: global
  cwd: true
drush:
  cmd: vendor/bin/drush
  defaults:
    uri: http://example.com
    root: {{DIR}}/docroot
```
