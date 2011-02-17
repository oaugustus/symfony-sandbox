<?php
namespace Neton\DirectBundle\Router;

/**
 * Request encapsule the ExtDirect request call.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Request
{
    protected $request;
    protected $rawPost;
    protected $post;
    protected $callType;
    protected $calls = null;
    protected $files;

    /**
     * Initialize the object.
     * 
     * @param Symfony\Component\HttpFoundation\Request $request
     */
    public function __construct($request)
    {        
        // store the symfony request object
        $this->request = $request;
        $this->rawPost = isset($GLOBALS['HTTP_RAW_POST_DATA']) ?  $GLOBALS['HTTP_RAW_POST_DATA'] : array();
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->callType = !empty ($_POST) ? 'form' : 'batch';
    }

    /**
     * Return the type of Direct call.
     *
     * 'form' if is a formHandler call and 'batch' if is a batch call.
     *
     * @return string Type of Direct call.
     */
    public function getCallType()
    {
        return $this->callType;
    }

    /**
     * Return the files from call.
     * 
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }
    
    /**
     * Get the direct calls object.
     *
     * @return array
     */
    public function getCalls()
    {
        if (null == $this->calls)
        {
            $this->calls = $this->extractCalls();
        }

        return $this->calls;
    }

    /**
     * Extract the ExtDirect calls from request.
     *
     * @return array
     */
    public function extractCalls()
    {
        $calls = array();

        if ('form' == $this->callType)
        {
            $calls[] = new Call($this->post, 'form');
        }
        else
        {
            $decoded = json_decode($this->rawPost);
            $decoded = !is_array($decoded) ? array($decoded) : $decoded;

            foreach ($decoded as $call)
            {
                $calls[] = new Call((array)$call, 'single');
            }
        }
        
        return $calls;
    }
}
