<?php declare(strict_types = 1);
/**
 * This file represents the "Cards" table instance.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  2018 {{author}}. All rights reserved.
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\Rolodex\Administrator\Table;

use Joomla\CMS\Table\Table;

/**
 * This class represents the "Cards" table in the database.
 */
class RolodexTableCards extends Table {
  /**
   * Supplement the default constructor to configure the database table.
   *
   * This method configures the name of the table and the name of the primary
   * key column for the table.
   *
   * @param  \JDatabaseDriver  $db  The database object instance to use for
   *                                the table.
   */
  public function __construct(&$db) {
    parent::__construct('#__{{name}}_cards', 'id', $db);
  }
}
