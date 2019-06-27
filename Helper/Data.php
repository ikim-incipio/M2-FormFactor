<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $categoriesArray = null;
    protected $_scopeConfig;
    protected $_stores;
    protected $_category;
    protected $_objectManager;
    protected $_adminCategoryTree;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Category $category,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Catalog\Block\Adminhtml\Category\Tree $adminCategoryTree
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
        $this->_category = $category;
        $this->_objectManager = $objectManager;
        $this->_adminCategoryTree = $adminCategoryTree;
    }

    private function getStores()
    {
        if (!$this->_stores) {
            $this->_stores = $this->_storeManager->getStore()->getResourceCollection()->load();
        }
        return $this->_stores;
    }

    public function getTree()
    {
    	return $this->_adminCategoryTree->getTree();
    }

    public function getCategoriesMultiArray()
    {
    	if ($this->categoriesArray === null) {
	    	$collection = $this->_category->getCollection()->addAttributeToSelect('*');
	    	$options = [];
	        foreach ($collection as $category) {
	            $options[] = ['label' => $category->getName(), 'value' => $category->getId()];
	        }
	        $this->categoriesArray = $options;
	    }
        return $this->categoriesArray;
    }

    public function getCategoriesOptionArray()
    {
        if ($this->categoriesArray === null) {
            $catArray = array();
            $categories = $this->_category->getCollection()->addAttributeToSelect('*');
            foreach ($categories as $category) {
                if ($category->getId() == 1 || $category->getParentId() == 1) {
                    continue;
                }
                $catArray[$category->getId()] = $this->getCategoryPath($category->getId());
            }
            asort($catArray);
            $this->categoriesArray = $catArray;
        }

        return $this->categoriesArray;
    }

    public function getCategoryPath($id)
    {
        $category = $this->_category->load($id);
        $path = $category->getName();
        $parent = $this->_category->load($category->getParentId());
        while ($parent->getId() > 1) {
            $path = $parent->getName().' >> '.$path;
            $parent = $this->_category->load($parent->getParentId());
        }

        return $path;
    }
}
