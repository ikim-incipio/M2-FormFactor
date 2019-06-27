<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Model\Category\Attribute\Backend;

class Formfactors extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Construct
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Validate process
     *
     * @param \Magento\Framework\DataObject $object
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */


    /**
     * Before Attribute Save Process
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function beforeSave($object)
    {
        $attributeCode = $this->getAttribute()->getName();
        if ($attributeCode == 'formfactors') {
            $data = $object->getData($attributeCode);
            if (!is_array($data)) {
                $data = [];
            }
            $object->setData($attributeCode, implode(',', $data) ?: null);
        }
        if (!$object->hasData($attributeCode)) {
            $object->setData($attributeCode, null);
        }
        return $this;
    }

    /**
     * After Load Attribute Process
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function afterLoad($object)
    {
        $attributeCode = $this->getAttribute()->getName();
        if ($attributeCode == 'formfactors') {
            $data = $object->getData($attributeCode);
            if ($data) {
                if (!is_array($data)) {
                    $object->setData($attributeCode, explode(',', $data));
                } else {
                    $object->setData($attributeCode, $data);
                }

            }
        }
        return $this;
    }
}