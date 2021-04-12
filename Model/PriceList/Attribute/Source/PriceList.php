<?php

namespace Dealer4dealer\Xcore\Model\PriceList\Attribute\Source;

class PriceList extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_priceListRepository;
    protected $_searchCriteriaBuilder;

    /**
     * Constructor
     *
     * @param \Dealer4dealer\Xcore\Model\PriceListRepository   $priceListRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(\Dealer4dealer\Xcore\Model\PriceListRepository $priceListRepository,
                                \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->_priceListRepository   = $priceListRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * getAllOptions
     *
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $searchCriteria = $this->_searchCriteriaBuilder->create();

            $collection = $this->_priceListRepository->getList($searchCriteria);

            $this->_options = [
                [
                    'value' => null,
                    'label' => 'No Price List'
                ]
            ];

            foreach ($collection->getItems() as $priceList) {
                $this->_options[] = [
                    'value' => $priceList->getId(),
                    'label' => $priceList->getCode() . ' (#' . $priceList->getId() . ')',
                ];
            }
        }
        return $this->_options;
    }
}