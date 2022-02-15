<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 30.12.21
 * Time: 18:10
 */

namespace FooExample;

class FooClass extends FooBaseClass implements Foobable
{
   public function getFooName(): string
   {
        return "asdasd";
   }
}