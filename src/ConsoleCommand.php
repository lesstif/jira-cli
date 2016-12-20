<?php

namespace Lesstif\JiraCli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * PsySh based console command
 *
 * @package Lesstif\JiraCli
 */
class ConsoleCommand extends Command
{
    protected $prompt = 'jira-cli>>> ';

    protected function configure()
    {
        $this
            ->setName('console')
            ->setDescription('Interact with PshSh Based Console')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        while(true) {
            $question = new ConfirmationQuestion($this->prompt, true);

            $helper->ask($input, $output, $question);

            dump([$input, $output]);
        }
    }
}