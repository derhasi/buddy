<?php
/**
 * @file
 * CommandShortcut.php
 */

namespace derhasi\buddy;

use Webmozart\PathUtil\Path;

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
   * @var string
   */
  protected $configFile;

  /**
   * Constructor for
   *
   * @param string $name
   *   Unique shortcut name for the command.
   * @param array $options
   *   Array of command options, containing 'cmd', ...
   * @param string $configFile
   *   Location of the configuration file, command was loaded from.
   */
  public function __construct($name, $options, $configFile)
  {
    $this->name = $name;
    $this->options = $options;
    $this->configFile = $configFile;
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
    if (!isset($this->options['cmd'])) {
      throw new \Exception(sprintf('No command given for "%s"', $this->name));
      exit(1);
    }

    // If a explicit working directory is specifified, we change to that to call
    // the command.
    $workingDir = $this->getWorkingDir();
    if (isset($workingDir)) {
      chdir($workingDir);
    }

    // Execute the command.
    $status = NULL;
    $cmd = $this->options['cmd'];

    // If a explicit command dir is given, we use an absolute path to the command.
    $cmdDir = $this->getCmdDir();
    if (isset($cmdDir)) {
      $cmd = $cmdDir . '/' . $cmd;
    }
    $cmd = escapeshellcmd($cmd);

    // Add passed arguments to the command.
    foreach ($arguments as $arg) {
      $cmd .= ' ' . escapeshellarg($arg);
    }
    passthru($cmd, $status);
    exit($status);
  }

  /**
   * Helper to retrieve the working directory for the command.
   */
  protected function getWorkingDir() {
    if (!isset($this->options['workingDir'])) {
      return;
    }
    return $this->processDir($this->options['workingDir']);
  }

  /**
   * Helper to retrieve command directory.
   *
   * @return string|void
   */
  protected function getCmdDir() {
    if (!isset($this->options['cmdDir'])) {
      return;
    }
    return $this->processDir($this->options['cmdDir']);
  }

  /**
   * Process given dir with replacements and makes it absolute.
   *
   * @param string $dir
   *
   * @return string
   *   Absolute path with placeholders replaced.
   */
  protected function processDir($dir) {
    $dir = $this->replacePattern($dir);
    // The absolute path has to be calculated relative to the configuration file
    if (Path::isRelative($dir)) {
      $dir = Path::makeAbsolute($dir, dirname($this->configFile));
    }
    return rtrim($dir, '/');
  }

  /**
   * Helper to replace certain patterns with actual values.
   *
   * @param string $pattern
   *   Pattern to be replaced
   *
   * @return string
   *
   */
  protected function replacePattern($pattern) {
    $replace = array(
      '$DIR' => dirname($this->configFile),
      '$CWD' => getcwd(),
    );
    return str_replace(array_keys($replace), array_values($replace), $pattern);
  }
}
