<?php
/**
 * Created by PhpStorm.
 * User: yukar
 * Date: 2017/9/24
 * Time: 上午12:23
 */
require_once './src/DOC.php';

/**
 * Class Testclass
 */
class Testclass{
    /**
     * @var
     */
    private $test;

    /**
     * @return string
     */
    public function TestMethod(){
        return 'test';
    }
}

/**
 * @param $a
 * @param $b
 * @param $c
 */
function TestFunction($a,$b,$c){

}

DocReader\DOC::class('Testclass')->doc()->print;

DocReader\DOC::class('Testclass')->method('TestMethod')->doc()->print;

DocReader\DOC::class('Testclass')->property('test')->doc()->print;

DocReader\DOC::func('TestFunction')->doc()->print;