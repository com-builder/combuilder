<?php declare(strict_types = 1);
/**
 * This file contains the layout and supporting logic for the component's
 * "{{Item}}" view and is used exclusively by the `View{{Item}}` class.
 *
 * @author         {{author}} <{{email}}>
 * @copyright    {{copyright}}
 * @license        GNU General Public License v3 (GPL-3.0).
 */

// Prevent direct access to this file according to Joomla! best practices
defined('_JEXEC') or exit;

use Joomla\CMS\Toolbar\ToolbarHelper as Toolbar;
use Joomla\CMS\HTML\HTMLHelper as HTML;
use Joomla\CMS\Language\Text;

/**
 * Perform layout-specific functionality in an IIFE.
 *
 * This function adds "Save as Copy" and "Close" buttons to the toolbar and sets
 * the page title.
 */
(function() {
    // Add a "Save to Copy" button to facilitate easy duplication
    Toolbar::save2copy('{{item}}.save2copy');
    // Add a "Cancel" button to exit the edit page
    Toolbar::cancel('{{item}}.cancel', 'JTOOLBAR_CLOSE');
    // Set the title of the edit page
    Toolbar::title(Text::_('COM_{{NAME}}_VIEW_{{ITEM}}_UPDATE'));
})();
?>
<form method='POST' name='adminForm' id='adminForm'>
    <fieldset class='adminform form-horizontal'>
        <legend>
            <?= Text::_('COM_{{NAME}}_VIEW_{{ITEM}}_DETAILS') ?>
        </legend>
        <div class='row-fluid'>
            <div class='span6'>
                <?= $this->form->renderFieldset('default') ?>
            </div>
        </div>
    </fieldset>
    <input type='hidden' name='id' value='<?= $this->escape($this->{{item}}->id) ?>'/>
    <input type='hidden' name='task' value='{{item}}s.display'/>
    <input type='hidden' name='view' value='{{item}}s'/>
    <?= HTML::_('form.token') ?>
</form>
