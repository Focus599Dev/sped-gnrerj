<?php 

namespace NFePHP\GnreRJ;

/**
 * Class responsible for Parse
 * NFePHP\GnreRJ\Convert
 * @category  NFePHP
 * @package   NFePHP\GnreRJ\Factories\Parse
 * @copyright NFePHP Copyright (c) 2008-2018
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Marlon O. Barbosa <marlon.academi at gmail dot com>
 * @link      https://github.com/Focus599Dev/sped-gnre-rj for the canonical source repository
*/

use stdClass;
use NFePHP\GnreRJ\Exception\DocumentException;
use NFePHP\GnreRJ\Make;

class Parser{

    /**
     * @var array
    */
    protected $structure;

    /**
     * @var object
    */
    protected $std;

    /**
     * @var Make
    */
    protected $make;

    protected $std;

    public function __construct(){
        
        $path = realpath(__DIR__."/../../storage/txtstructure.json");
        
        $this->structure = json_decode(file_get_contents($path), true);

        $this->make = new Make();

    }

    /**
     * Convert txt to XML
     * @param array $nota
     * @return string|null
     */
    public function toXml($txt)
    {
        $this->array2xml($txt);

        if ($this->make->monta($this->std)) {
            return $this->make->getXML();
        }

        return null;
    }

    /**
     * Converte txt array to xml
     * @param array $nota
     * @return void
     */
    protected function array2xml($txt){
            
        $fields = explode('|', $lin);
        
        if (count($fields) > count($this->structure)){
            throw DocumentException::wrongDocument(0, '');
        }

        foreach ($this->structure as $key => $value) {

            if (isset($fields[$key])){
                $this->std->{$this->structure[$key]} = $fields[$key];
            } else {
                $this->std->{$this->structure[$key]} = '';
            }

        }

    }
}

?>