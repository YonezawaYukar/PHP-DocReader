<?php
/**
 * Created by PhpStorm.
 * User: yukar
 * Date: 2017/9/23
 * Time: 下午11:26
 */

namespace DocReader;


class Convert
{
    private $docString;

    private $docArray=[];

    private $lock='desc';

    public function __construct($docString)
    {
        $this->docString=$docString;
        foreach(explode(PHP_EOL,$this->docString) as $line){
            $this->insert(trim($line));
        }
        return $this;
    }

    private function insert($line){
        $line=preg_replace(['/\/\*\*/','/\*/','/\*\//'],'',$line,1);
        if(mb_strlen($line)>1)
            return $this->convert(trim($line));
    }

    private function convert($reline){
        !isset($this->docArray[$this->lock]) and $this->docArray[$this->lock]=[];
        if($reline[0]=='@'){
            $this->lock=str_replace('@','',($lockbody=explode(' ',$reline))[0]);
            !isset($this->docArray[$this->lock]) and $this->docArray[$this->lock]=[];
            if(count($lockbody)>0){
                foreach($lockbody as $i=>$k){
                    $i>0 and $this->docArray[$this->lock][]=$k;
                }
            }
        }
        else
            $this->docArray[$this->lock][]=$reline;
    }


    public function __get($key){
        switch ($key){
            case 'json':
                return json_encode($this->docArray);
            case 'string':
            case 'txt':
                return $this->docString;
            case 'array':
                return $this->docArray;
            case 'print':
                return var_dump($this->docArray);
        }
    }

}