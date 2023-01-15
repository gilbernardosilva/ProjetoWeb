<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class discountTest extends TestCase
{
    public function test_discount_correct(){
        $discount = mt_rand(1,100);
        $price= mt_rand(1,500);
        $pass = false;
        $final_price = $price - $price * ($discount / 100);
        if($final_price > 0){
            $pass = true;
        }
        $this->assertTrue($pass);
    }

    public function test_discount_incorrect(){
        $discount = mt_rand(-100,0);
        $price= mt_rand(1,500);
        $pass = false;
        $final_price = $price - $price * ($discount / 100);
        if($final_price < 0 || $final_price > $price){
            $pass = true;
        }
        $this->assertTrue($pass);
    }
}

