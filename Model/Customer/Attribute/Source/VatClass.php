<?php

namespace Dealer4dealer\Xcore\Model\Customer\Attribute\Source;

class VatClass extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
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
                    'value' => 'excluding',
                    'label' => 'Without Tax'
                ],
                [
                    'value' => 'including',
                    'label' => 'With Tax'
                ]
            ];
        }
        return $this->_options;
    }
}