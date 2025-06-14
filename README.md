# EntitySyncPulse for Magento Commerce Cloud

## Overview
EntitySyncPulse is a Magento Commerce Cloud module that publishes entity change events (e.g., product creation or modification) to RabbitMQ, enabling seamless integration with external systems. The module supports configurable attributes via JSON from the admin panel and is designed to be extensible for other entities like categories, orders, or customers.

## Status
This project is currently **in development**. Features and documentation will be expanded as development progresses. Contributions and feedback are welcome!

## Installation
1. Clone the repository: `git clone https://github.com/heartubapi/module-entity-sync-pulse.git`
2. Place the module in `app/code/Heartub/EntitySyncPulse`
3. Run: `bin/magento setup:upgrade`
4. Configure RabbitMQ and JSON attributes in the Magento admin panel (coming soon).

## License
MIT License. See LICENSE file for details.

## Author
- Roberto Ballesteros (heartub.api@gmail.com)
