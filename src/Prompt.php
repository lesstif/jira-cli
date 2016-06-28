<?php

namespace Lesstif\JiraCli;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Prompt extends SymfonyCommand
{
    /**
     * The input interface implementation.
     *
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;
    /**
     * @var array
     */
    protected $commandList = [
        'new',
        'into',
        'inspire',
        'help',
    ];
    /**
     * @var string
     */
    protected $name = 'timetrack';
    public function __construct()
    {
        parent::__construct($this->name);
    }
}
