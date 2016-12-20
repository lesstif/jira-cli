<?php

namespace Lesstif\JiraCli\Project;

use Lesstif\JiraCli\JiraCommand;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;

use JiraRestApi\Project\ProjectService;

use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;

class ListCommand extends JiraCommand
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

            if (!$this->showMenu) {
                foreach ($prjs as $p) {
                    $output->writeln($p->toString($field_exclude));
                }
                return;
            }

            $itemCallable = function (CliMenu $menu) {
                $text = explode("-", $menu->getSelectedItem()->getText());
                $key = trim($text[0]);

                $p = (new ProjectService())->get($key);
                var_dump($p);
            };

            $builder = (new CliMenuBuilder)
                ->setTitle('JIRA Project List');

            foreach ($prjs as $p) {
                $builder->addItem($p->key . " - \"" . $p->name. "\"", $itemCallable, true);
            }

            $menu = $builder->addLineBreak('-')
                ->build();

            $menu->open();

        } catch (JiraException $e) {
            $output->writeln("Error Occured! " . $e->getMessage());
        }

    }
}
