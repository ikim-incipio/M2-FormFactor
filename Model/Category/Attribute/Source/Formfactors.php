<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Model\Category\Attribute\Source;

class Formfactors extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Catalog config
     *
     * @var \Magento\Catalog\Model\Config
     */
    protected $_catalogConfig;

    protected $_objectManager;

    /**
     * Construct
     *
     * @param \Magento\Catalog\Model\Config $catalogConfig
     */
    public function __construct(
        \Magento\Catalog\Model\Config $catalogConfig,
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->_catalogConfig = $catalogConfig;
        $this->_objectManager = $objectManager;
    }

    /**
     * Retrieve Catalog Config Singleton
     *
     * @return \Magento\Catalog\Model\Config
     */
    protected function _getCatalogConfig()
    {
        return $this->_catalogConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $collection = $this->_objectManager->create('Incipio\FormFactor\Model\FormFactors')->getCollection();
            if ($collection->getSize() >= 1) {
                $optionData = [];
                foreach ($collection as $formfactor){
                    $optionData[] = ['label' => $formfactor->getName(), 
                                     'value' => $formfactor->getCode()];
                }
                $this->_options = $optionData;
            }
        }
        return $this->_options;
    }
}