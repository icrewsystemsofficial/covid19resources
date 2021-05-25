<?php

namespace Tests\Feature;

use App\Imports\ResourceImport;
use App\Models\Resource;
use Database\Factories\ResourceFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Testing\File;
use Maatwebsite\Excel\Excel;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Models\User;

class ResourceImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_admin_can_view_import_resources_page()
    {
        $role = Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $response = $this->get(route('admin.resources.import'));
        $response->assertSee($user->email);

    }

    /**
     * @test
     */
    public function test_to_import_resources_to_database()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);
//        $local_file = __DIR__.'/./../files/resources.xlsx';

        $file = new UploadedFile(base_path('tests/files/resources.xlsx'), 'source.xlsx', null, null, true);

        $response = $this->post(route('admin.resources.import.file'), [
            'select_file' => $file
        ]);

        $this->assertDatabaseHas('resources', [
            'title' => 'Sharable coherent access'
        ]);

       /*
       Change the Ressponse status in ResourceController to 200
        and uncomment the line no 44 and comment the line number 43 before running  testing
       */
        $response->assertOk();
//        dd($response);


    }


}
