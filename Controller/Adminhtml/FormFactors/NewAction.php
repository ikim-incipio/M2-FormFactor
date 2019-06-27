<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller\Adminhtml\FormFactors;

class NewAction extends \Incipio\FormFactor\Controller\Adminhtml\FormFactors
{
    public function execute()
    {
        $this->_forward('edit');
    }
}
