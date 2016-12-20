<?php

namespace Lesstif\JiraCli\Project;

use Lesstif\JiraCli\JiraCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use JiraRestApi\Project\ProjectService;

class ShowCommand extends JiraCommand
{
    protected function configure()
    {
        $this
            ->setName('project:show')
            ->setDescription('project show command')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('name', InputArgument::REQUIRED, 'specify project name or key'),
                    //new InputOption('field-exclude', InputArgument::OPTIONAL|InputArgument::IS_ARRAY, 'show specific field only'),
                    new InputOption('field-exclude', 'f', InputOption::VALUE_REQUIRED, 'exclude specific field'),
                ])
            );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // project
        $nameOrKey = strtoupper($input->getArgument('name'));

        $field_exclude = explode(',', $input->getOption('field-exclude'));

        try {
            $proj = new ProjectService();

            //Project
            $p = $proj->get($nameOrKey);

            $output->writeln($p->toString($field_exclude));
        } catch (JiraException $e) {
            $output->writeln("Error Occured! " . $e->getMessage());
        }
    }
}
