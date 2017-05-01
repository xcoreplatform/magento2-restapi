<?php

namespace Dealer4dealer\Xcore\Block\Adminhtml\CustomAttribute\Edit\Tab;

class CustomAttribute extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{

    /**
     * constructor
     *
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Dealer4dealer\Xcore\Model\CustomAttribute $customAttribute */
        $customAttribute = $this->_coreRegistry->registry('dealer4dealer_xcore_custom_attribute');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('custom_attribute_');
        $form->setFieldNameSuffix('custom_attribute');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Custom Attribute Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        if ($customAttribute->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'from',
            'text',
            [
                'name'  => 'from',
                'label' => __('From'),
                'title' => __('From'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'to',
            'text',
            [
                'name'  => 'to',
                'label' => __('To'),
                'title' => __('To'),
            ]
        );

        $customAttributeData = $this->_session->getData('dealer4dealer_xcore_custom_attribute_data', true);
        if ($customAttributeData) {
            $customAttribute->addData($customAttributeData);
        } else {
            if (!$customAttribute->getId()) {
                $customAttribute->addData($customAttribute->getDefaultValues());
            }
        }
        $form->addValues($customAttribute->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Custom Attribute');
    }
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }
    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }
    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}