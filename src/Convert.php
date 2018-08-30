<?php 

namespace NFePHP\GnreRJ;

/**
 * Class responsible for Convert TXT to XML
 * NFePHP\GnreRJ\Convert
 * @category  NFePHP
 * @package   NFePHP\GnreRJ\Common\Tools
 * @copyright NFePHP Copyright (c) 2008-2018
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Marlon O. Barbosa <marlon.academi at gmail dot com>
 * @link      https://github.com/Focus599Dev/sped-gnre-rj for the canonical source repository
 */

use NFePHP\Common\Strings;
use NFePHP\GnreRJ\Factories\Parser;

class Convert{

    public $txt;
    public $xmls;

    /**
     * Constructor method
     * @param string $txt
    */
    public function __construct($txt = ''){
        if (!empty($txt)) {
            $this->txt = trim($txt);
        }
    }

    /**
     * Static method to convert Txt to Xml
     * @param string $txt
     * @return array
    */
    public static function parse($txt){
        $conv = new static($txt);
        return $conv->toXml();
    }

    /**
     * Convert txt to xml
     * @param string $txt
     * @return array
     * @throws \NFePHP\GnreRJ\Exception\DocumentsException
     */
    public function toXml($txt = ''){
        
        if (!empty($txt)) {
            $this->txt = trim($txt);
        }
        
        $txt = Strings::removeSomeAlienCharsfromTxt($this->txt);
        
        $parser = new Parser();

        $this->xmls = $parser->toXml($txt);
        
        return $this->xmls;
    }
}

?>