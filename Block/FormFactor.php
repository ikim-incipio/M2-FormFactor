<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Block;

class FormFactor extends \Magento\Framework\View\Element\Template
{
	/**
     * @var \Incipio\Design\Helper\Config
     */
    private $helper;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Incipio\Design\Helper\Config $helper,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
        $this->coreRegistry = $coreRegistry;
        $this->setTemplate('Incipio_FormFactor::form_factor.phtml');
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        if ($this->getCurrentForm()){   
            $title = $this->getCurrentForm()->getHeroTitle();
            $this->pageConfig->getTitle()->set(__($title));
        }

        return parent::_prepareLayout();
    }

    public function getCurrentForm()
    {
        return $this->coreRegistry->registry('current_frontend_formfactor');
    }

    public function getParentDevices()
    {
        return array(23=>'Apple',113=>'Samsung',133=>'Google',152=>'LG');
    }
}
