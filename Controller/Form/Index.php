<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller\Form;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public $resultPageFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    protected $resultJsonFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $categoryId = $this->getRequest()->getParam('category_id');
        $code = $this->getRequest()->getParam('code');
        if ($code) {
            if (!isset($categoryId) || !$categoryId){
                $formFactor = $this->_objectManager
                    ->create('Incipio\FormFactor\Model\FormFactor\LoadByCode')
                    ->loadByCode($code);
                $this->coreRegistry->register('current_frontend_formfactor', $formFactor);
            } else {
                $parent = $this->_objectManager->create('Magento\Catalog\Model\Category')->load($categoryId);
                $childrenIds = $parent->getAllChildren(true);
                $categories = [];
                foreach ($childrenIds as $childrenId){
                    $child = $this->_objectManager->create('Magento\Catalog\Model\Category')->load($childrenId);
                    if ($child->getFormfactors() && strpos(json_encode($child->getFormfactors()), $code) > -1){
                        $categories[$child->getId()] = ['label' => $child->getName(), 
                                                        'value' => $child->getUrl()];
                    }
                }
                return $this->resultJsonFactory->create()->setData(['success' => true, 'categories' => json_encode($categories)]);
            }
        }
        return $this->resultPageFactory->create();
    }
}
