<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Model\FormFactor;

class LoadByCode
{
    protected $_objectManager;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->_objectManager = $objectManager;
    }

    public function loadByCode($code)
    {
    	$collection = $this->_objectManager->create('Incipio\FormFactor\Model\FormFactors')
            ->getCollection()
            ->addFieldToFilter("code", $code);
        if ($collection->getSize() >= 1) {
            return $collection->getFirstItem();
        } else {
            return $this->_objectManager->create('Incipio\FormFactor\Model\FormFactors');
        }
    }
}
