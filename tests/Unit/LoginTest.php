<?php

namespace Tests\Unit;
use Tests\TestCase;
use Mockery;
use App\Models\User;

class LoginTest extends TestCase
{
    //** @test */
    public function test_user_login()
    {
        $user = User::get()->first();

        $user_mock = Mockery::mock(App\Models\User::class)->makePartial();
        $user_mock->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $user_mock->shouldReceive('getAttribute')->with('name')->andReturn($user->name);
    }
}
