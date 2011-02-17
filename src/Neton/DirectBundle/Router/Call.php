<?php
namespace Neton\DirectBundle\Router;

/**
 * Call encapsule an single ExtDirect call.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Call
{
    protected $action;
    protected $method;
    protected $type;
    protected $tid;
    protected $data;
    protected $callType;

    /**
     * Initialize an ExtDirect call.
     * 
     * @param array  $call
     * @param string $type
     */
    public function __construct($call, $type)
    {
        $this->callType = $type;
        
        if ('single' == $type)
        {
            $this->initializeFromSingle($call);
        }
        else
        {
            $this->initializeFromForm($call);
        }
    }

    /**
     * Get the requested action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get the requested method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get the request method params.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * Return a result wrapper to ExtDirect method call.
     * 
     * @param  array $result
     * @return array
     */
    public function getResponse($result)
    {
        return array(
          'type' => 'rpc',
          'tid' => $this->tid,
          'action' => $this->action,
          'method' => $this->method,
          'result' => $result
        );
    }
    
    /**
     * Initialize the call properties from a single call.
     * 
     * @param array $call
     */
    private function initializeFromSingle($call)
    {
        $this->action = $call['action'];
        $this->method = $call['method'];
        $this->type   = $call['type'];
        $this->tid    = $call['tid'];
        $this->data   = (array)$call['data'][0];
    }

    /**
     * Initialize the call properties from a form call.
     * 
     * @param array $call
     */
    private function initializeFromForm($call)
    {

        $this->action   = $call['extAction']; unset($call['extAction']);
        $this->method   = $call['extMethod']; unset($call['extMethod']);
        $this->type     = $call['extType']; unset($call['extType']);
        $this->tid      = $call['extTID']; unset($call['extTID']);
        $this->upload = $call['extUpload']; unset($call['extUpload']);

        foreach ($call as $key => $value)
        {
            $this->data[$key] = $value;
        }

    }
}
