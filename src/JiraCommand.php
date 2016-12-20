<?php
namespace Lesstif\JiraCli;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputDefinition;

class JiraCommand extends SymfonyCommand
{
    protected $lineBreaker = '-';
    protected $title = 'Jira-Command';
    protected $showMenu = false;

    protected function configure()
    {
        $this
            ->setDescription('Describe args behaviors')
            ->setDefinition(
                new InputDefinition([
                    new InputOption('menu', 'm', InputOption::VALUE_NONE, 'show cli Menu'),
                ])
            );
    }
}