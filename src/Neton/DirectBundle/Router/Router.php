<?php
namespace Neton\DirectBundle\Router;

/**
 * Router is the ExtDirect Router class.
 *
 * It provide the ExtDirect Router mechanism.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Router
{
    protected $request = null;
    
    /**
     * Initialize the router object.
     * 
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
        $this->request = new Request($container->get('request'));
        $this->response = new Response($this->request->getCallType());
    }

    /**
     * Do the ExtDirect routing processing.
     */
    public function route()
    {
        $batch = array();
        
        foreach ($this->request->getCalls() as $call)
        {
            $batch[] = $this->dispatch($call);
        }

        return $this->response->encode($batch);
    }

    /**
     * Dispatch a remote method call.
     * 
     * @param  Neton\DirectBundle\Router\Call $call
     * @return <type> 
     */
    private function dispatch($call)
    {
        $controller = $this->resolveController($call->getAction());
        $method = $call->getMethod()."Action";

        if (!is_callable(array($controller, $method)))
        {
            //todo: throw an execption method not callable
        }

        if ($this->request->getCallType() == 'form')
        {
            $result = $call->getResponse($controller->$method($call->getData(), $this->request->getFiles()));
        }
        else
        {
            $result = $call->getResponse($controller->$method($call->getData()));
        }

        return $result;
    }

    /**
     * Resolve the called controller from action.
     * 
     * @param  string $action
     * @return <type>
     */
    private function resolveController($action)
    {
        list($bundleName, $controllerName) = explode('_',$action);
        $bundleName.= "Bundle";
        
        $bundle = $this->container->get('kernel')->getBundle($bundleName);
        $namespace = $bundle->getNamespace()."\\Controller";

        $class = $namespace."\\".$controllerName."Controller";

        try
        {
            $controller = new $class();

            if ($controller instanceof \Symfony\Component\DependencyInjection\ContainerAware)
            {
                $controller->setContainer($this->container);
            }

            return $controller;
        }catch(Exception $e)
        {
            // todo: handle exception
        }
    }
}
