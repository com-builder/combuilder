<?php declare(strict_types = 1);
/**
 * This file represents the "{{Item}}" data layer and is responsible for handling
 * all data-oriented operations.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ItemModel;

/**
 * The "{{Item}}" model represents a single record from the database.
 */
class {{Name}}Model{{Item}} extends ItemModel {
    /**
     * Fetch a single "{{Item}}" from the database by ID.
     *
     * If an ID is not provided as an argument, this method will attempt to
     * extract an item ID from the application input.
     *
     * Only the `name` columns are included in the result.
     *
     * @param     ?int               $id  A "{{Item}}" identification number.
     *
     * @throws    \Exception              When the application fails to start.
     * @throws    \RuntimeException       If the current database driver's query
     *                                    class can't be found.
     * @throws    \RuntimeException       If a subquery alias isn't provided.
     * @throws    \RuntimeException       If the query fails to execute.
     * @throws    \RuntimeException       If unable to load a record from the
     *                                    result set.
     * @return    ?object                  A result object from the database.
     */
    public function getItem(?int $id = NULL): ?object
    {
        // Determine whether the item ID was provided via argument or input
        $input = Factory::getApplication()->input;
        $id = $id ?? $input->get('id', NULL, 'UINT');
        // Ensure that the resulting item ID is positive
        if (is_numeric($id) && ($id = intval($id)) > 0)
        {
            // Fetch a reference to the Joomla database driver object instance
            $db = $this->getDBO();
            // Fetch a reference to a new query object instance
            $query = $db->getQuery(TRUE);
            // Prepare the query to select the item from the "{{Item}}s"
            // table by ID
            $query->select($db->quoteName(['name']));
            $query->from($db->quoteName('#__{{name}}_{{item}}s'));
            $query->where($db->quoteName('id').' = '.$id.' AND '.
                $db->quoteName('published').' = 1');
            // Set the active query for the database driver
            $db->setQuery($query);
            // Attempt to execute the query and fetch an item object
            if ($item = $db->loadObject())
            {
                // Return the resulting item from the database
                return $item;
            }
        }
        return NULL;
    }
}
