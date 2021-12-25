<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use CodeIgniter\Config\DotEnv;
use Config\Autoload;
use Config\Modules;
use Config\Paths;
use Config\Services;

/*
 * ---------------------------------------------------------------
 * SETUP OUR PATH CONSTANTS
 * ---------------------------------------------------------------
 *
 * The path constants provide convenient access to the folders
 * throughout the application. We have to setup them up here
 * so they are available in the config files that are loaded.
 */

if (!file_exists(".env")) {
    echo "<b>.env</b> file does not exist on main directory of your site. You need to upload this file from the script files. 
    If you cannot see this file, make sure that you can see the hidden files on your server or on your computer.";
    exit();
}

if (!file_exists(".htaccess")) {
    echo "<b>.htaccess</b> file does not exist on main directory of your site. You need to upload this file from the script files. 
    If you cannot see this file, make sure that you can see the hidden files on your server or on your computer.";
    exit();
}

// The path to the application directory.
if (! defined('APPPATH')) {
    /**
     * @var Paths $paths
     */
    define('APPPATH', realpath(rtrim($paths->appDirectory, '\\/ ')) . DIRECTORY_SEPARATOR);
}

// The path to the project root directory. Just above APPPATH.
if (! defined('ROOTPATH')) {
    define('ROOTPATH', realpath(APPPATH . '../') . DIRECTORY_SEPARATOR);
}

// The path to the system directory.
if (! defined('SYSTEMPATH')) {
    /**
     * @var Paths $paths
     */
    define('SYSTEMPATH', realpath(rtrim($paths->systemDirectory, '\\/ ')) . DIRECTORY_SEPARATOR);
}

// The path to the writable directory.
if (! defined('WRITEPATH')) {
    /**
     * @var Paths $paths
     */
    define('WRITEPATH', realpath(rtrim($paths->writableDirectory, '\\/ ')) . DIRECTORY_SEPARATOR);
}

$rootURL = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
$rootURL .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
require APPPATH . 'ThirdParty/domain-parser/autoload.php';
$result = tld_extract($rootURL);
$mainDomain = "";
if (!empty($result)) {
    if (isset($result["hostname"]) && isset($result["suffix"])) {
        $mainDomain = $result["hostname"];
        if (!empty($result["suffix"])) {
            $mainDomain .= "." . $result["suffix"];
        }
    }
}
defined('INF_DOMAIN') || define('INF_DOMAIN', $mainDomain);

// The path to the tests directory
if (! defined('TESTPATH')) {
    /**
     * @var Paths $paths
     */
    define('TESTPATH', realpath(rtrim($paths->testsDirectory, '\\/ ')) . DIRECTORY_SEPARATOR);
}

/*
 * ---------------------------------------------------------------
 * GRAB OUR CONSTANTS & COMMON
 * ---------------------------------------------------------------
 */
if (! defined('APP_NAMESPACE')) {
    require_once APPPATH . 'Config/Constants.php';
}

// Require app/Common.php file if exists.
if (is_file(APPPATH . 'Common.php')) {
    require_once APPPATH . 'Common.php';
}

// Require system/Common.php
require_once SYSTEMPATH . 'Common.php';

/*
 * ---------------------------------------------------------------
 * LOAD OUR AUTOLOADER
 * ---------------------------------------------------------------
 *
 * The autoloader allows all of the pieces to work together in the
 * framework. We have to load it here, though, so that the config
 * files can use the path constants.
 */

if (! class_exists('Config\Autoload', false)) {
    require_once SYSTEMPATH . 'Config/AutoloadConfig.php';
    require_once APPPATH . 'Config/Autoload.php';
    require_once SYSTEMPATH . 'Modules/Modules.php';
    require_once APPPATH . 'Config/Modules.php';
}

require_once SYSTEMPATH . 'Autoloader/Autoloader.php';
require_once SYSTEMPATH . 'Config/BaseService.php';
require_once SYSTEMPATH . 'Config/Services.php';
require_once APPPATH . 'Config/Services.php';

// Use Config\Services as CodeIgniter\Services
if (! class_exists('CodeIgniter\Services', false)) {
    class_alias('Config\Services', 'CodeIgniter\Services');
}

// Initialize and register the loader with the SPL autoloader stack.
Services::autoloader()->initialize(new Autoload(), new Modules())->register();

// Now load Composer's if it's available
if (is_file(COMPOSER_PATH)) {
    /*
     * The path to the vendor directory.
     *
     * We do not want to enforce this, so set the constant if Composer was used.
     */
    if (! defined('VENDORPATH')) {
        define('VENDORPATH', realpath(ROOTPATH . 'vendor') . DIRECTORY_SEPARATOR);
    }

    require_once COMPOSER_PATH;
}

// Load environment settings from .env files into $_SERVER and $_ENV
require_once SYSTEMPATH . 'Config/DotEnv.php';

$env = new DotEnv(ROOTPATH);
$env->load();

// Always load the URL helper, it should be used in most of apps.
helper('url');

/*
 * ---------------------------------------------------------------
 * GRAB OUR CODEIGNITER INSTANCE
 * ---------------------------------------------------------------
 *
 * The CodeIgniter class contains the core functionality to make
 * the application run, and does all of the dirty work to get
 * the pieces all working together.
 */

$app = Services::codeigniter();
$app->initialize();

return $app;
