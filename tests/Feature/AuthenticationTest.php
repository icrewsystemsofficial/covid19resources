<?php

namespace Tests\Feature;

//use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\Dashboard\Admin\ResourceController;
use App\Models\Resource;
use App\Upload;
use Illuminate\Http\UploadedFile;
class AuthenticationTest extends TestCase
{
<<<<<<< HEAD
    //use RefreshDatabase;

    
    
=======
    // use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }


>>>>>>> b02ec159c297fe26d9286ee1e97c25a5ef16d0df
    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

     public function test_users_can_authenticate_using_the_login_screen()
     {
         $user = User::factory()->create();


         $response = $this->post('/login', [
            'email' => $user->email,
             'password' => 'password',
         ]);

         $this->assertAuthenticated();
         $response->assertRedirect(RouteServiceProvider::HOME);
     }

     public function test_users_can_not_authenticate_with_invalid_password()
     {
        $user = User::factory()->create();

         $this->post('/login', [
             'email' => $user->email,
             'password' => 'wrong-password',
       ]);


        $this->assertGuest();
    }
         $this->assertGuest();
     }
  
}
