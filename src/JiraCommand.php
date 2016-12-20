<?php
namespace Lesstif\JiraCli;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class JiraCommand extends SymfonyCommand
{
    protected $lineBreaker = '-';
    protected $title = 'Jira-Command';
    protected $showMenu = true;

    protected function configure()
    {
        $this
            ->setDescription('Describe args behaviors')
            ->setDefinition(
                new InputDefinition(array(
                    new InputOption('showMenu', 'm')
                ))
            );
    }
}