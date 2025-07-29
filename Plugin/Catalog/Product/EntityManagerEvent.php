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
use Heartub\EntitySyncPulse\Model\Pattern\Builder\Request\ProductSyncRequestBuilder;
use Heartub\EntitySyncPulse\Enum\RabbitParams;
use Heartub\EntitySyncPulse\Service\Publisher\QueuePublisher;

class EntityManagerEvent
{

    /**
     * @param Logger $logger
     * @param ProductSyncRequestBuilder $productSyncRequestBuilder
     * @param QueuePublisher $queuePublisher
     */
    public function __construct(
        private readonly Logger $logger,
        private readonly ProductSyncRequestBuilder $productSyncRequestBuilder,
        private readonly QueuePublisher $queuePublisher,
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
                $newProduct = $entity->isObjectNew() ?? false;
                if (!empty($entityId) && $newProduct) {
                    $params = $entity->getData();
                    $request = $this->productSyncRequestBuilder->setParams($params)->setRequestId((int)$entityId)
                        ->build();
                    $this->queuePublisher->publish(RabbitParams::ECOMMERCE_PRODUCT_MODIFIED->value, $request);
                }
            } catch (LocalizedException $e) {
                $this->logger->log($e->getMessage(), Logger::ERROR, []);
            }
        }

        return $entity;
    }
}
