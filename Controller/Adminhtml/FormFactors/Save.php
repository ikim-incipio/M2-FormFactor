<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller\Adminhtml\FormFactors;

class Save extends \Incipio\FormFactor\Controller\Adminhtml\FormFactors
{
    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Incipio\FormFactor\Model\FormFactors');

            $id = $this->getRequest()->getParam('formfactor_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Item was successfully saved'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('incipio_formfactor/*/edit', ['id' => $model->getFormfactorId(), '_current' => true]);
                }
                return $resultRedirect->setPath('incipio_formfactor/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the item'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('incipio_formfactor/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('incipio_formfactor/*/');
    }
}
