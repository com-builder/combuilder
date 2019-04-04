<?php declare(strict_types = 1);
/**
 * This file contains the layout and supporting logic for the component's
 * "{{Item}}" view and is used exclusively by the `View{{Item}}` class.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// Prevent direct access to this file according to Joomla! best practices
defined('_JEXEC') or exit;

use Joomla\CMS\Toolbar\ToolbarHelper as Toolbar;
use Joomla\CMS\HTML\HTMLHelper as HTML;
use Joomla\CMS\Language\Text;

/**
 * Perform layout-specific functionality in an IIFE.
 *
 * This function adds a "Cancel" button to the toolbar and sets the page title.
 */
(function()
{
    // Add a "Cancel" button to exit the new "{{Item}}" page
    Toolbar::cancel('{{item}}.cancel');
    // Set the title of the new "{{Item}}" page
    Toolbar::title(Text::_('COM_{{NAME}}_VIEW_{{ITEM}}_CREATE'));
})();
?>
<form method='POST' name='adminForm' id='adminForm'>
    <fieldset class='adminform form-horizontal'>
        <legend>
            <?= $this->escape(Text::_('COM_{{NAME}}_VIEW_{{ITEM}}_DETAILS')) ?>
        </legend>
        <div class='row-fluid'>
            <div class='span6'>
                <?= $this->form->renderFieldset('default') ?>
            </div>
        </div>
    </fieldset>
    <input type='hidden' name='task' value='{{item}}s.display'/>
    <input type='hidden' name='view' value='{{item}}s'/>
    <?= HTML::_('form.token') ?>
</form>
