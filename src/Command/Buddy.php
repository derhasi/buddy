<?php
/**
 * @file
 * BuddyCommand.php
 */

namespace derhasi\buddy\Command;

use derhasi\buddy\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Buddy extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure()
  {
    $this
      ->setName('buddy')
      ->setDescription('Locates and runs a commandline tool')
      ->addArgument(
        'command',
        InputArgument::REQUIRED,
        'The command shortcut for the command to call, as specified in your .buddy.yml'
      )
      ->addArgument(
        'arguments',
        InputArgument::IS_ARRAY,
        'The command shortcut for the command to call, as specified in your .buddy.yml'
      )
    ;
    // We disable validation, so we can grab all options and arguments from the
    // input.
    $this->ignoreValidationErrors();
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {

    // Locate
    $config = new Config();
    $config->load(getcwd());

    // We need to use $argv directly, as otherwise we cannot retrieve all
    // arguments and options.
    global $argv;

    $arguments = $argv;
    // The first is the command itself.
    array_shift($arguments);
    $command = array_shift($arguments);

    $config->getCommand($command)
      ->execute($arguments);
  }
}