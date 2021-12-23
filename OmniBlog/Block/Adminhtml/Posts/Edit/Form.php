<?php
namespace Omnipro\OmniBlog\Block\Adminhtml\Posts\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var
     */
    protected $_systemStore;

    /**
     * @var \Omnipro\OmniBlog\Model\Source\Approved
     */
    protected $_approved;

    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Omnipro\OmniBlog\Model\Source\Approved $approved
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Omnipro\OmniBlog\Model\Source\Approved $approved,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_approved = $approved;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Form
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(['data' => ['id' => 'edit_form', 'enctype' => 'multipart/form-data', 'action' => $this->getData('action'), 'method' => 'post']]);
        $form->setHtmlIdPrefix('omniblog_');
        if ($model) {
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Review Details'), 'class' => 'fieldset-wide']);
            $fieldset->addField('post_id', 'hidden', ['name' => 'post_id']);
        } else {
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Review Details'), 'class' => 'fieldset-wide']);
        }
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Customer Email'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );

        $form->setValues($model ? $model->getData() : '');
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}