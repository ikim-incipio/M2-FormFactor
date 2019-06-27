<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller\Adminhtml;

/**
 * Items controller
 */
abstract class FormFactors extends \Magento\Backend\App\Action
{
	/**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * File system
     *
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * File Uploader factory
     *
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $fileUploaderFactory;

    /**
     * File check
     *
     * @var \Magento\Framework\Filesystem\Io\File
     */
    protected $ioFile;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Filesystem\Io\File $ioFile,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->filesystem = $filesystem;
        $this->ioFile = $ioFile;
        $this->fileUploaderFactory = $fileUploaderFactory;
        $this->logger = $logger;
    }

    /**
     * Initiate action
     *
     * @return this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Incipio_FormFactor::formfactors')->_addBreadcrumb(__('Form Factors'), __('Form'));
        return $this;
    }
}
