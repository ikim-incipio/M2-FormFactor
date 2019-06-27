<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller\Adminhtml\FormFactors;

class Edit extends \Incipio\FormFactor\Controller\Adminhtml\FormFactors
{
	/**
     * Edit View.
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Incipio\FormFactor\Model\FormFactors');

        if ($id) {
            $model->load($id);
            if (!$model->getFormfactorId()) {
                $this->messageManager->addErrorMessage(__('This form factor no longer exists.'));
                $this->_redirect('incipio_formfactor/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_session->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->coreRegistry->register('current_formfactor', $model);
        $this->_initAction();

        // set title and breadcrumbs
        $title = $id ? __('Edit Form Factor') : __('New Form Factor');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Content'), __('Content'))
            ->addBreadcrumb(__('Manage Form Factor'), __('Manage Form Factor'));
        if (!empty($title)) {
            $resultPage->addBreadcrumb($title, $title);
        }
        $resultPage->getConfig()->getTitle()->prepend(__('Form Factors'));
        $resultPage->getConfig()->getTitle()->prepend($id ? $model->getName() : __('New Form Factor'));

        $this->_view->renderLayout();
    }
}
