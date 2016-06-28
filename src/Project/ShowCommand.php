<?php

namespace Lesstif\JiraCli\Project;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use JiraRestApi\Project\ProjectService;

class ShowCommand extends SymfonyCommand
{
    protected function configure()
    {
        $this
            ->setName('project:show')
            ->setDescription('project show command')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('name', InputArgument::REQUIRED, 'specify project name or key'),
                    new InputArgument('field', InputArgument::OPTIONAL|InputArgument::IS_ARRAY, 'show specific field only'),
                ])
            );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // project
        $nameOrKey = strtoupper($input->getArgument('name'));

        try {
            $proj = new ProjectService();

            //Project
            $p = $proj->get($nameOrKey);

            $output->writeln($p);
        } catch (JiraException $e) {
            $output->writeln("Error Occured! " . $e->getMessage());
        }
    }
}
