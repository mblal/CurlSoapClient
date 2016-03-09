<?php
namespace MT\SoapClientCurl;

/**
 * SoapClientCurl retrieve a wsdl file who is behind a Basic HTTP AUTHENTICATION. & it encapsulate the \soapClient
 *
 * @author Mohamed BLAL
 *
 */
abstract class SoapClientCurl
{
    /**
     *
     * @var \SoapClient
     */
    protected $client;

    /**
     * The Option class that exists in Option.php
     * @var Option
     */
    protected $option;

    /**
     *
     * @var string
     */
    protected $wsdl;

    /**
     * the native php SoapHeader class that you instantiate hardly or via a dependency injector
     * @var \SoapHeader
     */
    protected $soapHeader;

    /**
     * fetch wsdl who is behind Basic authentication @TODO test if_file_exists
     *
     * @param string $wsdl
     * @param Option $option
     * @param \SoapHeader $soapHeader
     */
    public function __construct($wsdl, $option, $soapHeader)
    {
        $this->wsdl = $wsdl;
        $this->option = $option;
        $this->soapHeader = $soapHeader;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->wsdl);
        curl_setopt($ch, CURLOPT_HEADER, 'Content-type:application/xml');
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, $this->option->user . ':' . $this->option->password);

        $response = curl_exec($ch);
        curl_close($ch);

        file_put_contents($this->option->localWsdl, $response);
    }

    /**
     *
     * @param string $method
     * @param RequestInterface $request
     * @param Array $options
     */
    public function soapCall($method, $request, $options = null)
    {
        $options = $options === null ? array() : $options;
        $options += array(
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'login' => $this->option->user,
            'password' => $this->option->password
        );
        $this->client = new \SoapClient($this->option->localWsdl, $options);
        $this->client->__setSoapHeaders($this->soapHeader);
        return $this->client->__soapCall($method, array(
            $request
        ));
    }
}