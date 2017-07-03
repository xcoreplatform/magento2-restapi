<?php

namespace Dealer4dealer\Xcore\Model;

use Exception;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

class PricelistManagement
{
    /** @var Context */
    private $_context;
    /** @var Registry */
    private $_registry;
    /** @var PriceListRepository */
    private $_repository;

    public function __construct(Context $context,
                                Registry $registry,
                                PriceListRepository $repository)
    {
        $this->_context    = $context;
        $this->_registry   = $registry;
        $this->_repository = $repository;
    }

    public function getPricelist()
    {
        // TODO: Figure out how to work with search criteria?
        $searchCriteria = new SearchCriteria;

        $items = $this->_repository->getList($searchCriteria)->getItems();

        $result = [];

        foreach ($items as $item) {
            $itemArray = [
                'id'          => $item->getId(),
                'list_id'     => $item->getListId(),
                'customer_id' => $item->getCustomerId(),
                'product_id'  => $item->getProductId(),
                'qty'         => $item->getQty(),
                'price'       => $item->getPrice(),
                'from_date'   => $item->getFromDate(),
                'to_date'     => $item->getToDate(),
            ];

            $result[] = $itemArray;
        }

        return $result;
    }

    public function postPricelist()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $removedItems = $this->removePriceList($data);
            $addedItems   = $this->addItemsToPriceList($data);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

        $result = [
            'deleted_existing' => $removedItems,
            'added_items'      => $addedItems,
        ];

        return json_encode($result);
    }

    private function removePriceList($data)
    {
        $removed = 0;
        if (isset($data['delete_existing']) && $data['delete_existing']) {
            try {
                $removed = $this->_repository->deleteByListId($data['list_id']);
            } catch (Exception $exception) {
                // Failed to remove, not removing anything (doesn't exist probably)
            }
        }
        return $removed;
    }

    private function addItemsToPriceList($data)
    {
        foreach ($data['items'] as $item) {
            $priceList = new PriceList($this->_context, $this->_registry);
            $priceList->setListId($data['list_id']);
            $priceList->setCustomerId($item['customer_id']);
            $priceList->setProductId($item['product_id']);
            $priceList->setQty($item['qty']);
            $priceList->setPrice($item['price']);
            $priceList->setFromDate(isset($item['from_date']) ? $item['from_date'] : null);
            $priceList->setToDate(isset($item['to_date']) ? $item['to_date'] : null);
            $this->_repository->save($priceList);
        }

        return count($data['items']);
    }
}