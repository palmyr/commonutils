<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Shell\Command;

use Palmyr\CommonUtils\Shell\Exception\ShellException;
use Palmyr\CommonUtils\Shell\Result\ShellResultInterface;
use Palmyr\CommonUtils\String\StringableInterface;

interface ShellCommandInterface extends StringableInterface
{
    /**
     * @return ShellResultInterface
     * @throws ShellException
     */
    public function execute(): ShellResultInterface;
}
