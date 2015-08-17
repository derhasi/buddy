# buddy

A command line tool to help you execute a command in the direct location

## Example commands

```
buddy composer
buddy drush
b drush # Alternate shortcut
```

## Example .buddy.yml

For providing buddy command shortcuts, simply place a `.buddy.yml` in the current
or any parent folder.

```yml
commands:
  composer:
    cmd: composer
    workingDir: $DIR
  drush:
    cmd: vendor/bin/drush
    workingDir: $DIR
    #defaults:
    #  uri: http://example.com
    #  root: $DIR/docroot
root: false
```

`buddy` supports multiple config files, so commands from a parent folders will
get merged. Command shortcuts from subfolders take precedence over those of
parent folders with the same name.

### Structure

* `commands`: This holds a list of command shortcuts. The key is the shortcut to use
  with `buddy` in the CLI.
* `root`: If set to `true`, configuration files in parent folders will get
  ignored

### Command options

* `cmd`: mandatory name of the cli command to call
* `workingDir`: Location from where to call the given command. Defaults to the
  current working directory.

### Replacement patterns

Following replacement patterns can be used for replacing parts of a directory
value:

* `$CWD`: Current working directory
* `$DIR`: Directory of the .buddy.yml file hlding the command configuration
