<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Plugin\Catalog\Product;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\DataObject;
use Heartub\EntitySyncPulse\Helper\SyncPulseLogger as Logger;

class EntityManagerEvent
{

    /**
     * @param Logger $logger
     */
    public function __construct(
        private readonly Logger $logger
    ) {
    }

    /**
     * Plugin after save entity product
     *
     * @param EntityManager $subject
     * @param DataObject $entity
     * @return object
     */
    public function afterSave(EntityManager $subject, DataObject $entity): object
    {
        if ($entity instanceof ProductInterface) {
            try {
                $entityId = (string)$entity->getData('entity_id') ?? '';
                if (!empty($entityId)) {
                    //TODO: publish a message to the exchange on internal rabbitmq
                    $test = '';
                }
            } catch (LocalizedException $e) {
                $this->logger->log($e->getMessage(), Logger::ERROR, []);
            }
        }

        return $entity;
    }
}
