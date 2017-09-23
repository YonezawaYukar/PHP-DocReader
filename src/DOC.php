<?php
/**
 * Created by PhpStorm.
 * User: yukar
 * Date: 2017/9/23
 * Time: 下午11:20
 */

namespace DocReader;
require_once 'Read.php';
require_once 'Convert.php';

/**
 * Class DOC
 * @package DocReader
 */
class DOC
{
    /**
     * @param $class
     * @return Read
     */
    public static function class($class){
        return (new Read('class',$class));
    }

    public static function func($func){
        return (new Read('func',$func));
    }
}
