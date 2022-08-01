<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class TestAuth extends TestCase
{
	/**
	* Login without sending email parameter
	*
	* @return void
	*/
	public function testLoginIfEmailIsMissing(){
		$response=$this->post('api/auth/login', [
			'password' => env('TEST_PASS')
		]);
		$response->assertStatus(401);
	}
	
	/**
	* Login as default API user and get token back.
	*
	* @return void
	*/
	public function testLogin()
	{
		$response=$this->post('api/auth/login', [
			'email'=>env('TEST_USER'), 
			'password' => env('TEST_PASS')
		]);

		$response->assertStatus(200)
		->assertJsonStructure([
			'access_token', 'token_type', 'expires_in'
		]);
	}
	
	/**
	* Test logout without bearer token
	*
	* @return void
	*/
	public function testLogoutWithoutToken()
	{
		$user = User::where('email', env('TEST_USER'))->first();

		$response = $this->json('POST', '/api/auth/logout', []);

		$response
			->assertStatus(401);
	}
	
	/**
	* Test logout.
	*
	* @return void
	*/
	public function testLogout()
	{
		$user = User::where('email', env('TEST_USER'))->first();
		$token = JWTAuth::fromUser($user);

		$response = $this->json('POST', '/api/auth/logout', [], [
			'HTTP_AUTHORIZATION' => 'Bearer '.$token
		]);

		$response
			->assertStatus(200);
	}

	/**
	* Test token refresh.
	*
	* @return void
	*/
	public function testRefresh()
	{
		$user = User::where('email', env('TEST_USER'))->first();
		$token = JWTAuth::fromUser($user);

		$response = $this->json('POST', '/api/auth/refresh', [], [
			'HTTP_AUTHORIZATION' => 'Bearer '.$token
		]);

		$response
			->assertStatus(200)
			->assertJsonStructure([
				'access_token', 'token_type', 'expires_in'
			]);
	}
}