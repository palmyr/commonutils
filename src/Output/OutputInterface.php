<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Output;

interface OutputInterface
{

    public function writeln(string $string): void;

}