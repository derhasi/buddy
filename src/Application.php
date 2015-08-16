<?php

namespace derhasi\buddy;

use derhasi\buddy\Command\Buddy;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Command line application overriding default symfony/console application.
 *
 * @see http://symfony.com/doc/current/components/console/single_command_tool.html
 */
class Application extends \Symfony\Component\Console\Application {

  /**
   * {@inheritdoc}
   */
  protected function getCommandName(InputInterface $input)
  {
    return 'buddy';
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultCommands()
  {
    // Keep the core default commands to have the HelpCommand
    // which is used when using the --help option
    $defaultCommands = parent::getDefaultCommands();
    $defaultCommands[] = new Buddy();

    return $defaultCommands;
  }

  /**
   * {@inheritdoc}
   */
  public function getDefinition()
  {
    $inputDefinition = parent::getDefinition();
    // clear out the normal first argument, which is the command name
    $inputDefinition->setArguments();

    return $inputDefinition;
  }


}