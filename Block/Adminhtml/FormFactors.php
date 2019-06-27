<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Block\Adminhtml;

class FormFactors extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'formfactors';
        $this->_headerText = __('Form Factors');
        $this->_addButtonLabel = __('Add New Form Factor');
        parent::_construct();
    }
}
