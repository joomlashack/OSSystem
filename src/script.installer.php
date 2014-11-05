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
     * @param string                     $type
     * @param JInstallerAdapterComponent $parent
     *
     * @return bool
     */
    public function preFlight($type, $parent)
    {
        parent::preFlight($type, $parent);

        /* Uninstall the depracated plugin OSCARootCertificates.
         * The parent method can't be used because the old plugin
         * has a bug that doesn't allow to use the native uninstall method.
         */
        jimport('joomla.filesystem.folder');

        $success = false;

        $path = JPATH_SITE . '/plugins/system/oscarootcertificates';
        if (JFolder::exists($path)) {
            $success = JFolder::delete($path);
        }

        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->delete('#__extensions')
            ->where($db->qn('type') . ' = ' . $db->q('plugin'))
            ->where($db->qn('element') . ' = ' . $db->q('oscarootcertificates'))
            ->where($db->qn('folder') . ' = ' . $db->q('system'));
        $db->setQuery($query);
        $success = $db->execute();

        if ((bool) $success) {
            $this->setMessage('Uninstalling system plugin OSCARootCertificates was successful');
        }

        return true;
    }
}
