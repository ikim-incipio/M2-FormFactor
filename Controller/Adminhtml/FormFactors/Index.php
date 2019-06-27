<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller\Adminhtml\FormFactors;

class Index extends \Incipio\FormFactor\Controller\Adminhtml\FormFactors
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Incipio_FormFactor::formfactors');
        $resultPage->getConfig()->getTitle()->prepend(__('Incipio Form Factors'));
        $resultPage->addBreadcrumb(__('Incipio'), __('Incipio'));
        $resultPage->addBreadcrumb(__('Form Factors'), __('Form Factors'));
        return $resultPage;
    }
}
