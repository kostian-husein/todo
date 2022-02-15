<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 30.12.21
 * Time: 18:10
 */

namespace FooExample;

interface Foobable {
    function sayFoo(): void;

    function getFooName(): string;
}