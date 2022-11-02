<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Checking Login is Rendered.
     *
     * @return void
     */
    public function test_login_is_rendered_properly()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }


    /**
     * Example Login without Email Input.
     *
     * @return void
     */
    public function test_login_without_email() 
    {
        $response = $this->post('/login', [
            'us_password' => '123456',
            'submit-process' => 'submit-process'
        ]);


        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $response->assertSessionHas('error', $value = 'Email atau kata sandi salah !');
    }


    /**
     * Example Login without Password Input.
     *
     * @return void
     */
    public function test_login_without_password() 
    {
        $response = $this->post('/login', [
            'us_email' => 'syaifullah@temani.id',
            'submit-process' => 'submit-process'
        ]);


        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $response->assertSessionHas('error', $value = 'Email atau kata sandi salah !');
    }


    /**
     * Example Login without Email and Password Input.
     *
     * @return void
     */
    public function test_login_without_email_and_password() 
    {
        $response = $this->post('/login', [
            'submit-process' => 'submit-process'
        ]);


        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $response->assertSessionHas('error', $value = 'Email atau kata sandi salah !');
    }


    /**
     * Example Login with Invalid Credential.
     *
     * @return void
     */
    public function test_login_with_invalid_credential() 
    {
        $response = $this->post('/login', [
            'us_email' => 'syaifullah@temani.id',
            'us_password' => '123456',
            'submit-process' => 'submit-process'
        ]);


        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        $response->assertSessionHas('error', $value = 'Email atau kata sandi salah !');
    }


    /**
     * Example Login with Valid Credential.
     *
     * @return void
     */
    public function test_login_with_valid_credential() 
    {
        $response = $this->post('/login', [
            'us_email' => 'baskara@temani.id',
            'us_password' => '123456',
            'submit-process' => 'submit-process'
        ]);


        $response->assertStatus(302);
        $response->assertRedirect('/home');
        
        $response->assertSessionHas('success', $value = 'Selamat datang di Temani !');

        $response->assertSessionHas('admUser', function ($value) {
            return $value->us_email === 'baskara@temani.id';
        });
    }
    

}
