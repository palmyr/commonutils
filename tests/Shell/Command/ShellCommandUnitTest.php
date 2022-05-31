<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\Shell\Command;

use Palmyr\CommonUtils\FileSystem\FileSystem;
use Palmyr\CommonUtils\Shell\Exception\ShellException;
use Palmyr\CommonUtils\Shell\Factory\ShellCommandFactory;
use Palmyr\CommonUtils\Shell\Factory\ShellCommandFactoryInterface;
use PHPUnit\Framework\TestCase;
use Palmyr\CommonUtils\Shell\Command\ShellCommand;

class ShellCommandUnitTest extends TestCase
{
    protected ShellCommandFactoryInterface $shellCommandFactory;

    /**
     * @return void
     * @throws ShellException
     * @covers ShellCommand::execute
     */
    public function testExecuteOk(): void
    {
        $directory = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'files';

        $command = $this->shellCommandFactory->build('ls {{arg}}', ['arg' => '-a'], $directory);

        $result = $command->execute();

        $this->assertEquals(0, $result->getCode());

        $this->assertEquals(['.', '..', 'test2.txt', 'test.txt'], $result->getOutput());
    }

    /**
     * @return void
     * @covers ShellCommand::execute
     */
    public function testGetCurrentDirectory(): void
    {
        $command = $this->shellCommandFactory->build('pwd');

        $result = $command->execute();

        $this->assertEquals(0, $result->getCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $fileSystem = new FileSystem();

        $this->shellCommandFactory = new ShellCommandFactory($fileSystem);
    }
}
