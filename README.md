# buddy

A command line tool to help you execute a command in the direct location

## Example commands

```
buddy composer
buddy drush
b drush # Alternate shortcut
```

## Example .buddy.yml

```yml
commands:
  composer:
    cmd: composer
    #cwd: true
  drush:
    cmd: vendor/bin/drush
    #defaults:
    #  uri: http://example.com
    #  root: {{DIR}}/docroot
root: false
```
