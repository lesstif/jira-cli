<?php

namespace Lesstif\JiraCli\Project;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;

use JiraRestApi\Project\ProjectService;

class ListCommand extends SymfonyCommand
{
    protected function configure()
    {
        $this
            ->setName('project:list')
            ->setDescription('project show command')
            ->setDefinition(
                new InputDefinition([
                    new InputOption('field', 'f', InputOption::VALUE_OPTIONAL, 'show specific field only'),
                ])
            );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $field = $input->getOption('field');

        try {
            $proj = new ProjectService();

            $prjs = $proj->getAllProjects();

            foreach ($prjs as $p) {
                $output->writeln($p);
            }
        } catch (JiraException $e) {
            $output->writeln("Error Occured! " . $e->getMessage());
        }

    }
}
