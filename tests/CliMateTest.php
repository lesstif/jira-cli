<?php

/**
 * Created by PhpStorm.
 * User: lesstif
 * Date: 2016-12-21
 * Time: 오후 1:57
 */

use League\CLImate\CLImate;

class CliMateTest extends PHPUnit_Framework_TestCase
{
    public function testOut()
    {
        $climate = new CLImate;

        $climate->out('This prints to the terminal.');
    }

    public function testTable()
    {
        $climate = new CLImate;

        $climate->redTable([
            [
                'name'       => 'Walter White',
                'role'       => 'Father',
                'profession' => 'Teacher',
            ],
            [
                'name'       => 'Skyler White',
                'role'       => 'Mother',
                'profession' => 'Accountant',
            ],
        ]);

        $climate->bold()->backgroundBlue()->border();

        $climate->underlineJson([
            'name' => '<font color="red">Gary</font>',
            'age'  => '<bold>52</bold>',
            'job'  => '<blink>Engineer</blink>',
        ]);
    }
}
