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

class CreateCommand extends SymfonyCommand
{
    protected function configure()
    {
        $this
            ->setName('issue:create')
            ->setDescription('create issue')
            ->setDefinition(
                new InputDefinition([
                    new InputOption('project', 'p', InputOption::VALUE_REQUIRED, 'project name or key'),
                    new InputOption('summary', 's', InputOption::VALUE_REQUIRED, 'issue summary'),
                    new InputOption('assignee', 'a', InputOption::VALUE_OPTIONAL, 'Issue assignee'),
                    new InputOption('priority', 'r', InputOption::VALUE_OPTIONAL, 'Issue priority'),
                    new InputOption('assignee', 'a', InputOption::VALUE_OPTIONAL, 'Issue assignee'),

                    new InputOption('type', 'i', InputOption::VALUE_OPTIONAL, 'Issue Type(BUG, Task, etc...)'),
                    new InputOption('desc', 'd', InputOption::VALUE_OPTIONAL, 'Issue Decription'),

                    new InputOption('version', 'v', InputOption::VALUE_OPTIONAL|InputOption::VALUE_IS_ARRAY, 'Affects version'),
                ])
            );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nameOrKey = $input->getOption('project');
        $summary = $input->getOption('summary');
        $assignee = $input->getOption('assignee');

        try {
            $issueField = new IssueField();

            $issueField->setProjectKey($nameOrKey)
                ->setSummary($summary)
                ->setAssigneeName($assignee);

            $priority = $input->getOption('priority');
            if($priority) {
                $issueField->setPriorityName($priority);
            }

            $issueType = $input->getOption('issueType');
            if($issueType) {
                $issueField->setIssueType($issueType);
            }

            $desc = $input->getOption('desc');
            if($desc) {
                $issueField->setDescription($desc);
            }

            $version = $input->getOption('version');
            if($version) {
                $issueField->addVersion($version);
            }

            $issueService = new IssueService();

            $ret = $issueService->create($issueField);

            //If success, Returns a link to the created issue.
            $output->writeln($ret);
        } catch (JiraException $e) {
            $output->writeln("Error Occured! " . $e->getMessage());
        }
    }

}
