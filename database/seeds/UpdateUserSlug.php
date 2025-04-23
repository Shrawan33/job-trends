<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpdateUserSlug extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereNull('slug')->withTrashed()->get();

        foreach ($users as $user) {
            $company = $user->company_name ? str_replace(' ', '', $user->company_name) : '';
            $first_name = $user->first_name ? str_replace(' ', '', $user->first_name) : '';
            $last_name = $user->last_name ? str_replace(' ', '', $user->last_name) : '';
            $uuid = Str::uuid();
            $concateFields = "$company" . ' ' . "$first_name" . ' ' . "$last_name" . ' ' . "$uuid";
            $slug = Str::slug($concateFields, '-');
            $user->slug = $slug;
            $user->save();
        }
    }
}
