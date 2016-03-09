<?php
namespace MT\CurlSoapClient;

/**
 *
 * @author Mohamed BLAL
 *        
 */
class Option
{

    /**
     *
     * @var string
     */
    public $user;

    /**
     *
     * @var string
     */
    public $password;

    /**
     * the path where the fetched wsdl will be saved
     * @var string
     */
    public $localWsdl;

    /**
     *
     * @param string $user            
     * @param string $password            
     * @param string $localWsdl            
     */
    public function __construct($user, $password, $localWsdl)
    {
        $this->user = $user;
        $this->password = $password;
        $this->localWsdl = $localWsdl;
    }
}