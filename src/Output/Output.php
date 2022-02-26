<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Output;

use SebastianBergmann\CodeCoverage\Report\PHP;

class Output implements OutputInterface
{
    public function writeln(string $string): void
    {
        fwrite(STDOUT, $string . PHP_EOL);
    }
}
