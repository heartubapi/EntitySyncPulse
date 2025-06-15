<?php

declare(strict_types=1);

/**
 * @author Roberto Ballesteros <heartub.api@gmail.com>
 * @package Heartub\EntitySyncPulse - Publishes entity change events to RabbitMQ in Magento Commerce Cloud
 */

namespace Heartub\EntitySyncPulse\Plugin\Catalog\Product;

use Magento\Inventory\Model\ResourceModel\SourceItem\SaveMultiple;
use Magento\InventoryApi\Api\Data\SourceItemInterface;
use Magento\InventoryIndexer\Indexer\SourceItem\GetSourceItemIds;
use Heartub\EntitySyncPulse\Helper\SyncPulseLogger as Logger;

class SaveMultipleEvent
{

    /**
     * @param GetSourceItemIds $getSourceItemIds
     * @param Logger $logger
     */
    public function __construct(
        private readonly GetSourceItemIds $getSourceItemIds,
        private readonly Logger $logger
    ) {
    }

    /**
     * Method afterExecute
     *
     * @param SaveMultiple $subject
     * @param void $result
     * @param SourceItemInterface[] $sourceItems
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterExecute(
        SaveMultiple $subject,
        $result,
        array $sourceItems
    ): void {
        $total = count($sourceItems);
        if ($total) {
            //TODO: publish a message to the exchange on internal rabbitmq
            $test = '';
        }
    }
}
