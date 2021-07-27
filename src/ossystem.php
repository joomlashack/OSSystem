<?php
/**
 * @package   OSSystem
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2016-2021 Joomlashack.com. All rights reserved
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 *
 * This file is part of OSSystem.
 *
 * OSSystem is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * OSSystem is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OSSystem.  If not, see <http://www.gnu.org/licenses/>.
 */

use Alledia\Framework\Joomla\Extension\AbstractPlugin;
use Joomla\CMS\Application\CMSApplication;

defined('_JEXEC') or die();

if (!include_once 'include.php') {
    return;
}

class PlgSystemOSSystem extends AbstractPlugin
{
    /**
     * @var CMSApplication
     */
    protected $app = null;

    /**
     * @inheritdoc
     */
    protected $namespace = 'OSSystem';

    /**
     * @return void
     * @throws Exception
     */
    public function onAfterRender()
    {
        $option    = $this->app->input->getCmd('option');
        $extension = $this->app->input->getCmd('extension', null);

        // Execute only in admin and in the com_categories component
        if ($this->app->isClient('administrator')
            && $option === 'com_categories'
            && $extension !== 'com_content'
            && !empty($extension)
        ) {
            $this->addCustomFooterIntoNativeComponentOutput($extension);
        }
    }

    protected function addCustomFooterIntoNativeComponentOutput($element)
    {
        // Check if the specified extension is from Alledia
        $extension = \Alledia\Framework\Joomla\Extension\Helper::getExtensionForElement($element);
        $footer    = $extension->getFooterMarkup();

        if (!empty($footer)) {
            $this->app->setBody(
                str_replace('</section>', '</section>' . $footer, $this->app->getBody())
            );
        }
    }
}
