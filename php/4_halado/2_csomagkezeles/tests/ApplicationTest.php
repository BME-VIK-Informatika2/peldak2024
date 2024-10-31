<?php

use Info2\ComposerDemo\Application;
use Info2\ComposerDemo\Log\MemoryLogger;
use PHPUnit\Framework\TestCase;

final class ApplicationTest extends TestCase
{
    private ?MemoryLogger $logger = null;
    private ?Application $application = null;

    protected function setUp(): void
    {
        // Le fog futni minden tesztelés előtt
        $this->logger = new MemoryLogger();
        $this->application = new Application();
        $this->application->setLogger($this->logger);
    }

    public function testInitMethod(): void
    {
        // Arrange
        $this->logger->clear();

        // Act
        $this->application->init();
        $logs = $this->logger->get();

        // Assert
        $this->assertCount(1, $logs);
        $this->assertEquals('info', $logs[0]['level']);
        $this->assertEquals('Application is initialized', $logs[0]['message']);
    }

    public function testStartMethod(): void
    {
        // Arrange
        $this->logger->clear();

        // Act
        $this->application->start();
        $logs = $this->logger->get();

        // Assert
        $this->assertCount(1, $logs);
        $this->assertEquals('info', $logs[0]['level']);
        $this->assertEquals('Application is running', $logs[0]['message']);
    }

}