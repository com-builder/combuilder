<?php declare(strict_types = 1);
/**
 * This file contains the layout and supporting logic for the component's
 * "{{Item}}s" view and is used exclusively by the `View{{Item}}s` class.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// Prevent direct access to this file according to Joomla! best practices
defined('_JEXEC') or exit;

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper as Layout;
use Joomla\CMS\Toolbar\ToolbarHelper as Toolbar;
use Joomla\CMS\HTML\HTMLHelper as HTML;
use Joomla\CMS\Language\Text;

// Fetch and escape the ordering column and direction
$listOrder = $this->escape($this->filterOrder);
$listDir   = $this->escape($this->filterOrderDir);

/**
 * Prepare the toolbar for use in this view using an IIFE.
 *
 * This function adds "New", "Publish", "Unpublish", "Check-in" and "Trash" (or
 * "Delete") buttons to the toolbar and sets the page title.
 */
(function($view) {
  // Fetch applicable language translations for the toolbar configuration
  $deleteMsg = Text::_('COM_{{NAME}}_VIEW_{{ITEM}}S_DELETE_CONFIRM');
  $title     = Text::_('COM_{{NAME}}_VIEW_{{ITEM}}S_READ');
  // Add a "New" button to create a new "{{Item}}"
  Toolbar::addNew('{{item}}.add');
  // Add a "Publish" button to publish one or more "{{Item}}"
  Toolbar::publishList('{{item}}s.publish');
  // Add an "Unpublish" button to unpublish one or more "{{Item}}"
  Toolbar::unpublishList('{{item}}s.unpublish');
  // Add an "Check-in" button to unpublish one or more "{{Item}}"
  Toolbar::checkin('{{item}}s.checkin');
  // Determine whether the trash or delete button should be shown
  if (intval($view->activeFilters['published'] ?? '') !== -2) {
    // Add a "Trash" button to move one or more "{{Item}}" to the trash
    Toolbar::trash('{{item}}s.trash');
  } else {
    // Add a "Delete" button to delete one or more "{{Item}}"
    Toolbar::deleteList($deleteMsg, '{{item}}s.delete');
  }
  // Set the title of the page
  Toolbar::title($title);
})($this);
?>
<div id="j-sidebar-container" class="span2">
  <?= HTML::_('sidebar.render') ?>
</div>
<div id="j-main-container" class="span10">
  <?= HTML::_('formbehavior.chosen', 'select') ?>
  <form method='POST' id='adminForm' name='adminForm'>
    <div class="row-fluid">
      <?= Layout::render('joomla.searchtools.default', ['view' => $this]) ?>
    </div>
    <?php if (count($this->{{item}}s) > 0) { ?>
      <table class='table table-striped table-hover'>
        <thead>
          <tr>
            <th width='1%'>
              <?= HTML::_('grid.checkall') ?>
            </th>
            <th width='4%'>
              <?= $this->escape(Text::_('COM_{{NAME}}_{{ITEM}}_COL_PUBLISHED')) ?>
            </th>
            <th>
              <?= HTML::_('grid.sort', 'COM_{{NAME}}_{{ITEM}}_COL_NAME',
                '{{item}}s.name', $listDir, $listOrder) ?>
            </th>
            <th width='16%' style='text-align: right;'>
              <?= HTML::_('grid.sort', 'COM_{{NAME}}_{{ITEM}}_COL_ID',
                '{{item}}s.id', $listDir, $listOrder) ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php $userID = intval(Factory::getUser()->id); ?>
          <?php foreach ($this->{{item}}s as $i => $row) { ?>
            <?php $row->checkedOut = intval($row->checkedOut); ?>
            <tr>
              <td>
                <?= HTML::_('grid.id', $i, $row->id) ?>
              </td>
              <td style='text-align: right;'>
                <?= HTML::_('jgrid.published', $row->published, $i,
                            '{{item}}s.', TRUE, 'cb') ?>
              </td>
              <td>
                <?php if ($row->checkedOut > 0) { ?>
                  <?= HTML::_('jgrid.checkedout', $i, $row->editor,
                              $row->checkedOutTime, '{{item}}s.',
                              $userID === $row->checkedOut) ?>
                <?php } ?>
                <a href="<?= $this->get{{Item}}UpdateLink($row) ?>">
                  <?= $this->escape($row->name) ?>
                </a>
              </td>
              <td style='text-align: right;'>
                <?= $this->escape($row->id) ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan='4'>
              <div style='float: left'>
                <?= $this->pagination->getListFooter() ?>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>
    <?php } else { ?>
      <div class='alert alert-no-items'>
        <?= $this->escape(Text::_('COM_{{NAME}}_VIEW_{{ITEM}}S_NONE')) ?>
      </div>
    <?php } ?>
    <input type='hidden' name='boxchecked' value='0'/>
    <input type='hidden' name='task' value='{{item}}s.display'/>
    <input type='hidden' name='view' value='{{item}}s'/>
    <input type='hidden' name='filter_order' value='<?= $listOrder ?>'/>
    <input type='hidden' name='filter_order_Dir' value='<?= $listDirn ?>'/>
    <?= HTML::_('form.token') ?>
  </form>
</div>
