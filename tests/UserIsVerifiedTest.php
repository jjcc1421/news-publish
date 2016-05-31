<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserIsVerifiedTest extends TestCase
{

    public function testUserIsVerified()
    {
        $user = new \App\User();
        $user->name = 'test user';
        $user->email = 'test@email.com';
        $user->verified = 1;
        $this->assertTrue($user->isVerified());
    }

    public function testUserIsNotVerified()
    {
        $user = new \App\User();
        $user->name = 'test user';
        $user->email = 'test@email.com';
        $user->verified = 0;
        $this->assertFalse($user->isVerified());
    }

    public function testBasicExample()
    {
        $this->visit('/news/add')->see('News');
    }
}
