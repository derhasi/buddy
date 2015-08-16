<?php
/**
 * @file
 * CommandShortcut.php
 */

namespace derhasi\buddy;


class CommandShortcut {

  /**
   * @var string
   */
  protected $name;

  /**
   * @var array
   */
  protected $options;

  /**
   * Constructor for
   *
   * @param string $name
   *   Unique shortcut name for the command.
   * @param array $options
   *
   */
  public function __construct($name, $options)
  {
    $this->name = $name;
    $this->options = $options;
  }

  /**
   * Runs the given command.
   *
   * @param array $arguments
   *   Array of arguments and options to pass to the command.
   *
   * @throws \Exception
   */
  public function execute($arguments)
  {
    // Validate on given command.
    if (!isset($this->options['command'])) {
      throw new \Exception(sprintf('No command given for "%s"', $this->name));
      exit(1);
    }

    // Execute the command.
    $status = NULL;
    $cmd = $this->options['command'];
    foreach ($arguments as $arg) {
      $cmd .= ' ' . escapeshellarg($arg);
    }
    passthru(escapeshellcmd($cmd), $status);
    exit($status);
  }
}
