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
  # calls the global composer command from the root folder
  composer:
    cmd: composer
    workingDir: $DIR
  # Calls a local drush command in ./vendor/bin/drush
  drush:
    cmd: drush
    cmdDir: $DIR/vendor/bin
    workingDir: $DIR
    #defaults: # not implemented yet
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

* `cmd` (required): the actual cli command to call
* `cmdDir` (optional): directory the command is located in. When the directory
  is not given, global commands can be executed.
* `workingDir` (optional): Location from where to call the given command. Defaults to the
  current working directory.

### Replacement patterns

Following replacement patterns can be used for replacing parts of a directory
value:

* `$CWD`: Current working directory
* `$DIR`: Directory of the .buddy.yml file hlding the command configuration

## Installation

After [installing composer](https://getcomposer.org/doc/00-intro.md) you can
install the command globally:

* Run `composer global require derhasi/buddy:dev-master` to install globally.
* Make sure `~/.composer/vendor/bin` is part of your `$PATH`, e.g. by adding
  `export PATH=~/.composer/vendor/bin:$PATH` to your `.bashrc`or `.profile`

## Support

Please post an issue in the [issue queue](https://github.com/derhasi/buddy/issues)
in the case you need support or detect any errors. [Pull requests](https://help.github.com/articles/using-pull-requests/)
are welcome too.
