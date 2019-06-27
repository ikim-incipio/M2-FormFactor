<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Block\Adminhtml\FormFactors\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        array $data=[]
    ) {
        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('incipio_formfactor_formfactors_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Form Factor Sections'));
    }
}
