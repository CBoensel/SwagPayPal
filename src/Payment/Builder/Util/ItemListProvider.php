<?php declare(strict_types=1);

namespace Swag\PayPal\Payment\Builder\Util;

use Shopware\Core\Checkout\Cart\Price\Struct\CalculatedPrice;
use Shopware\Core\Checkout\Order\Aggregate\OrderLineItem\OrderLineItemEntity;
use Shopware\Core\Checkout\Order\OrderEntity;
use Shopware\Core\Checkout\Payment\Exception\InvalidOrderException;
use Swag\PayPal\PayPal\Api\Payment\Transaction\ItemList\Item;

class ItemListProvider
{
    /**
     * @var PriceFormatter
     */
    private $priceFormatter;

    public function __construct()
    {
        $this->priceFormatter = new PriceFormatter();
    }

    /**
     * @throws InvalidOrderException
     *
     * @return Item[]
     */
    public function getItemList(
        OrderEntity $order,
        string $currency
    ): array {
        $items = [];
        if ($order->getLineItems() === null) {
            throw new InvalidOrderException($order->getId());
        }

        /** @var OrderLineItemEntity[] $lineItems */
        $lineItems = $order->getLineItems()->getElements();

        foreach ($lineItems as $id => $lineItem) {
            $price = $lineItem->getPrice();

            if ($price === null) {
                return [];
            }

            $items[] = $this->createItemFromLineItem($lineItem, $currency, $price);
        }

        return $items;
    }

    private function createItemFromLineItem(
        OrderLineItemEntity $lineItem,
        string $currency,
        CalculatedPrice $price
    ): Item {
        $item = new Item();
        $item->setName($lineItem->getLabel());
        $item->setSku($lineItem->getPayload()['productNumber']);
        $item->setCurrency($currency);
        $item->setQuantity($lineItem->getQuantity());
        $item->setTax($this->priceFormatter->formatPrice(0));
        $item->setPrice($this->priceFormatter->formatPrice($price->getTotalPrice() / $lineItem->getQuantity()));

        return $item;
    }
}
