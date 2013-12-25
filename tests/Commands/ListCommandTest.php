<?php

use Hsyngkby\gettext\Commands\ListCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class ListCommandTest extends Orchestra\Testbench\TestCase {

    protected function getPackageProviders ()
    {
        return array(
            'Hsyngkby\gettext\gettextServiceProvider',
        );

    }

    protected function getPackageAliases ()
    {
        return array(
            'gettext' => 'Hsyngkby\gettext\Facades\gettext',
        );

    }

    public function testListCommandSuccessfull ()
    {
        $expected = "en_US.utf8";
        gettext::shouldReceive('getLocaleAndEncoding')->once()->andReturn($expected);

        $commandTester = new CommandTester(new ListCommand);
        $commandTester->execute(array());
        $this->assertStringEndsWith("current default setting: [$expected]\n", $commandTester->getDisplay());

    }

    public function tearDown ()
    {
        m::close();

    }

}

?>