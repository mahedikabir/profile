<?php

namespace App\Controllers;

use App\Models\AdModel;
use App\Models\AuthModel;
use App\Models\CommentModel;
use App\Models\CommonModel;
use App\Models\EmailModel;
use App\Models\NavigationModel;
use App\Models\NewsletterModel;
use App\Models\PageModel;
use App\Models\PollModel;
use App\Models\PostAdminModel;
use App\Models\SettingsModel;
use App\Models\SitemapModel;

class AdminController extends BaseAdminController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    /**
     * Index Page
     */
    public function index()
    {
        $data['title'] = trans("index");

        $data['userCount'] = $this->authModel->getUserCount();
        $commentModel = new CommentModel();
        $data['lastComments'] = $commentModel->getLastComments(5);
        $data['lastPendingComments'] = $commentModel->getLastPeddingComments(5);
        $commonModel = new CommonModel();
        $data['lastContacts'] = $commonModel->getLastContactMessages();
        $data['lastUsers'] = $this->authModel->getLastAddedUsers();
        
        $postAdminModel = new PostAdminModel();
        $data['pendingPostCount'] = $postAdminModel->getPendingPostsCount();
        $data['postCount'] = $postAdminModel->getPostsCount();
        $data['draftCount'] = $postAdminModel->getDraftsCount();

        echo view('admin/includes/_header', $data);
        echo view('admin/index', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Themes
     */
    public function themes()
    {
        preventAuthor();
        $data['title'] = trans("themes");
        
        echo view('admin/includes/_header', $data);
        echo view('admin/themes', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Set Mode Post
     */
    public function setModePost()
    {
        preventAuthor();
        $this->settingsModel->setMode();
        $mode = inputPost('dark_mode');
        if ($mode == 1) {
            setCookie('inf_dark_mode', 1);
        } else {
            setCookie('inf_dark_mode', 0);
        }
        return redirect()->to(adminUrl('themes'));
    }

    /**
     * Set Theme Post
     */
    public function setThemePost()
    {
        preventAuthor();
        $this->settingsModel->setTheme();
        return redirect()->to(adminUrl('themes'));
    }

    /**
     * Set Active Language Post
     */
    public function setActiveLanguagePost()
    {
        preventAuthor();
        $id = cleanNumber(inputPost('lang_id'));
        if (!empty($this->languages)) {
            foreach ($this->languages as $language) {
                if ($language->id == $id) {
                    $this->session->set('inf_admin_lang_id', $id);
                    break;
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Navigation
     */
    public function navigation()
    {
        preventAuthor();
        $data['title'] = trans("navigation");
        $model = new NavigationModel();
        $data['menuItems'] = $model->getAllMenuLinks();
        
        $data['langSearchColumn'] = 3;

        echo view('admin/includes/_header', $data);
        echo view('admin/navigation/navigation', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add Menu Link Post
     */
    public function addMenuLinkPost()
    {
        preventAuthor();
        $val = \Config\Services::validation();
        $val->setRule('title', trans("title"), 'required|max_length[255]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $model = new NavigationModel();
            if ($model->addLink()) {
                $this->session->setFlashdata('success', trans("link") . " " . trans("msg_suc_added"));
                return redirect()->back();
            }
        }
        $this->session->setFlashdata('error', trans("msg_error"));
        return redirect()->back()->withInput();
    }

    /**
     * Edit Menu Link
     */
    public function editMenuLink($id)
    {
        preventAuthor();
        $data['title'] = trans("navigation");
        $model = new PageModel();
        $data['page'] = $model->getPage($id);
        if (empty($data['page'])) {
            return redirect()->back();
        }
        $navModel = new NavigationModel();
        $data['menuItems'] = $navModel->getMenuLinks($data['page']->lang_id);

        echo view('admin/includes/_header', $data);
        echo view('admin/navigation/update_navigation', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Update Menü Link Post
     */
    public function editMenuLinkPost()
    {
        preventAuthor();
        $val = \Config\Services::validation();
        $val->setRule('title', trans("title"), 'required|max_length[255]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $id = inputPost('id');
            $model = new NavigationModel();
            if ($model->editLink($id)) {
                $this->session->setFlashdata('success', trans("link") . " " . trans("msg_suc_updated"));
                return redirect()->to(adminUrl('navigation'));
            }
        }
        $this->session->setFlashdata('error', trans("msg_error"));
        return redirect()->back();
    }

    /**
     * Delete Navigation Post
     */
    public function deleteNavigationPost()
    {
        preventAuthor();
        $id = inputPost('id');
        $model = new PageModel();
        if ($model->deletePage($id)) {
            $this->session->setFlashdata('success', trans("link") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }

    /**
     * Menu Limit Post
     */
    public function menuLimitPost()
    {
        preventAuthor();
        $model = new NavigationModel();
        if ($model->updateMenuLimit()) {
            $this->session->setFlashdata('success', trans("menu_limit") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    //get menu links by language
    public function getMenuLinksByLang()
    {
        $langId = inputPost('lang_id');
        if (!empty($langId)):
            $model = new NavigationModel();
            $menuItems = $model->getMenuLinks($langId);
            foreach ($menuItems as $menuItem):
                if ($menuItem->item_type != "category" && $menuItem->item_location == "header" && $menuItem->item_parent_id == "0"):
                    echo '<option value="' . $menuItem->item_id . '">' . $menuItem->item_name . '</option>';
                endif;
            endforeach;
        endif;
    }

    /**
     * -------------------------------------------------------------------------------------------
     * PAGES
     * -------------------------------------------------------------------------------------------
     */

    /**
     * Add Page
     */
    public function addPage()
    {
        preventAuthor();
        $data['title'] = trans("add_page");
        $model = new NavigationModel();
        $data['menuItems'] = $model->getMenuLinks($this->activeLang->id);
        
        echo view('admin/includes/_header', $data);
        echo view('admin/page/add', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add Page Post
     */
    public function addPagePost()
    {
        preventAuthor();
        $val = \Config\Services::validation();
        $val->setRule('title', trans("title"), 'required|max_length[500]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $model = new PageModel();
            if ($model->addPage()) {
                $this->session->setFlashdata('success', trans("page") . " " . trans("msg_suc_added"));
                return redirect()->back();
            }
        }
        $this->session->setFlashdata('error', trans("msg_error"));
        return redirect()->back()->withInput();
    }

    /**
     * Pages
     */
    public function pages()
    {
        preventAuthor();
        $data['title'] = trans("pages");
        $model = new PageModel();
        $data['pages'] = $model->getPages();
        
        $data['langSearchColumn'] = 2;

        echo view('admin/includes/_header', $data);
        echo view('admin/page/pages', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Edit Page
     */
    public function editPage($id)
    {
        preventAuthor();
        $data['title'] = trans("update_page");
        $model = new PageModel();
        $data['page'] = $model->getPage($id);
        
        if (empty($data['page'])) {
            return redirect()->back();
        }
        $navigationModel = new NavigationModel();
        $data['menuItems'] = $navigationModel->getMenuLinks($data['page']->lang_id);

        echo view('admin/includes/_header', $data);
        echo view('admin/page/update', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Update Page Post
     */
    public function editPagePost()
    {
        preventAuthor();
        $val = \Config\Services::validation();
        $val->setRule('title', trans("title"), 'required|max_length[500]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $id = inputPost('id');
            $redirectUrl = inputPost('redirect_url');
            $model = new PageModel();
            if ($model->editPage($id)) {
                $this->session->setFlashdata('success', trans("msg_updated"));
                if (!empty($redirectUrl)) {
                    return redirect()->to(adminUrl($redirectUrl));
                }
                return redirect()->to(adminUrl('pages'));
            }
        }
        $this->session->setFlashdata('error', trans("msg_error"));
        return redirect()->back()->withInput();
    }

    /**
     * Delete Page Post
     */
    public function deletePagePost()
    {
        preventAuthor();
        $id = inputPost('id');
        $model = new PageModel();
        if ($model->deletePage($id)) {
            $this->session->setFlashdata('success', trans("msg_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }

    /**
     * Comments
     */
    public function comments()
    {
        preventAuthor();
        $data['title'] = trans("approved_comments");
        $model = new CommentModel();
        $data['comments'] = $model->getApprovedComments();
        
        $data['top_button_text'] = trans("pending_comments");
        $data['top_button_url'] = adminUrl("pending-comments");
        $data['show_approve_button'] = false;

        echo view('admin/includes/_header', $data);
        echo view('admin/comments', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Pending Comments
     */
    public function pendingComments()
    {
        preventAuthor();
        $data['title'] = trans("pending_comments");
        $model = new CommentModel();
        $data['comments'] = $model->getPendingComments();
        
        $data['top_button_text'] = trans("approved_comments");
        $data['top_button_url'] = adminUrl("comments");
        $data['show_approve_button'] = true;

        echo view('admin/includes/_header', $data);
        echo view('admin/comments', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Aprrove Comment Post
     */
    public function approveCommentPost()
    {
        $id = inputPost('id');
        $model = new CommentModel();
        if ($model->approveComment($id)) {
            $this->session->setFlashdata('success', trans("msg_comment_approved"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Delete Comment Post
     */
    public function deleteCommentPost()
    {
        $id = inputPost('id');
        $model = new CommentModel();
        if ($model->deleteComment($id)) {
            $this->session->setFlashdata('success', trans("comment") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }

    /**
     * Delete Selected Comments
     */
    public function deleteSelectedComments()
    {
        $commentIds = inputPost('comment_ids');
        $model = new CommentModel();
        $model->deleteMultiComments($commentIds);
    }

    /**
     * Approve Selected Comments
     */
    public function approveSelectedComments()
    {
        $commentIds = inputPost('comment_ids');
        $model = new CommentModel();
        $model->approveMultiComments($commentIds);
    }

    /**
     * Contact Messages
     */
    public function contactMessages()
    {
        preventAuthor();
        $data['title'] = trans("contact_messages");
        $model = new CommonModel();
        
        $data['messages'] = $model->getContactMessages();

        echo view('admin/includes/_header', $data);
        echo view('admin/contact_messages', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Delete Contact Message Post
     */
    public function deleteContactMessagePost()
    {
        $id = inputPost('id');
        $model = new CommonModel();
        if ($model->deleteContactMessage($id)) {
            $this->session->setFlashdata('success', trans("message") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }

    /**
     * Ads
     */
    public function adSpaces()
    {
        preventAuthor();
        $data['title'] = trans("ad_spaces");
        $data['adSpace'] = inputGet('ad_space');
        if (empty($data['adSpace'])) {
            return redirect()->to(adminUrl("ad-spaces?ad_space=index_top"));
        }
        $model = new AdModel();
        $data['adCodes'] = $model->getAdCodes($data['adSpace']);
        
        if (empty($data['adCodes'])) {
            return redirect()->to(adminUrl("ad-spaces"));
        }
        $data["arrayAdSpaces"] = array(
            "index_top" => trans("index_top_ad_space"),
            "index_bottom" => trans("index_bottom_ad_space"),
            "post_top" => trans("post_top_ad_space"),
            "post_bottom" => trans("post_bottom_ad_space"),
            "category_top" => trans("category_top_ad_space"),
            "category_bottom" => trans("category_bottom_ad_space"),
            "tag_top" => trans("tag_top_ad_space"),
            "tag_bottom" => trans("tag_bottom_ad_space"),
            "search_top" => trans("search_top_ad_space"),
            "search_bottom" => trans("search_bottom_ad_space"),
            "profile_top" => trans("profile_top_ad_space"),
            "profile_bottom" => trans("profile_bottom_ad_space"),
            "reading_list_top" => trans("reading_list_top_ad_space"),
            "reading_list_bottom" => trans("reading_list_bottom_ad_space"),
            "sidebar_top" => trans("sidebar_top_ad_space"),
            "sidebar_bottom" => trans("sidebar_bottom_ad_space"),
        );

        echo view('admin/includes/_header', $data);
        echo view('admin/ad_spaces', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Ads Post
     */
    public function adSpacesPost()
    {
        preventAuthor();
        $adSpace = inputPost('ad_space');
        $model = new AdModel();
        if ($model->updateAdSpaces($adSpace)) {
            $this->session->setFlashdata('success', trans("ad_spaces") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl("ad-spaces?ad_space=" . $adSpace));
    }

    /**
     * Google Adsense Code Post
     */
    public function googleAdsenseCodePost()
    {
        preventAuthor();
        $model = new AdModel();
        if ($model->updateGoogleAdsenseCode()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Settings
     */
    public function settings()
    {
        preventAuthor();
        $data["settingsLangId"] = inputGet("lang", true);
        if (empty($data["settingsLangId"])) {
            $data["settingsLangId"] = $this->generalSettings->site_lang;
            return redirect()->to(adminUrl("settings?lang=" . $data["settingsLangId"]));
        }
        $data['title'] = trans("settings");
        
        $data['formSettings'] = $this->settingsModel->getSettings($data["settingsLangId"]);

        echo view('admin/includes/_header', $data);
        echo view('admin/settings', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Settings Post
     */
    public function settingsPost()
    {
        preventAuthor();
        if ($this->settingsModel->updateSettings()) {
            $this->settingsModel->updateGeneralSettings();
            $this->session->setFlashdata('success', trans("settings") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        $settings = $this->settingsModel->getGeneralSettings();
        if (!empty($settings)) {
            $lang = cleanNumber(inputPost('lang_id'));
            return redirect()->to(base_url($settings->admin_route . "/settings?lang=" . $lang));
        }
        return redirect()->back();
    }

    /**
     * Recaptcha Settings Post
     */
    public function recaptchaSettingsPost()
    {
        if ($this->settingsModel->updateRecaptchaSettings()) {
            $this->session->setFlashdata('success', trans("settings") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Maintenance Mode Post
     */
    public function maintenanceModePost()
    {
        if ($this->settingsModel->updateMaintenanceModeSettings()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Allowed File Extensions Post
     */
    public function allowedFileExtensionsPost()
    {
        if ($this->settingsModel->updateAllowedFileExtensions()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Seo Tools
     */
    public function seoTools()
    {
        preventAuthor();
        $data['title'] = trans("seo_tools");
        $data["toolsLang"] = inputGet('lang', true);
        if (empty($data["toolsLang"])) {
            $data["toolsLang"] = $this->generalSettings->site_lang;
            return redirect()->to(adminUrl("seo-tools?lang=" . $data["toolsLang"]));
        }
        
        $data['settingsTools'] = $this->settingsModel->getSettings($data["toolsLang"]);

        echo view('admin/includes/_header', $data);
        echo view('admin/seo_tools', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Seo Tools Post
     */
    public function seoToolsPost()
    {
        preventAuthor();
        if ($this->settingsModel->updateSeoSettings()) {
            $this->session->setFlashdata('success', trans("seo_options") . " " . trans("msg_suc_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Generate Sitemap Post
     */
    public function generateSitemapPost()
    {
        $sitemapModel = new SitemapModel();
        $sitemapModel->updateSitemapSettings();
        $sitemapModel->generateSitemap();
        $this->session->setFlashdata('success', trans("sitemap") . " " . trans("msg_suc_updated"));
        return redirect()->back();
    }

    /**
     * Delete Sitemap Post
     */
    public function deleteSitemapPost()
    {
        preventAuthor();
        $path = inputPost('path');
        if (file_exists($path)) {
            @unlink($path);
        }
        return redirect()->back();
    }

    /**
     * Social Login Settings
     */
    public function socialLoginSettings()
    {
        preventAuthor();
        $data['title'] = trans("social_login_settings");

        echo view('admin/includes/_header', $data);
        echo view('admin/social_login_settings', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Social Login Post
     */
    public function socialLoginSettingsPost()
    {
        $model = new SettingsModel();
        if ($model->editSocialSettings()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl('social-login-settings'));
    }

    /**
     * Cache System
     */
    public function cacheSystem()
    {
        preventAuthor();
        $data['title'] = trans("cache_system");
        
        echo view('admin/includes/_header', $data);
        echo view('admin/cache_system', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Cache System Post
     */
    public function cacheSystemPost()
    {
        $action = inputPost('action');
        if ($action == 'reset') {
            resetCacheData();
            $this->session->setFlashdata('success', trans("msg_reset_cache"));
        } else {
            if ($this->settingsModel->updateCacheSystem()) {
                $this->session->setFlashdata('success', trans("msg_updated"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        return redirect()->to(adminUrl('cache-system'));
    }

    /*
    * Email Settings
    */
    public function emailSettings()
    {
        preventAuthor();
        $data['title'] = trans("email_settings");
        $data["protocol"] = cleanSlug(inputGet('protocol'));
        
        if (empty($data["protocol"])) {
            $data['protocol'] = $this->generalSettings->mail_protocol;
            return redirect()->to((adminUrl('email-settings?protocol=' . $data["protocol"])));
            exit();
        }
        if ($data["protocol"] != "smtp" && $data["protocol"] != "mail") {
            $data['protocol'] = "smtp";
            return redirect()->to((adminUrl('email-settings?protocol=smtp')));
            exit();
        }
        echo view('admin/includes/_header', $data);
        echo view('admin/email_settings', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Email Settings Post
     */
    public function emailSettingsPost()
    {
        if ($this->settingsModel->updateEmailSettings()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Email Options Post
     */
    public function emailOptionsPost()
    {
        if ($this->settingsModel->updateEmailOptions()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Send Test Email Post
     */
    public function sendTestEmailPost()
    {
        $email = inputPost('email');
        $subject = "Infinite Test Email";
        $message = "<p>This is a test email.</p>";
        if (!empty($email)) {
            $emailModel = new EmailModel();
            if (!$emailModel->sendTestEmail($email, $subject, $message)) {
                $this->session->setFlashdata('error', trans("msg_error"));
            } else {
                $this->session->setFlashdata('success', trans("msg_email_sent"));
            }
        }
        return redirect()->back();
    }

    /**
     * -------------------------------------------------------------------------------------------
     * POLLS
     * -------------------------------------------------------------------------------------------
     */

    /**
     * Add Poll
     */
    public function addPoll()
    {
        preventAuthor();
        $data['title'] = trans("add_poll");
        
        echo view('admin/includes/_header', $data);
        echo view('admin/poll/add', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add Poll Post
     */
    public function addPollPost()
    {
        $val = \Config\Services::validation();
        $val->setRule('question', trans("question"), 'required');
        $val->setRule('option1', trans("option_1"), 'required');
        $val->setRule('option2', trans("option_2"), 'required');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $model = new PollModel();
            if ($model->addPoll()) {
                $this->session->setFlashdata('success', trans("poll") . " " . trans("msg_suc_added"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        return redirect()->back();
    }

    /**
     * Polls
     */
    public function polls()
    {
        preventAuthor();
        $data['title'] = trans("polls");
        $model = new PollModel();
        $data['polls'] = $model->getAllPolls();
        $data['langSearchColumn'] = 2;
        
        echo view('admin/includes/_header', $data);
        echo view('admin/poll/polls', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Edit Poll
     */
    public function editPoll($id)
    {
        preventAuthor();
        $data['title'] = trans("update_poll");
        $model = new PollModel();
        //find poll
        $data['poll'] = $model->getPoll($id);
        if (empty($data['poll'])) {
            return redirect()->back();
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/poll/update', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Edit Poll Post
     */
    public function editPollPost()
    {
        $val = \Config\Services::validation();
        $val->setRule('question', trans("question"), 'required');
        $val->setRule('option1', trans("option_1"), 'required');
        $val->setRule('option2', trans("option_2"), 'required');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $model = new PollModel();
            $id = inputPost('id');
            if ($model->editPoll($id)) {
                $this->session->setFlashdata('success', trans("poll") . " " . trans("msg_suc_updated"));
                return redirect()->to(adminUrl('polls'));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        return redirect()->back();
    }


    /**
     * Delete Poll Post
     */
    public function deletePollPost()
    {
        $id = inputPost('id');
        $model = new PollModel();
        if ($model->deletePoll($id)) {
            $this->session->setFlashdata('success', trans("poll") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }

    /**
     * -------------------------------------------------------------------------------------------
     * USERS
     * -------------------------------------------------------------------------------------------
     */

    /**
     * Users
     */
    public function users()
    {
        preventAuthor();
        $data['title'] = trans("users");
        $data['users'] = $this->authModel->getUsers();
        

        echo view('admin/includes/_header', $data);
        echo view('admin/users/users', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add User
     */
    public function addUser()
    {
        preventAuthor();
        $data['title'] = trans("add_user");
        

        echo view('admin/includes/_header', $data);
        echo view('admin/users/add_user');
        echo view('admin/includes/_footer');
    }

    /**
     * Add User Post
     */
    public function addUserPost()
    {
        $val = \Config\Services::validation();
        $val->setRule('username', trans("username"), 'required|min_length[4]|max_length[255]|is_unique[users.username]');
        $val->setRule('email', trans("email"), 'required|valid_email|max_length[255]|is_unique[users.email]');
        $val->setRule('password', trans("password"), 'required|min_length[4]|max_length[255]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            if ($this->authModel->addUser()) {
                $this->session->setFlashdata('success', trans("msg_user_added"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        return redirect()->back();
    }

    /**
     * Edit User
     */
    public function editUser($id)
    {
        preventAuthor();
        $data['title'] = trans("edit_user");
        $data['user'] = getUser($id);
        
        if (empty($data['user'])) {
            return redirect()->to(adminUrl('users'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/users/edit_user');
        echo view('admin/includes/_footer');
    }

    /**
     * Edit User Post
     */
    public function editUserPost()
    {
        preventAuthor();
        $val = \Config\Services::validation();
        $val->setRule('username', trans("username"), 'required|min_length[4]|max_length[255]');
        $val->setRule('email', trans("email"), 'required|valid_email|max_length[255]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back()->withInput();
        } else {
            $id = inputPost('id');
            $user = getUser($id);
            if (empty($user)) {
                return redirect()->back();
            }
            $data = [
                'email' => inputPost('email'),
                'username' => inputPost('username'),
                'slug' => inputPost('slug')
            ];
            //is email unique
            if (!$this->authModel->isUniqueEmail($data["email"], $user->id)) {
                $this->session->setFlashdata('error', trans("email_unique_error"));
                return redirect()->back();
            }
            //is username unique
            if (!$this->authModel->isUniqueUsername($data["username"], $user->id)) {
                $this->session->setFlashdata('error', trans("msg_username_unique_error"));
                return redirect()->back();
            }
            //is slug unique
            if (!$this->authModel->isSlugUnique($data["slug"], $user->id)) {
                $this->session->setFlashdata('error', trans("msg_slug_used"));
                return redirect()->back();
            }
            if ($this->authModel->editUser($id)) {
                $this->session->setFlashdata('success', trans("msg_updated"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        return redirect()->back();
    }

    /**
     * Change User Role
     */
    public function changeUserRolePost()
    {
        preventAuthor();
        $id = inputPost('user_id');
        $role = inputPost('role');
        $user = $this->authModel->getUser($id);
        if (empty($user)) {
            return redirect()->back();
        } else {
            if ($this->authModel->changeUserRole($id, $role)) {
                $this->session->setFlashdata('success', trans("msg_role_changed"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        return redirect()->back();
    }

    /**
     * User Options Post
     */
    public function userOptionsPost()
    {
        preventAuthor();
        $option = inputPost('option');
        $id = inputPost('id');
        if ($option == 'ban') {
            if ($this->authModel->banUser($id)) {
                $this->session->setFlashdata('success', trans("msg_user_banned"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        if ($option == 'remove_ban') {
            if ($this->authModel->removeUserBan($id)) {
                $this->session->setFlashdata('success', trans("msg_ban_removed"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
        return redirect()->back();
    }

    /**
     * Delete User Post
     */
    public function deleteUserPost()
    {
        preventAuthor();
        $id = inputPost('id');
        if ($this->authModel->deleteUser($id)) {
            $this->session->setFlashdata('success', trans("user") . " " . trans("msg_suc_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }

    /**
     * Newsletter
     */
    public function newsletter()
    {
        preventAuthor();
        $data['title'] = trans("newsletter");
        $model = new NewsletterModel();
        $data['subscribers'] = $model->getSubscribers();
        $data['users'] = $this->authModel->getUsers();
        
        //reset temp emails
        $model = new NewsletterModel();
        $model->resetTempEmails();

        echo view('admin/includes/_header', $data);
        echo view('admin/newsletter/newsletter', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Newsletter Post
     */
    public function newsletterPost()
    {
        preventAuthor();
        $emails = inputPost('email');
        if (empty($emails)) {
            $this->session->setFlashdata('error', trans("newsletter_email_error"));
            return redirect()->back();
        }
        $model = new NewsletterModel();
        $model->addTempEmails($emails);
        return redirect()->to(adminUrl('newsletter-send-email'));
    }

    /**
     * Send Email
     */
    public function newsletterSendEmail()
    {
        preventAuthor();
        $data['title'] = trans("newsletter");
        $data['emails'] = unserializeData($this->generalSettings->newsletter_temp_emails);
        if (empty($data['emails'])) {
            $this->session->setFlashdata('error', trans("newsletter_email_error"));
            return redirect()->to(adminUrl('newsletter'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/newsletter/send_email', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Send Email Post
     */
    public function newsletterSendEmailPost()
    {
        $model = new NewsletterModel();
        if (@$model->sendEmail()) {
            echo json_encode(['result' => 1]);
            exit();
        }
        echo json_encode(['result' => 0]);
    }

    /**
     * Newsletter Settings Post
     */
    public function newsletterSettingsPost()
    {
        preventAuthor();
        $model = new NewsletterModel();
        if ($model->updateSettings()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Delete Newsletter Post
     */
    public function deleteNewsletterPost()
    {
        preventAuthor();
        $id = inputPost('id');
        $model = new NewsletterModel();
        $data['newsletter'] = $model->getSubscriberById($id);
        if (empty($data['newsletter'])) {
            $this->session->setFlashdata('error', trans("msg_error"));
        } else {
            if ($model->deleteFromSubscribers($id)) {
                $this->session->setFlashdata('success', trans("email") . " " . trans("msg_suc_deleted"));
            } else {
                $this->session->setFlashdata('error', trans("msg_error"));
            }
        }
    }

    /**
     * Font Settings
     */
    public function fontSettings()
    {
        preventAuthor();
        $data["fontLangId"] = cleanNumber(inputGet('lang'));
        if (empty($data["fontLangId"]) || empty(getLanguageById($data["fontLangId"]))) {
            $data["fontLangId"] = $this->generalSettings->site_lang;
            return redirect()->to(adminUrl("font-settings?lang=" . $data["fontLangId"]));
        }

        $data['title'] = trans("font_settings");
        $data['fonts'] = $this->settingsModel->getFonts();
        
        $data['settings'] = $this->settingsModel->getSettings($data["fontLangId"]);

        echo view('admin/includes/_header', $data);
        echo view('admin/font/fonts', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Set Site Font Post
     */
    public function setSiteFontPost()
    {
        preventAuthor();
        if ($this->settingsModel->setDefaultFonts()) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        $langId = inputPost('lang_id');
        return redirect()->to(adminUrl('font-settings?lang=' . cleanNumber($langId)));
    }

    /**
     * Add Font Post
     */
    public function addFontPost()
    {
        if ($this->settingsModel->addFont()) {
            $this->session->setFlashdata('success', trans("msg_item_added"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Edit Font
     */
    public function editFont($id)
    {
        preventAuthor();
        $data['title'] = trans("update_font");
        $data['font'] = $this->settingsModel->getFont($id);
        
        if (empty($data['font'])) {
            return redirect()->back();
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/font/update', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Edit Font Post
     */
    public function editFontPost()
    {
        $id = inputPost('id');
        if ($this->settingsModel->editFont($id)) {
            $this->session->setFlashdata('success', trans("msg_updated"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
        return redirect()->to(adminUrl("font-settings?lang=" . $this->generalSettings->site_lang));
    }

    /**
     * Delete Font Post
     */
    public function deleteFontPost()
    {
        $id = inputPost('id');
        if ($this->settingsModel->deleteFont($id)) {
            $this->session->setFlashdata('success', trans("msg_deleted"));
        } else {
            $this->session->setFlashdata('error', trans("msg_error"));
        }
    }
}
