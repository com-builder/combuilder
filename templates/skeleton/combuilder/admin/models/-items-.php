<?php declare(strict_types = 1);
/**
 * This file represents the "{{Item}}s" data layer and is responsible for handling
 * all data-oriented operations.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\Model;

use Joomla\CMS\MVC\Model\ListModel;

/**
 * The "{{Item}}s" model is responsible for listing all records from the database.
 */
class {{Name}}Model{{Item}}s extends ListModel {
  /**
   * Supplement the default constructor to configure the model's filter fields.
   *
   * @param  array  $config  An array of configuration parameters for the model.
   */
  public function __construct($config = []) {
    $config['filter_fields'] = ['id', 'name', 'published'];
    parent::__construct($config);
  }

  /**
   * Fetch a query to get a list of "{{Item}}s" from the database.
   *
   * The query will be pre-configured to contain only the `id`, `published` and
   * `name` columns. Additionally, if the `checked_out` column is non-NULL, then
   * `editor` will contain the name of the user that has the record checked-out.
   * Otherwise, `editor` is NULL.
   *
   * Depending on the active filters and ordering configuration in the user
   * state, the pre-configured functionality of the resulting query can differ
   * in the following ways:
   *
   * - `filter.search`:    If the user state contains this key, the result set
   *                       will be filtered to contain results whose `name`
   *                       column match the provided value surrounded by
   *                       wild{{item}}s on either side. Otherwise, the result set
   *                       is not filtered by `name`. This filter is
   *                       case-insensitive.
   * - `filter.published`: If the user state contains this key, the result set
   *                       will be filtered to contain results whose `published`
   *                       column match the provided value exactly. Otherwise,
   *                       the result set will contain only published and
   *                       unpublished records (excluding trashed records).
   * - `list.ordering`:    If the user state contains this key, the results set
   *                       will be ordered based on the value of the specified
   *                       column. Otherwise, the result set is ordered by the
   *                       `id` column.
   * - `list.direction`:   If the user state contains this key, the results set
   *                       will be ordered based on the specified direction
   *                       (ascending or descending). Otherwise, the result set
   *                       is ordered ascending.
   *
   * The user state key `list.ordering` must contain the prefix '{{item}}s.' before
   * the provided column name so that there is no ambiguity between the "{{Item}}s"
   * and the "Users" table. This is because these two tables are joined to fetch
   * the name of the "User" represented by the ID stored in `{{item}}s.checked_out`.
   *
   * @throws  \RuntimeException  If the current database driver's query class
   *                             can't be found.
   * @throws  \RuntimeException  If a subquery alias isn't provided.
   *
   * @return  \JDatabaseQuery    A pre-configured query instance that is ready
   *                             to fetch results from the database.
   */
  protected function getListQuery() {
    // Fetch a reference to the Joomla database driver object instance
    $db = $this->getDBO();
    // Fetch a reference to a new query object instance
    $query = $db->getQuery(TRUE);
    // Prepare the query to select list-worthy columns from the "{{Item}}s" table
    $query->select($db->quoteName(['{{item}}s.id',
      '{{item}}s.published', '{{item}}s.name']));
    // Fetch the checked out user ID and timestamp
    $query->select($db->quoteName('{{item}}s.checked_out', 'checkedOut'));
    $query->select($db->quoteName('{{item}}s.checked_out_time', 'checkedOutTime'));
    // Select the checked-out user ID as "editor"
    $query->select($db->quoteName('users.name', 'editor'));
    // Left join the users table when checked out
    $query->join('LEFT', $db->quoteName('#__users', 'users').' ON '.
      '{{item}}s.checked_out = users.id');
    $query->from($db->quoteName('#__{{name}}_{{item}}s', '{{item}}s'));
    // Fetch the search filter from the user state
    $search = $this->getState('filter.search');
    // Check whether the search filter is non-empty
    if (strlen($search ?? '') > 0) {
      // Filter the results by name using the provided search filter
      $query->where($db->quoteName('{{item}}s.name').' LIKE '.
        $db->quote('%'.$search.'%'));
    }
    // Fetch the published filter from the user state
    $published = $this->getState('filter.published');
    // Check whether the user wants only published or unpublished records
    if (is_numeric($published)) {
      // Limit the results to contain only published or unpublished records
      $query->where($db->quoteName('{{item}}s.published').' = '.intval($published));
    } else {
      // Limit the results to contain only non-trashed records
      $query->where($db->quoteName('{{item}}s.published').' IN (0, 1)');
    }
    // Order the list by the user-requested column and direction
    $listOrder = $this->state->get('list.ordering', '{{item}}s.id');
    $listDir   = $this->state->get('list.direction', 'asc');
    $query->order($db->quoteName($listOrder).' '.$db->escape($listDir));
    return $query;
  }
}
