<?php
/**
 * @package   OSCARootCertificates
 * @contact   www.alledia.com, hello@alledia.com
 * @copyright 2014 Alledia.com, All rights reserved
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

use Alledia\Joomla\Extension\AbstractPlugin;

defined('_JEXEC') or die();

require_once 'include.php';

/**
 * OSCARootCertificates System Plugin
 *
 */
class PlgSystemOSCARootCertificates extends AbstractPlugin
{
    /**
     * Class constructor that instantiate the pro library, if installed
     *
     * @param   object  &$subject  The object to observe
     * @param   array   $config    An optional associative array of configuration settings.
     *                             Recognized key values include 'name', 'group', 'params', 'language'
     *                             (this list is not meant to be comprehensive).
     */
    public function __construct(&$subject, $config = array())
    {
        $this->namespace = 'OSCARootCertificates';

        parent::__construct($subject, $config);
    }

    /**
     * This method detects when Joomla is looking for updates and
     * check if the Joomla CA Roots Certificates file need to be
     * updated to accept the SSL certificate from our deployment
     * server.
     *
     * @return void
     */
    public function onAfterRoute()
    {
        $app    = JFactory::getApplication();
        $option = $app->input->getCmd('option');
        $view   = $app->input->getCmd('view');
        $task = $app->input->getCmd('task');

        // Filter the request, to only trigger when the user is looking for an update
        if ($app->getName() != 'administrator'
            || $option !== 'com_installer'
            || $view !== 'update'
            || $task !== 'update.find') {

            return;
        }

        OSCARootCertificatesHelper::checkAndUpdateCARootFile();
    }
}
