<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class loginTest extends TestCase
{
    public function test_password_matching()
    {
        $pwd1 = '12345678';
        $pwd2 = '12345678';
        $pass = false;
        if ($pwd1 == $pwd2 && strlen($pwd1) >= 8 && strlen($pwd1) <= 20) {
            $pass = true;
        }

        $this->assertTrue($pass);
    }

    public function test_password_not_matching()
    {
        $pwd1 = '12345678';
        $pwd2 = 'pwd123213';
        $pass = false;
        if ($pwd1 != $pwd2 || strlen($pwd1) < 8 || strlen($pwd1) > 20 || strlen($pwd2) < 8 || strlen($pwd2) > 20) {
            $pass = true;
        }
        $this->assertTrue($pass);
    }

    public function test_email_matching()
    {
        $email = 'test@hotmail.com';
        $pass = false;
        if (strpos($email, '@gmail.com') || strpos($email, '@hotmail.com')) {
            $pass = true;
            if (strlen($email) > 20) {
                $pass = false;
            }
        }
        $this->assertTrue($pass);
    }

    public function test_email_not_matching()
    {
        $email = 'test@12345.com';
        $pass = false;
        if (!(strpos($email, '@gmail.com') || strpos($email, '@hotmail.com'))) {
            $pass = true;
            if (strlen($email) >= 20 || strlen($email) <= 8 ) {
                $pass = false;
            }
        }
        $this->assertTrue($pass);
    }
}
