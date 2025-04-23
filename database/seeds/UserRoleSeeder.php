<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['title' => 'Admin', 'name' => 'admin', 'guard_name' => 'web'],
            ['title' => 'Employer', 'name' => 'employer', 'guard_name' => 'web'],
            ['title' => 'Job Seeker', 'name' => 'jobseeker', 'guard_name' => 'web'],
            ['title' => 'Mentor', 'name' => 'mentor', 'guard_name' => 'web'],
            ['title' => 'Account Manager', 'name' => 'account', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            $record = Role::whereName($role['name'])->first();
            if (!$record) {
                Role::create($role);
            } else {
                $record->title = $role['title'];
                $record->save();
            }
        }

        $adminEmails = ['shahdigs007@yahoo.com'];
        $employerEmails = ['digantshahfamily@gmail.com'];
        $jobseekerEmails = ['phpdeveloper200288@gmail.com', 'phpdeveloper200289@gmail.com'];

        $isHashStrong = env('APP_ENV', 'local') == 'production' ? true : false;

        if ($isHashStrong) {
            $users = [
                // ['name' => 'Aamir Mansuri', 'email' => 'mansuri.aamir@gmail.com', 'password' => Hash::make($isHashStrong ? 'bJeH*Q6F' : 'admin123'), 'email_verified_at' => date('Y-m-d H:i:s')],
                // ['name' => 'Ebrahim Albasri', 'email' => 'ealbasri@simpeli.com', 'password' => Hash::make($isHashStrong ? 'hFVdU6{a' : 'admin123'), 'email_verified_at' => date('Y-m-d H:i:s')],
                // ['name' => 'Husain Aljazeeri', 'email' => 'husain@lightex.com.bh', 'password' => Hash::make($isHashStrong ? 'HT5]3Asq' : 'admin123'), 'email_verified_at' => date('Y-m-d H:i:s')]
            ];
        } else {
            $users = [
                ['first_name' => 'Admin', 'email' => 'shahdigs007@yahoo.com', 'password' => Hash::make($isHashStrong ? 'bJeH*Q6F' : 'admin123'), 'email_verified_at' => date('Y-m-d H:i:s')],
                ['first_name' => 'Employer A', 'email' => 'digantshahfamily@gmail.com', 'password' => Hash::make($isHashStrong ? 'cK*^4$3%' : 'employer123'), 'email_verified_at' => date('Y-m-d H:i:s')],
                ['first_name' => 'Job Seeker 1', 'email' => 'phpdeveloper200288@gmail.com', 'password' => Hash::make($isHashStrong ? 'RuDv~=9c' : '123456'), 'email_verified_at' => date('Y-m-d H:i:s')],
                ['first_name' => 'Job Seeker 2', 'email' => 'phpdeveloper200289@gmail.com', 'password' => Hash::make($isHashStrong ? 'R6L@c-J^' : '123456'), 'email_verified_at' => date('Y-m-d H:i:s')],
            ];
        }
        // dd($users);
        foreach ($users as $user) {
            $record = User::whereEmail($user['email'])->first();
            if (!$record) {
                $record = User::create($user);
            } else {
                // if ($isHashStrong == false) {
                $record->fill($user);
                $record->save();
                // }
            }

            if (in_array($user['email'], $adminEmails)) {
                $record->assignRole('admin');
            } elseif (in_array($user['email'], $employerEmails)) {
                $record->assignRole('employer');
            } elseif (in_array($user['email'], $jobseekerEmails)) {
                $record->assignRole('jobseeker');
            }
        }
    }
}
