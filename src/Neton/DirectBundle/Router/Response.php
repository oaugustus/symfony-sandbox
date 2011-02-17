<?php
namespace Neton\DirectBundle\Router;

/**
 * Response encapsule the ExtDirect response to call.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Response
{
    protected $type;
    
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Encode the response into a valid json ExtDirect result.
     * 
     * @param  array $result
     * @return string
     */
    public function encode($result)
    {
        if ($this->type == 'form')
        {
            return "<html><body><textarea>".json_encode($result[0])."</textarea></body></html>";
        }
        else
        {
            return json_encode($result);
        }
    }
}
