<?php declare(strict_types = 1);

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLHelper as HTML;
use Joomla\CMS\Language\Text;

/**
 * This file serves as the component's helper for common functionality.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * {{Name}}component helper.
 */
abstract class {{Name}}Helper extends ContentHelper {

	/**
	 * Configure the Sidebar Menu.
	 *
	 * @param string  $submenu  The name of the active view
	 *
	 * @return boid
	 */

	public static function addSubmenu($submenu) {
		HTML::_('sidebar.addEntry',
	  	Text::_('COM_{{NAME}}_SUBMENU_{{ITEM}}S'),
			'index.php?option=com_{{name}}&view={{item}}s',
			$submenu == '{{item}}s'
		);
	}
}