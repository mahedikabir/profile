<?php

use Illuminate\Database\Seeder;

class settingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'settings_key' => 'website_title',
            'settings_value' => 'SUST Press Club',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'website_email',
            'settings_value' => 'pressclub.sust@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'facebook',
            'settings_value' => 'https://facebook.com/sust',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'twitter_page',
            'settings_value' => 'https://twitter.com/sust',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'contact_phone',
            'settings_value' => '017XXXXXXXX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'contact_phone2',
            'settings_value' => '017XXXXXXXXX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'chat_code',
            'settings_value' => 'Room 101-102, Ground floor, library Building, SUST, Sylhet',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'youtube_site',
            'settings_value' => 'https://youtube.com/sust',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'linked_in',
            'settings_value' => 'https://linkedin.com/sust',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'website_logo',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'favicon',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'committee_show',
            'settings_value' => '16',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'constitution',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'vc_name',
            'settings_value' => 'Professor Farid Uddin Ahmed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'settings_key' => 'vc_image',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'other_logo_activity',
            'settings_value' => 'deactivate',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'other_logo',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'other_logo_url',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'website_mode',
            'settings_value' => 'live',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'home_header',
            'settings_value' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'home_tab',
            'settings_value' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'content_modify',
            'settings_value' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'page_title_heading',
            'settings_value' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'album_type',
            'settings_value' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'home_welcome',
            'settings_value' => 'Shahjalal University Press Club, a platform of journalists at Shahjalal University of Science and Technology (SUST) campus, is one of the dynamic organizations of campus journalists all over the country that exclusively has been trying for the betterment of journalism at SUST campus as well as promoting multiple issues of journalism in respective arena.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'page_advisor',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'page_history',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'page_about',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'settings_key' => 'home_objectives',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'home_activity_press_club',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'settings_key' => 'home_about_us',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'slider_layout',
            'settings_value' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'generalRequest',
            'settings_value' => 'disable',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
