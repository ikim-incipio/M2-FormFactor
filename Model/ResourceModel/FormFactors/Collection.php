<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Model\ResourceModel\FormFactors;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Incipio\FormFactor\Model\FormFactors', 'Incipio\FormFactor\Model\ResourceModel\FormFactors');
    }

    /**
     * @return $this
     */
    public function addActiveFilter()
    {
        $this->addFieldToFilter('status', 1);

        return $this;
    }
}
