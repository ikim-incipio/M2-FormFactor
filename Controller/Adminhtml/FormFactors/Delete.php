<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller\Adminhtml\FormFactors;

class Delete extends \Incipio\FormFactor\Controller\Adminhtml\FormFactors
{
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_objectManager->create('Incipio\FormFactor\Model\FormFactors');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the form factor.'));
                $this->_redirect('incipio_formfactor/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('We can\'t delete item right now. Please review the log and try again.')
                );
                $this->logger->critical($e);
                $this->_redirect('incipio_formfactor/*/edit', ['id' =>  $id]);
                return;
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a form factor to delete.'));
        $this->_redirect('incipio_formfactor/*/');
    }
}
