<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenancyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_login_view()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_view()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $this->withoutExceptionHandling();
        $this->post('/register-store', [
            'full_name' => 'TestUser',
            'email' => 'test@mail.com',
            'sub_domain' => 'test',
            'password' => 123456,
            '_token' => csrf_token()
        ]);

        $response = $this->post('/login-store', [
            'email' => 'test@mail.com',
            'password' => 123456,
            '_token' => csrf_token()
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect('https://'.'test.'.env('DOMAIN').'/dashboard')
            ->assertSeeText('test.'.env('DOMAIN'));
         
    }




    public function test_register()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/register-store', [
            'full_name' => 'TestUser',
            'email' => 'test@mail.com',
            'sub_domain' => 'test',
            'password' => 123456,
            '_token' => csrf_token()
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('https://'.'test.'.env('DOMAIN').'/dashboard')
            ->assertSeeText('test.'.env('DOMAIN'));

    }
}
