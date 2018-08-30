<?php 

namespace NFePHP\GnreRJ\Exception;

/**
 * NFePHP\GnreRJ\Exception
 * @category  NFePHP
 * @package   NFePHP\GnreRJ\Common\Tools
 * @copyright NFePHP Copyright (c) 2008-2018
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Marlon O. Barbosa <marlon.academi at gmail dot com>
 * @link      https://github.com/Focus599Dev/sped-gnre-rj for the canonical source repository
 */

class DocumentsException extends \InvalidArgumentException implements ExceptionInterface
{
    public static $list = [
        0 => "O TXT possui mais parametros que o esperado",
    ];
    
    public static function wrongDocument($code, $msg = '')
    {
        $msg = self::replaceMsg(self::$list[$code], $msg);
        return new static($msg);
    }
    
    private static function replaceMsg($input, $msg)
    {
        return str_replace('{{msg}}', $msg, $input);
    }
}

?>