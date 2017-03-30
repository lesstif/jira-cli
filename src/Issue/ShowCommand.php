<?php

namespace Lesstif\JiraCli\Issue;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\IssueField;

class ShowCommand extends SymfonyCommand
{
    protected function configure()
    {
        $this
            ->setName('issue:show')
            ->setDescription('issue show command')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('key', InputArgument::REQUIRED, 'specify issue key'),
                    //new InputOption('field-exclude', InputArgument::OPTIONAL|InputArgument::IS_ARRAY, 'show specific field only'),
                    new InputOption('field-exclude', 'f', InputOption::VALUE_REQUIRED, 'exclude specific field'),
                ])
            );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // issue key
        $issueKey = strtoupper($input->getArgument('key'));

        $field_exclude = explode(',', $input->getOption('field-exclude'));

        try {
            $iss = new IssueService();

            //get issue info
            $is = $iss->get($issueKey);

            $output->writeln($is->toString($field_exclude));
        } catch (JiraException $e) {
            $output->writeln("Error Occured! " . $e->getMessage());
        }
    }

}
