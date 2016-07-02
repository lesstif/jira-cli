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
                    new InputOption('field-exclude', 'f', InputOption::VALUE_REQUIRED, 'exclude specific field'),
                ])
            );
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $field_exclude = explode(',', $input->getOption('field-exclude'));
        try {
            $proj = new ProjectService();

            $prjs = $proj->getAllProjects();

            foreach ($prjs as $p) {

                $output->writeln($p->toString($field_exclude));
            }
        } catch (JiraException $e) {
            $output->writeln("Error Occured! " . $e->getMessage());
        }

    }
}
