<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Seed the default roles
         $roles = array(
            'superadmin',
            'moderator',
            'provider',
            'requester',
            'user'
          );

          // Seed the default permissions
          $permissions = array(
            'administrate',
            'moderate',
            'basic-user'
          );



          foreach ($permissions as $perms) {
              Permission::firstOrCreate(['name' => $perms]);
              $this->command->warn("Permission: $perms created.");
          }

          foreach ($roles as $role) {

            $role = Role::firstOrCreate(['name' => trim($role)]);
            $this->command->warn("Role: $role->name created.");
            if( $role->name == 'superadmin' ) {
                // assign all permissions
                $role->syncPermissions(Permission::all());
                $this->command->info('SUPER ADMIN: Created, granted all the permissions');

            } else {
                // for others by default only read access
                $role->syncPermissions(Permission::where('name', 'basic-user')->get());
            }
          }

          $this->command->info('SUCCESS! All roles and permissions seeded');

          // Confirm roles needed
        //   if ($this->command->confirm('Do you wish to grant administrator access to all seeded users?', true)) {
        //       $users = User::all();
        //       foreach($users as $user) {
        //         $user->assignRole('superadmin');
        //         $this->command->info("SUPER ADMIN: Access granted for $user->name.");
        //       }
        //   } else {
        //       $this->command->error('No users were given administrator access. Add manually using artisan command to view the dashboard, OR run the seeder again');
        //   }

            $users = User::all();
            foreach($users as $user) {
                $user->assignRole('superadmin');
                $this->command->info("SUPER ADMIN: Access granted for $user->name.");
            }
    }
}
