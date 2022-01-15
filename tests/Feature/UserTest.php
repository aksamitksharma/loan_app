<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
class UserTest extends TestCase
{
    /**
     * test user success login
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::get()->first();

        $email = $user->email;
        $name = $user->name;

        $post_data = ['email' => $email, 'password' => 'test@123'];
        $response = $this->post('/api/login', $post_data);
        $api_name_return = $response->json()['data']['name'];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($name, $api_name_return);
    }
}
