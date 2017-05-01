<?php

namespace Dealer4dealer\Xcore\Block\Adminhtml\CustomAttribute;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Constructor
     *
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }
    /**
     * Initialize Custom Attribute edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Dealer4dealer_Xcore';
        $this->_controller = 'adminhtml_custom_attribute';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Custom Attribute'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Custom Attribute'));
    }
    /**
     * Retrieve text for header element depending on loaded Custom Attribute
     *
     * @return string
     */
    public function getHeaderText()
    {
        /** @var \Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute */
        $customAttribute = $this->_coreRegistry->registry('dealer4dealer_xcore_custom_attribute');
        if ($customAttribute->getId()) {
            return __("Edit Custom Attribute '%1'", $this->escapeHtml($customAttribute->getFrom()));
        }
        return __('New Custom Attribute');
    }
}