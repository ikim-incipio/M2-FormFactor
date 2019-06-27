<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Url;

/**
 * Class Router
 */
class Router implements RouterInterface
{
    /**
     * @var
     */
    protected $_request;

    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    public $actionFactory;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     */
    public function __construct(
        ActionFactory $actionFactory
    ) {
        $this->actionFactory = $actionFactory;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface|null
     */
    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        $routePath = explode('/', urldecode($identifier));

        if ($routePath[0] != 'formfactor'){
            return;
        }

        if (isset($routePath[2]) && isset($routePath[3]) && 
            $routePath[2] == 'categories' && 
            $routePath[3] == 'ajax')
        {
            $request->setRouteName('formfactor')
                ->setControllerName('form')
                ->setActionName('index')
                ->setParam('code', $routePath[1])
                ->setParam('category_id', $routePath[4]);
        } else {
            $request->setRouteName('formfactor')
                ->setControllerName('form')
                ->setActionName('index')
                ->setParam('code', $routePath[1]);
        }
        return $this->actionFactory->create('Magento\Framework\App\Action\Forward', ['request' => $request]);
    }
}
