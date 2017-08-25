<?php

namespace Dealer4dealer\Xcore\Model\Customer\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class VatClass extends AbstractSource
{

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                [
                    'value' => null,
                    'label' => 'No Tax'
                ],
                [
                    'value' => 'excluding',
                    'label' => 'Excluding Tax'
                ],
                [
                    'value' => 'including',
                    'label' => 'Including Tax'
                ]
            ];
        }
        return $this->_options;
    }
}