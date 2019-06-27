<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Model;

class FormFactors extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Incipio\FormFactor\Model\ResourceModel\FormFactors');
    }
}
