<?php declare(strict_types = 1);
/**
 * This file represents the "{{Item}}s" data layer and is responsible for
 * handling all data-oriented operations.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Site\Model;

use Joomla\CMS\MVC\Model\ListModel;

/**
 * The "{{Item}}s" model is responsible for listing all records from the
 * database.
 */
class {{Name}}Model{{Item}}s extends ListModel
{
    /**
     * Fetch a query to get a list of "{{Item}}s" from the database.
     *
     * The query will be pre-configured to contain only the `id` and `name`
     * columns for published records.
     *
     * @throws    \RuntimeException    If the current database driver's query
     *                                 class can't be found.
     * @throws    \RuntimeException    If a subquery alias isn't provided.
     *
     * @return    \JDatabaseQuery      A pre-configured query instance that is
     *                                 ready to fetch results from the database.
     */
    protected function getListQuery()
    {
        // Fetch a reference to the Joomla database driver object instance
        $db = $this->getDBO();
        // Fetch a reference to a new query object instance
        $query = $db->getQuery(TRUE);
        // Prepare the query to select list-worthy columns from the "{{Item}}s"
        // table
        $query->select($db->quoteName(['id', 'name']));
        $query->from($db->quoteName('#__{{name}}_{{item}}s'));
        $query->where($db->quoteName('published').' = 1');
        return $query;
    }
}
