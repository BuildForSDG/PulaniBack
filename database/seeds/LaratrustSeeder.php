<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = \App\Role::create([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Permission::firstOrCreate([
                        'name' => $permissionValue . '-' . $module,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            $this->command->info("Creating '{$key}' user");
             //Autogenerate phonumbers but convert to string to support 070277883 format
            $phone = strval(mt_rand(702767861, 702789922)); 

            // Create default user for each role
            $user = \App\User::create([
                        'title' => 'Mr.',
                        'firstName' => 'User',
                        'lastName' => ucwords(str_replace('_', ' ', $key)),
                        'otherName' => 'James',
                        'dateOfBirth' => '29/06/1991',
                        'gender' => 'Male',
                        'email' => $key.'@pulaniapp.com',
                        'phone' => "0"."$phone",
                        'idType' => 'National ID',
                        'idNumber' => '182772893048',
                        'idDateOfIssue' => '12/09/2010',
                        'idExpiryDate' => '12/09/2022',
                        'photo' => 'someimage',
                        'areaOfResidence' => 'Kampala',
                        'businessName' => 'Pulani Codes',
                        'businessAddress' => 'Plot 33, Ntinda Complex, Somethhing small here but, you could ...',
                        'yearsOfBusiness' => '2',
                        'totalBusinessCapital' => '4700000',
                        'numberOfDependants' => '3',
                        'next0fKin' => 'Ambrose Okello',
                        'password' => bcrypt('password'),
            ]);

            $user->attachRole($role);
        }

        // Creating user with permissions
        if (!empty($userPermission)) {

            foreach ($userPermission as $key => $modules) {

                foreach ($modules as $module => $value) {

                    //Autogenerate phonumbers but convert to string to support 070277883 format
                    $phone = strval(mt_rand(702767861, 702789922)); 
                    // Create default user for each permission set
                    $user = \App\User::create([
                        'title' => 'Mr.',
                        'firstName' => 'User',
                        'lastName' => ucwords(str_replace('_', ' ', $key)),
                        'otherName' => '',
                        'dateOfBirth' => '29/06/1991',
                        'gender' => 'Male',
                        'email' => $key.'@pulaniapp.com',
                        'phone' => "0"."$phone",
                        'idType' => 'National ID',
                        'idNumber' => '182772893048',
                        'idDateOfIssue' => '12/09/2010',
                        'idExpiryDate' => '12/09/2022',
                        'photo' => '',
                        'areaOfResidence' => 'Kampala',
                        'businessName' => 'Pulani Codes',
                        'businessAddress' => 'Plot 33, Ntinda Complex, Somethhing small here but, you could ...',
                        'yearsOfBusiness' => '2',
                        'totalBusinessCapital' => '4700000',
                        'numberOfDependants' => '3',
                        'next0fKin' => 'Ambrose Okello',
                        'password' => bcrypt('password'),
                        'remember_token' => Str::random(10),
                    ]);
                    $permissions = [];

                    foreach (explode(',', $value) as $p => $perm) {

                        $permissionValue = $mapPermission->get($perm);

                        $permissions[] = \App\Permission::firstOrCreate([
                            'name' => $permissionValue . '-' . $module,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ])->id;

                        $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                    }
                }

                // Attach all permissions to the user
                $user->permissions()->sync($permissions);
            }
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\User::truncate();
        \App\Role::truncate();
        \App\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
