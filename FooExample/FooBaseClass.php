<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 30.12.21
 * Time: 18:10
 */

namespace FooExample;

abstract class FooBaseClass implements Foobable
{
    abstract function getFooName(): string;

    function sayFoo(): void
    {
        echo $this->getFooName();
    }
}