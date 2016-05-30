<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        //$this->visit('/')->see('News');

        $mailer = new \PHPMailer(true);
        $mailer->addAddress("jjcc1421@gmail.com", "Juan Caicedo");
        $mailer->Subject = "Test";
        $mailer->MsgHTML("This is a test");
        $sent = $mailer->send();
        $this->assertTrue($sent);
    }


    /*public function testMail()
    {
        $mailer = new \PHPMailer(true);
        $sent = $mailer->send();
        $this->assertTrue($sent);
    }*/
}
