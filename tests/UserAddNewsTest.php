<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAddNewsTest extends TestCase
{

    public function testAddNotValidUser()
    {
        $this->visit('/news/add')->dontSee('Add new article');
    }

    public function testVerifiedLoggedUser()
    {
        $user = factory(App\User::class)->create();
        $user->verified = 1;
        $this->actingAs($user)
            ->withSession([])
            ->visit('/news/add')
            ->see('Add new article');
    }

    public function testNotVerifiedLoggedUser()
    {
        $user = factory(App\User::class)->create();
        $user->verified = 0;
        $this->actingAs($user)
            ->withSession([])
            ->visit('/news/add')
            ->dontSee('Add new article');
    }
}
