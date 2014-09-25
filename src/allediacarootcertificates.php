<?php
/**
 * @package   AllediaCARootCertificates
 * @contact   www.ostraining.com, support@ostraining.com
 * @copyright 2013-2014 Open Source Training, LLC. All rights reserved
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

use Alledia\Joomla\Extension\AbstractPlugin;

defined('_JEXEC') or die();

require_once 'include.php';

/**
 * AllediaCARootCertificates System Plugin
 *
 */
class PlgSystemAllediaCARootCertificates extends AbstractPlugin
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
        $this->namespace = 'AllediaCARootCertificates';

        parent::__construct($subject, $config);
    }
}
