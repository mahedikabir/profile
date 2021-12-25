<?php namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('settings');
        $this->builderGeneral = $this->db->table('general_settings');
        $this->builderFonts = $this->db->table('fonts');
    }

    //update settings
    public function updateSettings()
    {
        $data = [
            'lang_id' => inputPost('lang_id'),
            'application_name' => inputPost('application_name'),
            'facebook_url' => addHttpsToUrl(inputPost('facebook_url')),
            'twitter_url' => addHttpsToUrl(inputPost('twitter_url')),
            'instagram_url' => addHttpsToUrl(inputPost('instagram_url')),
            'pinterest_url' => addHttpsToUrl(inputPost('pinterest_url')),
            'linkedin_url' => addHttpsToUrl(inputPost('linkedin_url')),
            'vk_url' => addHttpsToUrl(inputPost('vk_url')),
            'youtube_url' => addHttpsToUrl(inputPost('youtube_url')),
            'telegram_url' => addHttpsToUrl(inputPost('telegram_url')),
            'optional_url_button_name' => inputPost('optional_url_button_name'),
            'about_footer' => inputPost('about_footer'),
            'copyright' => inputPost('copyright'),
            'contact_text' => inputPost('contact_text', false),
            'contact_address' => inputPost('contact_address'),
            'contact_email' => inputPost('contact_email'),
            'contact_phone' => inputPost('contact_phone'),
            'cookies_warning' => inputPost('cookies_warning'),
            'cookies_warning_text' => inputPost('cookies_warning_text')
        ];

        return $this->builder->where('lang_id', $data['lang_id'])->update($data);
    }

    //update general settings
    public function updateGeneralSettings()
    {
        $data = [
            'timezone' => inputPost('timezone'),
            'admin_route' => strSlug(inputPost('admin_route')),
            'multilingual_system' => inputPost('multilingual_system'),
            'registration_system' => inputPost('registration_system'),
            'approve_posts_before_publishing' => inputPost('approve_posts_before_publishing'),
            'comment_system' => inputPost('comment_system'),
            'comment_approval_system' => inputPost('comment_approval_system'),
            'facebook_comment' => inputPost('facebook_comment'),
            'slider_active' => inputPost('slider_active'),
            'emoji_reactions' => inputPost('emoji_reactions'),
            'show_pageviews' => inputPost('show_pageviews'),
            'show_rss' => inputPost('show_rss'),
            'file_manager_show_all_files' => inputPost('file_manager_show_all_files'),
            'pagination_per_page' => inputPost('pagination_per_page'),
            'site_color' => inputPost('site_color'),
            'custom_css_codes' => inputPost('custom_css_codes'),
            'custom_javascript_codes' => inputPost('custom_javascript_codes')
        ];
        $uploadModel = new UploadModel();
        $logo = $uploadModel->uploadLogo('logo');
        $mobileLogo = $uploadModel->uploadLogo('mobile_logo');
        $favicon = $uploadModel->uploadFavicon();
        if (!empty($logo) && !empty($logo['path'])) {
            $data["logo_path"] = $logo['path'];
        }
        if (!empty($mobileLogo) && !empty($mobileLogo['path'])) {
            $data["mobile_logo_path"] = $mobileLogo['path'];
        }
        if (!empty($favicon) && !empty($favicon['path'])) {
            $data["favicon_path"] = $favicon['path'];
        }
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //update auto post deletion settings
    public function updateAutoPostDeletionSettings()
    {
        $data = [
            'auto_post_deletion' => inputPost('auto_post_deletion'),
            'auto_post_deletion_days' => inputPost('auto_post_deletion_days'),
            'auto_post_deletion_delete_all' => inputPost('auto_post_deletion_delete_all')
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //get settings
    public function getSettings($lang_id)
    {
        return $this->builder->where('lang_id', cleanNumber($lang_id))->get()->getRow();
    }

    //set mode
    public function setMode()
    {
        $data = [
            'dark_mode' => inputPost('dark_mode')
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //set theme
    public function setTheme()
    {
        $data = [
            'layout' => inputPost('layout')
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }


    //update recaptcha settings
    public function updateRecaptchaSettings()
    {
        $data = [
            'recaptcha_site_key' => inputPost('recaptcha_site_key'),
            'recaptcha_secret_key' => inputPost('recaptcha_secret_key'),
            'recaptcha_lang' => inputPost('recaptcha_lang')
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //update maintenance mode settings
    public function updateMaintenanceModeSettings()
    {
        $data = [
            'maintenance_mode_title' => inputPost('maintenance_mode_title'),
            'maintenance_mode_description' => inputPost('maintenance_mode_description'),
            'maintenance_mode_status' => inputPost('maintenance_mode_status')
        ];
        if (empty($data["maintenance_mode_status"])) {
            $data["maintenance_mode_status"] = 0;
        }
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //update allowed file extensions post
    public function updateAllowedFileExtensions()
    {
        $extArray = @explode(',', inputPost('allowed_file_extensions'));
        if (!empty($extArray)) {
            $exts = json_encode($extArray);
            $exts = str_replace('[', '', $exts);
            $exts = str_replace(']', '', $exts);
            $exts = str_replace('.', '', $exts);
            $exts = str_replace('"', '', $exts);
            $exts = str_replace("'", '', $exts);
            $exts = strtolower($exts);
            $data = [
                'allowed_file_extensions' => $exts
            ];
            return $this->builderGeneral->where('id', 1)->update($data);
        }
        return false;
    }

    //get settings
    public function getGeneralSettings()
    {
        return $this->builderGeneral->where('id', 1)->get()->getRow();
    }

    //update seo settings
    public function updateSeoSettings()
    {
        $general = [
            'google_analytics' => inputPost('google_analytics'),
        ];
        $this->builderGeneral->where('id', 1)->update($general);

        $data = [
            'site_title' => inputPost('site_title'),
            'home_title' => inputPost('home_title'),
            'site_description' => inputPost('site_description'),
            'keywords' => inputPost('keywords')
        ];

        $langId = inputPost('lang_id');
        return $this->builder->where('lang_id', cleanNumber($langId))->update($data);
    }

    //edit social settings
    public function editSocialSettings()
    {
        $loginType = inputPost('login_type');
        if ($loginType == 'facebook') {
            $data = [
                'facebook_app_id' => trim(inputPost('facebook_app_id')),
                'facebook_app_secret' => trim(inputPost('facebook_app_secret'))
            ];
            return $this->builderGeneral->where('id', 1)->update($data);
        }
        if ($loginType == 'google') {
            $data = [
                'google_client_id' => trim(inputPost('google_client_id')),
                'google_client_secret' => trim(inputPost('google_client_secret'))
            ];
            return $this->builderGeneral->where('id', 1)->update($data);
        }
        return false;
    }

    //update cache system
    public function updateCacheSystem()
    {
        $data = [
            'cache_system' => inputPost('cache_system'),
            'refresh_cache_database_changes' => inputPost('refresh_cache_database_changes'),
            'cache_refresh_time' => inputPost('cache_refresh_time') * 60
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //update email settings
    public function updateEmailSettings()
    {
        $data = [
            'mail_library' => inputPost('mail_library'),
            'mail_protocol' => inputPost('mail_protocol'),
            'mail_encryption' => inputPost('mail_encryption'),
            'mail_host' => inputPost('mail_host'),
            'mail_port' => inputPost('mail_port'),
            'mail_username' => inputPost('mail_username'),
            'mail_password' => inputPost('mail_password'),
            'mail_title' => inputPost('mail_title'),
            'mail_reply_to' => inputPost('mail_reply_to')
        ];
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //update email options
    public function updateEmailOptions()
    {
        $data = array(
            'send_email_contact_messages' => inputPost('send_email_contact_messages'),
            'mail_options_account' => inputPost('mail_options_account')
        );
        return $this->builderGeneral->where('id', 1)->update($data);
    }

    //get selected fonts
    public function getSelectedFonts($settings)
    {
        $pfId = cleanNumber($settings->primary_font);
        $sfId = cleanNumber($settings->secondary_font);
        $sql = "SELECT font_url AS primary_font_url, font_family AS primary_font_family, 
                (SELECT font_url FROM fonts WHERE id = ?) AS secondary_font_url,
                (SELECT font_family FROM fonts WHERE id = ?) AS secondary_font_family                          
                FROM fonts WHERE id = ?";
        return $this->db->query($sql, array($sfId, $sfId, $pfId))->getRow();
    }

    //get fonts
    public function getFonts()
    {
        return $this->db->table('fonts')->get()->getResult();
    }

    //get font
    public function getFont($id)
    {
        return $this->db->table('fonts')->where('id', cleanNumber($id))->get()->getRow();
    }

    //add font
    public function addFont()
    {
        $data = [
            'font_name' => inputPost('font_name'),
            'font_url' => inputPost('font_url'),
            'font_family' => inputPost('font_family'),
            'is_default' => 0
        ];
        return $this->db->table('fonts')->insert($data);
    }

    //set site font
    public function setDefaultFonts()
    {
        $langId = inputPost('lang_id');
        $data = [
            'primary_font' => inputPost('primary_font'),
            'secondary_font' => inputPost('secondary_font')
        ];
        return $this->db->table('settings')->where('lang_id', cleanNumber($langId))->update($data);
    }

    //edit font
    public function editFont($id)
    {
        $data = [
            'font_name' => inputPost('font_name'),
            'font_url' => inputPost('font_url'),
            'font_family' => inputPost('font_family')
        ];
        return $this->db->table('fonts')->where('id', cleanNumber($id))->update($data);
    }

    //delete font
    public function deleteFont($id)
    {
        $font = $this->getFont($id);
        if (!empty($font)) {
            return $this->db->table('fonts')->where('id', $font->id)->delete();
        }
        return false;
    }

    //delete old sessions
    function deleteOldSessions()
    {
        $now = date('Y-m-d H:i:s');
        $this->db->table('ci_sessions')->where("timestamp < DATE_SUB('" . $now . "', INTERVAL 6 DAY)")->delete();
        $this->builderGeneral->where('id', 1)->update(['last_cron_update' => date('Y-m-d H:i:s')]);
    }

}
