<?php declare(strict_types = 1);
/**
 * This file represents the "Card" data layer and is responsible for handling
 * all data-oriented operations.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  2018 {{author}}. All rights reserved.
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

/**
 * The "Card" model represents a single record from the database.
 */
class {{Name}}ModelCard extends AdminModel {
  /**
   * Fetch the form used to create or update a single "Card" record.
   *
   * @suppress  PhanUnusedPublicMethodParameter
   *
   * @param     array  $data      Any pre-filled data to be used in the form.
   * @param     bool   $loadData  Whether the form should load its own data.
   *
   * @return    mixed             A `\Joomla\CMS\Form\Form` instance on success,
   *                            `FALSE` on failure.
   */
  public function getForm($data = [], $loadData = TRUE) {
    // Attempt to fetch a "Card" form instance defined by XML
    return $this->loadForm('com_{{name}}.{{item}}', '{{item}}',
      ['control' => 'jform', 'load_data' => $loadData]) ?: FALSE;
  }

  /**
   * Fetch the table used to fetch or manipulate "Cards".
   *
   * This method is a default initializer for the parent class method with the
   * same name. If no value for `$name` is provided, it will be initialized to
   * "Cards". If no value for `$prefix` is provided, it will be initialized to
   * "{{Name}}Table".
   *
   * @param   string                   $name    The name of the table class.
   * @param   string                   $prefix  The prefix of the table class.
   * @param   array                    $config  An array of configuration
   *                                            parameters for the table.
   *
   * @throws  \Exception                        When the requested `Table`
   *                                            instance couldn't be created.
   *
   * @return  \Joomla\CMS\Table\Table           A `Table` instance representing
   *                                            the "Cards" table.
   */
  public function getTable($name = '', $prefix = '', $config = []) {
    return parent::getTable($name ?: 'Cards',
      $prefix ?: '{{Name}}Table', $config);
  }

  /**
   * Fetch the current form data from the user state (fallback to the database).
   *
   * If the user state contains form data, then the user state is used to
   * pre-populate the form with data. Otherwise, if an ID was provided in the
   * request, this method will attempt to pre-populate the form with the
   * matching item from the database.
   *
   * @throws  \Exception  When the application fails to start.
   *
   * @return  mixed       An `object` representing a "Card" or `FALSE`
   *                      on failure.
   */
  protected function loadFormData() {
    $key = 'com_{{name}}.edit.{{item}}.data';
    // Check the session for previously entered form data
    $data = Factory::getApplication()->getUserState($key);
    // If there is no user state for the form, fetch the "Card" being edited
    return isset($data) ? $data : $this->getItem();
  }
}
