<?php

use App\Models\ApplicationTracking;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class TruncateTables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('app_tracking')->truncate();
        echo "app_tracking truncated.";
        DB::table('applied_job_questionnaires')->truncate();
        echo "applied_job_questionnaires truncated.";
        DB::table('applied_jobs')->truncate();
        echo "applied_jobs truncated.";
        DB::table('assign_employer')->truncate();
        echo "assign_employer truncated.";

        // except banners and blogs
        DB::table('documents')->whereNotIn('disk', ['banners', 'blogs'])->delete();
        echo "documents truncated.";

        DB::table('employer_job_certifications')->truncate();
        echo "employer_job_certifications truncated.";
        DB::table('employer_job_qualifications')->truncate();
        echo "employer_job_qualifications truncated.";
        DB::table('employer_jobs')->truncate();
        echo "employer_jobs truncated.";
        DB::table('employer_jobs_skill')->truncate();
        echo "employer_jobs_skill truncated.";
        DB::table('employer_jobs_work_type')->truncate();
        echo "employer_jobs_work_type truncated.";

        DB::table('failed_jobs')->truncate();
        echo "failed_jobs truncated.";
        DB::table('favorite_jobs')->truncate();
        echo "favorite_jobs truncated.";
        DB::table('favourite_candidates')->truncate();
        echo "favourite_candidates truncated.";
        DB::table('job_alerts')->truncate();
        echo "job_alerts truncated.";
        DB::table('job_seeker_detail')->truncate();
        echo "job_seeker_detail truncated.";
        DB::table('job_seeker_education')->truncate();
        echo "job_seeker_education truncated.";
        DB::table('job_seeker_experience')->truncate();
        echo "job_seeker_experience truncated.";
        DB::table('job_seeker_license')->truncate();
        echo "job_seeker_license truncated.";
        DB::table('job_seeker_skill')->truncate();
        echo "job_seeker_skill truncated.";
        DB::table('job_seeker_video')->truncate();
        echo "job_seeker_video truncated.";
        DB::table('job_seeker_work_type')->truncate();
        echo "job_seeker_work_type truncated.";
        DB::table('jobs')->truncate();
        echo "jobs truncated.";
        DB::table('notifications')->truncate();
        echo "notifications truncated.";

        // except trial
        DB::table('packages')->where('is_default', 0)->delete();
        echo "packages truncated.";
        DB::table('payments')->truncate();
        echo "payments truncated.";
        DB::table('questionnaire')->truncate();
        echo "questionnaire truncated.";
        DB::table('questionnaire_options')->truncate();
        echo "questionnaire_options truncated.";
        DB::table('remarks')->truncate();
        echo "remarks truncated.";
        DB::table('report_abuses')->truncate();
        echo "report_abuses truncated.";
        DB::table('score_board')->truncate();
        echo "score_board truncated.";
        DB::table('user_package_transactions')->truncate();
        echo "user_package_transactions truncated.";
        DB::table('user_packages')->truncate();
        echo "user_packages truncated.";
        DB::table('user_verifications')->truncate();
        echo "user_verifications truncated.";

        // except 1
        DB::table('users')->where('id', '!=', 1)->delete();
        echo "users truncated.";
        // updated admin user's data
        $user = User::where('id', 1)->withTrashed()->first();
        $user->email =  'info@teachermount.com';
        $user->phone_number =  '+919955991196';
        $user->password = Hash::make('TM@Betamind$21');
        $user->deleted_at = null;
        $user->save();
        echo "user updated.";

        DB::table('users_profile')->truncate();
        echo "users_profile truncated.";
        DB::table('zoom_meeting')->truncate();
        echo "zoom_meeting truncated.";
        echo "Execution Completed.";
        Schema::enableForeignKeyConstraints();
    }
}
