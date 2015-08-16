<?php
/**
 * @file
 * BuddyCommand.php
 */

namespace derhasi\buddy\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Buddy extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('buddy')
      ->setDescription('Locates and runs a commandline tool')
      ->addArgument(
        'command',
        InputArgument::REQUIRED,
        'The command shortcut for the command to call, as specified in your .buddy.yml'
    ) ;
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $output->write('Yeha!');
  }


}