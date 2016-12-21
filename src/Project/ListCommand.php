<?php

namespace Lesstif\JiraCli\Project;

use Lesstif\JiraCli\JiraCommand;
use Lesstif\JiraCli\Menu\ItemChooser;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputDefinition;

use JiraRestApi\Project\ProjectService;

use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;

use League\CLImate\CLImate;

use JiraRestApi\Dumper;

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
                    new InputOption('menu', 'm', InputOption::VALUE_NONE, 'show cli Menu'),
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

        $this->showMenu = $input->getOption('menu') ? true : $this->showMenu;

        try {
            $proj = new ProjectService();

            $prjs = $proj->getAllProjects();

            if ($this->showMenu === false) {
                $climate = new CLImate;

                $climate->draw('passed');

                $rows = collect();

                foreach ($prjs as $p) {
                    $ar = [];

                    $ar['key'] = $p->key;
                    $ar['name'] = $p->name;

                    $rows->push($ar);
                }

                $climate->table($rows->toArray());

                return;
            }

            $itemCallable = function (CliMenu $menu) {
                $text = explode("-", $menu->getSelectedItem()->getText());
                $key = trim($text[0]);

                $menu->close();

                $p = (new ProjectService())->get($key);

                $climate = new CLImate;
                $climate->table($p->toArray(['name', 'key', 'description'],false));
                //Dumper::dd($p->toArray(['name', 'key', 'description'],false));
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
