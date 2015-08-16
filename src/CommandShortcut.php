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
   * @param string $arguments
   *   Passed arguments and options as strings.
   */
  public function execute($arguments)
  {
    // Validate on given command.
    if (!isset($this->options['command'])) {
      throw new \Exception(sprintf('No command given for "%s"', $this->name));
    }


    // Execute the command.
    $status = NULL;
    if (strlen($arguments) > 0) {
      passthru(sprintf('%s %s', $this->options['command'], $arguments), $status);
    }
    else {
      passthru(sprintf('%s', $this->options['command']), $status);
    }
    exit($status);
  }
}
