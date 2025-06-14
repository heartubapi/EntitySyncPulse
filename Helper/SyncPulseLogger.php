<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <rballesteros.widook@distelsa.com.gt>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ObjectManager;
use Psr\Log\LoggerInterface as Logger;
use Monolog\Logger as CoreLogger;

class SyncPulseLogger extends AbstractHelper
{
    public const INFO = CoreLogger::INFO;
    public const ERROR = CoreLogger::ERROR;
    public const CRITICAL = CoreLogger::CRITICAL;

    /**
     * @param Context $context
     * @param Logger $logger
     */
    public function __construct(
        protected Context $context,
        private Logger $logger
    ) {
        $this->logger = $logger ?: ObjectManager::getInstance()
            ->get(Logger::class);
        parent::__construct($context);
    }

    /**
     * Method for logging events
     *
     * @param string $message
     * @param int $type
     * @param array $data
     */
    public function log(string $message, int $type = CoreLogger::INFO, array $data = []): void
    {
        match ($type) {
            CoreLogger::ERROR => $this->logger->error($message, $data),
            CoreLogger::CRITICAL => $this->logger->critical($message, $data),
            default => $this->logger->info($message, $data)
        };
    }
}
