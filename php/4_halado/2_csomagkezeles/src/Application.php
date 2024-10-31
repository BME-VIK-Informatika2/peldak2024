<?php

namespace Info2\ComposerDemo;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class Application implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function init(): void
    {
        $this->logger?->info('Application is initialized');
    }

    public function start(): void
    {
        $this->logger?->info('Application is running');
    }

}