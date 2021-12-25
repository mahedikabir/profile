<?php namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('users');
        $this->builderFollowers = $this->db->table('followers');
    }

    //input values
    public function inputValues()
    {
        return [
            'username' => inputPost('username', true),
            'email' => inputPost('email', true),
            'password' => inputPost('password')
        ];
    }

    //login
    public function login()
    {
        $data = $this->inputValues();
        $user = $this->getUserByUsername($data['username']);
        if (empty($user)) {
            $user = $this->getUserByEmail($data['username']);
        }
        if (!empty($user)) {
            if (!password_verify($data['password'], $user->password)) {
                return false;
            }
            if ($user->status == 0) {
                return "banned";
            }
            if ($user->role != "admin" && $user->role != "author" && $this->generalSettings->registration_system != 1) {
                return false;
            }
            //login user
            $this->loginUser($user);
            return "success";
        } else {
            return false;
        }
    }

    //login with facebook
    public function loginWithFacebook($fbUser)
    {
        if (!empty($fbUser)) {
            $user = $this->getUserByEmail($fbUser->email);
            //check if user registered
            if (empty($user)) {
                if (empty($fbUser->name)) {
                    $fbUser->name = "user-" . uniqid();
                }
                $username = $this->generateUniqeUsername($fbUser->name);
                $slug = $this->generateUniqeSlug($username);
                //add user to database
                $data = array(
                    'facebook_id' => $fbUser->id,
                    'email' => $fbUser->email,
                    'token' => generateToken(),
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => "https://graph.facebook.com/" . $fbUser->id . "/picture?type=large",
                    'user_type' => "facebook",
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($data['email'])) {
                    $this->builder->insert($data);
                    $user = $this->getUserByEmail($fbUser->email);
                    $this->loginUser($user);
                }
            } else {
                //login
                $this->loginUser($user);
            }
        }
    }

    //login with google
    public function loginWithGoogle($gUser)
    {
        if (!empty($gUser)) {
            $user = $this->getUserByEmail($gUser->email);
            //check if user registered
            if (empty($user)) {
                if (empty($gUser->name)) {
                    $gUser->name = "user-" . uniqid();
                }
                $username = $this->generateUniqeUsername($gUser->name);
                $slug = $this->generateUniqeSlug($username);
                //add user to database
                $data = array(
                    'google_id' => $gUser->id,
                    'email' => $gUser->email,
                    'token' => generateToken(),
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => $gUser->avatar,
                    'user_type' => "google",
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($data['email'])) {
                    $this->builder->insert($data);
                    $user = $this->getUserByEmail($gUser->email);
                    $this->loginUser($user);
                }
            } else {
                //login
                $this->loginUser($user);
            }
        }
    }

    //login user
    public function loginUser($user)
    {
        if (!empty($user)) {
            $userData = array(
                'inf_ses_id' => $user->id,
                'inf_ses_role' => $user->role,
                'inf_ses_pass' => md5($user->password)
            );
            $this->session->set($userData);
        }
    }

    //register
    public function register()
    {
        $data = $this->inputValues();
        $data['username'] = str_replace('@', '', $data['username']);
        $data['role'] = 'user';
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['slug'] = $this->generateUniqeSlug($data["username"]);
        $data['token'] = generateToken();
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data["created_at"] = date('Y-m-d H:i:s');
        if ($this->builder->insert($data)) {
            $id = $this->db->insertID();
            $user = $this->getUser($id);
            if (!empty($user)) {
                $this->loginUser($user);
            }
            return true;
        }
        return false;
    }

    //add user
    public function addUser()
    {
        $data = $this->inputValues();
        $data['username'] = str_replace('@', '', $data['username']);
        $data['role'] = inputPost('role');
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['slug'] = $this->generateUniqeSlug($data["username"]);
        $data['token'] = generateToken();
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data["created_at"] = date('Y-m-d H:i:s');
        return $this->builder->insert($data);
    }

    //generate uniqe username
    public function generateUniqeUsername($username)
    {
        $newUsername = $username;
        if (!empty($this->getUserByUsername($newUsername))) {
            $newUsername = $username . " 1";
            if (!empty($this->getUserByUsername($newUsername))) {
                $newUsername = $username . " 2";
                if (!empty($this->getUserByUsername($newUsername))) {
                    $newUsername = $username . " 3";
                    if (!empty($this->getUserByUsername($newUsername))) {
                        $newUsername = $username . "-" . uniqid();
                    }
                }
            }
        }
        return $newUsername;
    }

    //generate uniqe slug
    public function generateUniqeSlug($username)
    {
        $slug = strSlug($username);
        if (!empty($this->getUserBySlug($slug))) {
            $slug = strSlug($username . "-1");
            if (!empty($this->getUserBySlug($slug))) {
                $slug = strSlug($username . "-2");
                if (!empty($this->getUserBySlug($slug))) {
                    $slug = strSlug($username . "-3");
                    if (!empty($this->getUserBySlug($slug))) {
                        $slug = strSlug($username . "-" . uniqid());
                    }
                }
            }
        }
        return $slug;
    }

    //logout
    public function logout()
    {
        $this->session->remove('inf_ses_id');
        $this->session->remove('inf_ses_role');
        $this->session->remove('inf_ses_pass');
    }

    //reset password
    public function resetPassword($token)
    {
        $user = $this->getUserByToken($token);
        if (!empty($user)) {
            $data = [
                'password' => password_hash(inputPost('password'), PASSWORD_DEFAULT),
                'token' => generateToken()
            ];
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }

    //change user role
    public function changeUserRole($id, $role)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            return $this->builder->where('id', $user->id)->update(['role' => $role]);
        }
        return false;
    }

    //delete user
    public function deleteUser($id)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            return $this->builder->where('id', $user->id)->delete();
        }
        return false;
    }

    //ban user
    public function banUser($id)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            return $this->builder->where('id', $user->id)->update(['status' => 0]);
        }
        return false;
    }

    //remove user ban
    public function removeUserBan($id)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            return $this->builder->where('id', $user->id)->update(['status' => 1]);
        }
        return false;
    }

    //is logged in
    public function isLoggedIn()
    {
        if (!empty($this->session->get('inf_ses_id')) && !empty($this->session->get('inf_ses_role')) && !empty($this->session->get('inf_ses_pass'))) {
            return true;
        }
    }

    //get logged in user
    public function getLoggedInUser()
    {
        if ($this->isLoggedIn()) {
            $user = $this->getUser($this->session->get('inf_ses_id'));
            if (!empty($user) && md5($user->password) == $this->session->get('inf_ses_pass')) {
                return $user;
            }
        }
        return false;
    }

    //is admin
    public function isAdmin()
    {
        if ($this->isLoggedIn()) {
            if ($this->session->get('inf_ses_role') == 'admin') {
                return true;
            }
        }
        return false;
    }

    //is author
    public function isAuthor()
    {
        if ($this->isLoggedIn()) {
            if ($this->session->get('inf_ses_role') == 'author') {
                return true;
            }
        }
        return false;
    }

    //get user by id
    public function getUser($id)
    {
        return $this->builder->where('id', cleanNumber($id))->get()->getRow();
    }

    //get user by slug
    public function getUserBySlug($slug)
    {
        return $this->builder->where('slug', removeSpecialCharacters($slug))->get()->getRow();
    }

    //get user by username
    public function getUserByUsername($username)
    {
        return $this->builder->where('username', removeForbiddenCharacters($username))->get()->getRow();
    }

    //get user by email
    public function getUserByEmail($email)
    {
        return $this->builder->where('email', removeForbiddenCharacters($email))->get()->getRow();
    }

    //get user by token
    public function getUserByToken($token)
    {
        return $this->builder->where('token', removeForbiddenCharacters($token))->get()->getRow();
    }

    //get users
    public function getUsers()
    {
        return $this->builder->get()->getResult();
    }

    //get authors
    public function getAuthors()
    {
        return $this->builder->where('role !=', 'user')->get()->getResult();
    }

    //get last added users
    public function getLastAddedUsers()
    {
        return $this->builder->orderBy('users.id', 'DESC')->limit(7)->get()->getResult();
    }

    //user count
    public function getUserCount()
    {
        return $this->builder->countAllResults();
    }


    //check if email is unique
    public function isUniqueEmail($email, $userId = 0)
    {
        $user = $this->getUserByEmail($email);
        if ($userId == 0) {
            if (!empty($user)) {
                return false;
            }
            return true;
        } else {
            if (!empty($user) && $user->id != $userId) {
                return false;
            }
            return true;
        }
    }

    //check if username is unique
    public function isUniqueUsername($username, $userId = 0)
    {
        $user = $this->getUserByUsername($username);
        if ($userId == 0) {
            if (!empty($user)) {
                return false;
            }
            return true;
        } else {
            if (!empty($user) && $user->id != $userId) {
                return false;
            }
            return true;
        }
    }

    //check if slug is unique
    public function isSlugUnique($slug, $id)
    {
        $user = $this->builder->where('slug', removeSpecialCharacters($slug))->where('id != ', cleanNumber($id))->get()->getRow();
        if (empty($user)) {
            return true;
        }
        return false;
    }

    //update last seen time
    public function updateLastSeen()
    {
        if (authCheck()) {
            $this->builder->where('id', $this->authUser->id)->update(['last_seen' => date('Y-m-d H:i:s')]);
        }
    }

    /**
     * --------------------------------------------------------------------
     * Profile
     * --------------------------------------------------------------------
     */

    //get following users
    public function getFollowingUsers($followerId)
    {
        $this->builderFollowers->join('users', 'followers.following_id = users.id')->select('users.*');
        return $this->builderFollowers->where('follower_id', cleanNumber($followerId))->get()->getResult();
    }

    //get followers
    public function getFollowers($followingId)
    {
        $this->builderFollowers->join('users', 'followers.follower_id = users.id')->select('users.*');
        return $this->builderFollowers->where('following_id', cleanNumber($followingId))->get()->getResult();
    }

    //get follow
    public function getFollow($followingId, $followerId)
    {
        return $this->builderFollowers->where('following_id', cleanNumber($followingId))->where('follower_id', cleanNumber($followerId))->get()->getRow();
    }

    //is user follows
    public function isUserFollows($followingId, $followerId)
    {
        $follow = $this->getFollow($followingId, $followerId);
        if (!empty($follow)) {
            return true;
        }
        return false;
    }

    //follow user
    public function followUnfollowUser()
    {
        $data = [
            'following_id' => inputPost('following_id'),
            'follower_id' => user()->id
        ];
        $follow = $this->getFollow($data["following_id"], $data["follower_id"]);
        if (empty($follow)) {
            $this->builderFollowers->insert($data);
        } else {
            $this->builderFollowers->where('id', $follow->id)->delete();
        }
    }

    //update profile
    public function updateProfile($data, $user)
    {
        if (!empty($user)) {
            $model = new UploadModel();
            $tempPath = $model->uploadTempImage('file');
            if (!empty($tempPath) && !empty($tempPath['path'])) {
                $data["avatar"] = $model->uploadAvatar($user->id, $tempPath['path']);
                $model->deleteTempFile($tempPath['path']);
                deleteFileFromServer($user->avatar);
            }
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }

    //update update social accounts
    public function updateSocialAccounts()
    {
        $user = user();
        if (!empty($user)) {
            $data = [
                'facebook_url' => addHttpsToUrl(inputPost('facebook_url')),
                'twitter_url' => addHttpsToUrl(inputPost('twitter_url')),
                'instagram_url' => addHttpsToUrl(inputPost('instagram_url')),
                'pinterest_url' => addHttpsToUrl(inputPost('pinterest_url')),
                'linkedin_url' => addHttpsToUrl(inputPost('linkedin_url')),
                'vk_url' => addHttpsToUrl(inputPost('vk_url')),
                'telegram_url' => addHttpsToUrl(inputPost('telegram_url')),
                'youtube_url' => addHttpsToUrl(inputPost('youtube_url'))
            ];
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }

    //edit user
    public function editUser($id)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            $data = [
                'email' => inputPost('email'),
                'username' => inputPost('username', true),
                'slug' => inputPost('slug', true),
                'about_me' => inputPost('about_me'),
                'facebook_url' => addHttpsToUrl(inputPost('facebook_url')),
                'twitter_url' => addHttpsToUrl(inputPost('twitter_url')),
                'instagram_url' => addHttpsToUrl(inputPost('instagram_url')),
                'pinterest_url' => addHttpsToUrl(inputPost('pinterest_url')),
                'linkedin_url' => addHttpsToUrl(inputPost('linkedin_url')),
                'vk_url' => addHttpsToUrl(inputPost('vk_url')),
                'telegram_url' => addHttpsToUrl(inputPost('telegram_url')),
                'youtube_url' => addHttpsToUrl(inputPost('youtube_url'))
            ];
            $model = new UploadModel();
            $tempPath = $model->uploadTempImage('file');
            if (!empty($tempPath) && !empty($tempPath['path'])) {
                $data["avatar"] = $model->uploadAvatar($user->id, $tempPath['path']);
                $model->deleteTempFile($tempPath['path']);
                deleteFileFromServer($user->avatar);
            }
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }

    //change password
    public function changePassword()
    {
        $data = [
            'old_password' => inputPost('old_password'),
            'password' => inputPost('password'),
            'password_confirm' => inputPost('password_confirm')
        ];
        $user = user();
        if (!empty($user)) {
            if (inputPost('is_pass_exist') == 1) {
                if (!password_verify($data['old_password'], $user->password)) {
                    $this->session->setFlashdata('error', trans("wrong_password_error"));
                    return redirect()->back()->withInput();
                }
            }
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            if ($this->builder->where('id', $user->id)->update(['password' => $password])) {
                $this->session->set('inf_ses_pass', md5($password));
                return true;
            }
        }
        return false;
    }
}
