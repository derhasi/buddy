<?php
/**
 * @file
 * Contains derhasi\buddy\Config.
 */

namespace derhasi\buddy;

use derhasi\buddy\Config\BuddySchema;
use derhasi\buddy\Config\YamlLoader;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;

/**
 * Wrapper for loading and processing configuration.
 */
class Config {

  const FILENAME = '.buddy.yml';

  /**
   * @var array
   */
  protected $commands = array();

  /**
   * Loads the configuration file data.
   */
  public function load($workingDir)
  {
    $locator = new FileLocator($this->getPotentialDirectories($workingDir));
    $loader = new YamlLoader($locator);

    // Config validation.
    $processor = new Processor();
    $schema = new BuddySchema();

    $files = $locator->locate(static::FILENAME, NULL, FALSE);
    foreach ($files as $file) {
      // After loading the raw data from the yaml file, we validate given
      // configuration.
      $raw = $loader->load($file);
      $conf = $processor->processConfiguration($schema, array('buddy' => $raw));
      if (isset($conf['commands'])) {
        foreach($conf['commands'] as $command => $specs) {
          if (!isset($this->commands[$command])) {
            $this->commands[$command] = array(
              'options' => $specs,
              'file' => $file,
            );
          }
        }
      }

      // In the case 'root' is set, we do not process any parent buddy files.
      if (!empty($values['root'])) {
        break;
      }
    }

    return $this;
  }

  /**
   * Check if configuration for the given command is available.
   *
   * @param string $command
   *   Command or command shortcut to search for in the configuration.
   *
   * @return bool
   *   Returns TRUE if a command config is available.
   */
  public function hasCommand($command)
  {
    return isset($this->commands[$command]);
  }

  /**
   * Provides the command specification.
   *
   * @param string $command
   *
   * @return \derhasi\buddy\CommandShortcut
   *   Command shortcut
   */
  public function getCommand($command)
  {
    return new CommandShortcut($command, $this->commands[$command]['options'], $this->commands[$command]['file']);
  }

  /**
   * Helper to provide potential directories to look for .buddy.yml files.
   *
   * @return array
   *   List of directory paths.
   */
  protected function getPotentialDirectories($workingDir)
  {
    $paths = array();
    $path = '';
    foreach (explode('/', $workingDir) as $part) {
      $path .= $part . '/';
      $paths[] = rtrim($path, '/');
    }
    return $paths;
  }
}
