<?php
/**
 * Created by PhpStorm.
 * User: yukar
 * Date: 2017/9/23
 * Time: 下午11:21
 */

namespace DocReader;


class Read
{
    private $class;

    private $function;

    private $method;

    private $classObject;

    private $document;

    private $property;

    public function __construct($type,$object)
    {
        switch ($type){
            case 'class':
                $this->class=$object;
                $this->classObject=new \ReflectionClass($object);
                return $this;
            case 'func':
                $this->function=$object;
                return $this;
        }
    }

    public function method($name){
        if($this->classObject->hasMethod($name))
            $this->method=$name;
        else
            return false;
        return $this;
    }

    public function property($name){
        if($this->classObject->hasProperty($name))
            $this->property=$name;
        else
            return false;
        return $this;
    }

    public function doc(){
        if($this->class){
            if($this->method)
                $this->document=$this->classObject->getMethod($this->method)->getDocComment();
            elseif($this->property){
                $this->document=$this->classObject->getProperty($this->property)->getDocComment();
            }
            else
                $this->document=$this->classObject->getDocComment();
        }elseif($this->function)
            $this->document=(new \ReflectionFunction($this->function))->getDocComment();
        return (new Convert($this->document));
    }
}