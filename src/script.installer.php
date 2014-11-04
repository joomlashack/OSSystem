<?php
/**
 * @package   OSSystem
 * @contact   www.alledia.com, support@alledia.com
 * @copyright 2014 Alledia.com, All rights reserved
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die();

require_once 'library/Installer/include.php';

use Alledia\Installer\AbstractScript;

/**
 * Custom installer script
 */
class PlgSystemOSSystemInstallerScript extends AbstractScript
{
    /**
     * Delete obsolete files, folders and extensions.
     * Files and folders are identified from the site
     * root path and should starts with a slash.
     */
    protected function clearObsolete()
    {
        // Fix the uninstall for the depracated plugin OSCARootCertificates
        if (! class_exists('AllediaInstallerAbstract')) {
            require_once __DIR__ . '/legacy/AllediaInstallerAbstract.php';
        }
    }
}
