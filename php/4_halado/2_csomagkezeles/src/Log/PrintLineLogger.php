<?php

namespace Info2\ComposerDemo\Log;

use Psr\Log\AbstractLogger;

class PrintLineLogger extends AbstractLogger
{
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        println("[$level] $message");
    }
}