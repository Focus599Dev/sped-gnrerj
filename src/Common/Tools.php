<?php 

namespace NFePHP\GnreRJ\Common;

/**
 * Class base responsible for communication with SEFAZ-RJ
 *
 * @category  NFePHP
 * @package   NFePHP\GnreRJ\Common\Tools
 * @copyright NFePHP Copyright (c) 2008-2018
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Marlon O. Barbosa <marlon.academi at gmail dot com>
 * @link      https://github.com/Focus599Dev/sped-gnre-rj for the canonical source repository
 */


use RuntimeException;
use NFePHP\Common\Soap\SoapCurl;
use NFePHP\Common\Soap\SoapInterface;
use NFePHP\Common\Strings;
use NFePHP\Common\TimeZoneByUF;

class Tools {

    /**
     * config class
     * @var \stdClass
     */
    public $config;

    /**
     * soap class
     * @var SoapInterface
    */
    public $soap;

    /**
     * last soap request
     * @var string
    */
    public $lastRequest = '';
    
    /**
     * last soap response
     * @var string
    */
    public $lastResponse = '';

    /**
     * certificate class
     * @var Certificate
    */
    protected $certificate;

    /**
     * urlService
     * @var string
    */
    protected $urlService = 'http://www1.fazenda.rj.gov.br/projetoGCTBradesco/br/gov/rj/sef/gct/webservice/GerarDocumentoArrecadacaoWS.jws';

    protected $soapnamespaces = [
        'xmlns:xsi' => "http://www.w3.org/2001/XMLSchema-instance",
        'xmlns:xsd' => "http://www.w3.org/2001/XMLSchema",
        'xmlns:soap' => "http://www.w3.org/2003/05/soap-envelope"
    ];

    public function __construct($configJson, Certificate $certificate){

        $this->config = $configJson;
        
        $this->certificate = $certificate;

        $this->soap = new SoapCurl($certificate);

        if ($this->config->proxy){
            $this->soap->proxy($this->config->proxy, $this->config->proxyPort, $this->config->proxyUser, $this->config->proxyPass);
        }

    }

    /**
     * Load Soap Class
     * Soap Class may be \NFePHP\Common\Soap\SoapNative
     * or \NFePHP\Common\Soap\SoapCurl
     * @param SoapInterface $soap
     * @return void
     */
    public function loadSoapClass(SoapInterface $soap){
        $this->soap = $soap;
        $this->soap->loadCertificate($this->certificate);
    }

    /**
     * Send request message to webservice
     * @param array $parameters
     * @param string $request
     * @return string
     */
    protected function sendRequest($request, array $parameters = []){
        $this->checkSoap();

        return (string) $this->soap->send(
            $this->urlService,
            $this->urlMethod,
            $this->urlAction,
            SOAP_1_2,
            $parameters,
            $this->soapnamespaces,
            $request,
            $this->objHeader
        );
    }

    /**
     * Verify if SOAP class is loaded, if not, force load SoapCurl
    */
    protected function checkSoap(){
        if (empty($this->soap)) {
            $this->soap = new SoapCurl($this->certificate);
        }
    }
}

?>