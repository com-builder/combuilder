<?php declare(strict_types = 1);
/**
 * This file represents the "{{Item}}s" table instance.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\Table;

use Joomla\CMS\Table\Table;

/**
 * This class represents the "{{Item}}s" table in the database.
 */
class {{Name}}Table{{Item}}s extends Table
{
    /**
     * Supplement the default constructor to configure the database table.
     *
     * This method configures the name of the table and the name of the primary
     * key column for the table.
     *
     * @param    \JDatabaseDriver    $db    The database object instance to use for
     *                                                                the table.
     */
    public function __construct(&$db)
    {
        parent::__construct('#__{{name}}_{{item}}s', 'id', $db);
    }
}
