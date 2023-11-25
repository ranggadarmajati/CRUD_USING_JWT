<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * feature auth login
     * @return void
     * @author rangga darmajati
     */
    public function testApiV1AuthLogin()
    {
        $response = $this->post('/api/v1/auth/login',
            [
                'email' => 'dummy.user@mailnesia.com',
                'password' => 'dummypassword321!'
            ]
        );
        $response->assertStatus(200);
    }

    /**
     * feature auth me
     * @return void
     * @author rangga darmajati
     */
    public function testApiV1AuthMe()
    {
        $token = auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => 'bearer '.$token,
        ])->get('/api/v1/auth/me');
        $response->assertStatus(200);
    }

    /**
     * feature refresh token
     * @return void
     * @author rangga darmajati
     */
    public function testApiV1AuthRefresh()
    {
        $token = auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => 'bearer '.$token,
        ])->get('/api/v1/auth/refresh');
        $response->assertStatus(200);
    }

    /**
     * feature auth logout
     * @return void
     * @author rangga darmajati
     */
    public function testApiV1AuthLogout()
    {
        $token = auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => 'bearer '.$token,
        ])->get('/api/v1/auth/logout');
        $response->assertStatus(200);
    }
}
