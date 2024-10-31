<?php

namespace Info2\ComposerDemo\Log;

use Psr\Log\AbstractLogger;

class MemoryLogger extends AbstractLogger
{
    protected array $logs = [];

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->logs[] = [
            'level' => $level,
            'message' => $message,
        ];
    }

    public function get(): array
    {
        return $this->logs;
    }

    public function clear(): void
    {
        $this->logs = [];
    }
}