<?php
namespace app\myClases;

class Foo {

    public $var1;

    public function __construct(Baz $par1)  //Inyecto la clase baz como par1
    {
        $this->var1= $par1->name;         //
    }

}
























?>
