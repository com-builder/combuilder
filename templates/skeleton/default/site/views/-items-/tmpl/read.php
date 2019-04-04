<?php declare(strict_types = 1);
/**
 * This file contains the layout and supporting logic for the component's
 * "Items" view and is used exclusively by the `ViewItems` class.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// Prevent direct access to this file according to Joomla! best practices
defined('_JEXEC') or exit;

use Joomla\CMS\Language\Text;
?>
<form method='POST' id='adminForm' name='adminForm'>
    <?php if (count($this->{{item}}s) > 0) { ?>
        <table class='table table-striped table-hover'>
            <thead>
                <tr>
                    <th>
                        <?= $this->escape(Text::_('COM_{{NAME}}_{{ITEM}}_COL_NAME')) ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->{{item}}s as $i => $row) { ?>
                    <tr>
                        <td>
                            <a href="<?= $this->get{{Item}}ViewLink($row) ?>">
                                <?= $this->escape($row->name) ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='1'>
                        <div style='float: left'>
                            <?= $this->pagination->getListFooter() ?>
                        </div>
                        <div class='pagination' style='float: right'>
                            <?= $this->pagination->getLimitBox() ?>
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
</form>
