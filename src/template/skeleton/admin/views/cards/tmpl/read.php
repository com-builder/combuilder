<?php declare(strict_types = 1);
/**
 * This file contains the layout and supporting logic for the component's
 * "Cards" view and is used exclusively by the `ViewCards` class.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  2018 {{author}}. All rights reserved.
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
  $deleteMsg = Text::_('COM_{{NAME}}_VIEW_CARDS_DELETE_CONFIRM');
  $title     = Text::_('COM_{{NAME}}_VIEW_CARDS_READ');
  // Add a "New" button to create a new "Card"
  Toolbar::addNew('card.add');
  // Add a "Publish" button to publish one or more "Card"
  Toolbar::publishList('cards.publish');
  // Add an "Unpublish" button to unpublish one or more "Card"
  Toolbar::unpublishList('cards.unpublish');
  // Add an "Check-in" button to unpublish one or more "Card"
  Toolbar::checkin('cards.checkin');
  // Determine whether the trash or delete button should be shown
  if (intval($view->activeFilters['published'] ?? '') !== -2) {
    // Add a "Trash" button to move one or more "Card" to the trash
    Toolbar::trash('cards.trash');
  } else {
    // Add a "Delete" button to delete one or more "Card"
    Toolbar::deleteList($deleteMsg, 'cards.delete');
  }
  // Set the title of the page
  Toolbar::title($title);
})($this);
?>
<?= HTML::_('formbehavior.chosen', 'select') ?>
<form method='POST' id='adminForm' name='adminForm'>
  <div class="row-fluid">
    <?= Layout::render('joomla.searchtools.default', ['view' => $this]) ?>
  </div>
  <?php if (count($this->cards) > 0) { ?>
    <table class='table table-striped table-hover'>
      <thead>
        <tr>
          <th width='1%'>
            <?= HTML::_('grid.checkall') ?>
          </th>
          <th width='4%'>
            <?= $this->escape(Text::_('COM_{{NAME}}_CARD_COL_PUBLISHED')) ?>
          </th>
          <th>
            <?= HTML::_('grid.sort', 'COM_{{NAME}}_CARD_COL_NAME',
              'cards.name', $listDir, $listOrder) ?>
          </th>
          <th width='16%' style='text-align: right;'>
            <?= HTML::_('grid.sort', 'COM_{{NAME}}_CARD_COL_ID',
              'cards.id', $listDir, $listOrder) ?>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $userID = intval(Factory::getUser()->id); ?>
        <?php foreach ($this->cards as $i => $row) { ?>
          <?php $row->checkedOut = intval($row->checkedOut); ?>
          <tr>
            <td>
              <?= HTML::_('grid.id', $i, $row->id) ?>
            </td>
            <td style='text-align: right;'>
              <?= HTML::_('jgrid.published', $row->published, $i,
                          'cards.', TRUE, 'cb') ?>
            </td>
            <td>
              <?php if ($row->checkedOut > 0) { ?>
                <?= HTML::_('jgrid.checkedout', $i, $row->editor,
                            $row->checkedOutTime, 'cards.',
                            $userID === $row->checkedOut) ?>
              <?php } ?>
              <a href="<?= $this->getCardUpdateLink($row) ?>">
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
      <?= $this->escape(Text::_('COM_{{NAME}}_VIEW_CARDS_NONE')) ?>
    </div>
  <?php } ?>
  <input type='hidden' name='boxchecked' value='0'/>
  <input type='hidden' name='task' value='cards.display'/>
  <input type='hidden' name='view' value='cards'/>
  <input type='hidden' name='filter_order' value='<?= $listOrder ?>'/>
  <input type='hidden' name='filter_order_Dir' value='<?= $listDirn ?>'/>
  <?= HTML::_('form.token') ?>
</form>
