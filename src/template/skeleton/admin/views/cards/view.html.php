<?php declare(strict_types = 1);
/**
 * This file represents the "Cards" presentation layer and is responsible for
 * handling the display of and interaction with data.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  2018 {{author}}. All rights reserved.
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\View\Cards;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri as URI;

/**
 * The "Cards" view is a list of "Card" records from the database.
 */
class {{Name}}ViewCards extends BaseView {
  /**
   * An array of active search filters on the model from the user state.
   *
   * @var  array
   */
  protected $activeFilters;

  /**
   * A reference to the Joomla! application object instance.
   *
   * @var  \Joomla\CMS\Application\CMSApplication
   */
  protected $app;

  /**
   * A possibly-filtered result set of "Card" objects from the database.
   *
   * @var  array
   */
  protected $cards;

  /**
   * The form used to filter the "Cards" result set.
   *
   * @var  \Joomla\CMS\Form\Form
   */
  public $filterForm;

  /**
   * The column name by which the result set is being ordered.
   *
   * @var  string
   */
  protected $filterOrder;

  /**
   * The sort direction of the ordering column.
   *
   * @var  string
   */
  protected $filterOrderDir;

  /**
   * A reference to the model's pagination object instance.
   *
   * @var  \Joomla\CMS\Pagination\Pagination
   */
  protected $pagination;

  /**
   * This method prepares the class instance to render a template layout.
   *
   * @param   string      $template  Which template should be loaded to render.
   *
   * @throws  \Exception             On error from the model.
   *
   * @return  mixed                  `string` containing the rendered template
   *                                 on success, otherwise an `object` or `bool`
   *                                 on failure.
   */
  public function display($template = NULL) {
    // Fetch the application object instance
    $this->app = Factory::getApplication();
    // Fetch the "Cards" and pagination state from the database
    $this->cards      = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    // Fetch the sorting column and direction from the user state
    $this->filterOrder    = $this->app->getUserStateFromRequest(
      '{{name}}.list.admin.card.filterOrder',
      'filter_order', 'cards.id', 'cmd');
    $this->filterOrderDir = $this->app->getUserStateFromRequest(
      '{{name}}.list.admin.card.filterOrderDir',
      'filter_order_Dir', 'asc', 'cmd');
    $this->filterForm     = $this->get('FilterForm');
    $this->activeFilters  = $this->get('ActiveFilters');
    // Set the layout manually since we only have one layout
    $this->setLayout('read');
    // Call the parent class implementation for this method
    return parent::display($template);
  }

  /**
   * Fetches a link to update a single "Card" record.
   *
   * @param   object  $row  An object (usually from the database) containing an
   *                        identification number (`id`) and name (`name`).
   *
   * @return  string        A fully rendered anchor tag for direct placement in
   *                        a template.
   */
  protected function getCardUpdateLink(object $row): string {
    return Route::_('index.php?'.URI::buildQuery([
      'id'     => intval($row->id),
      'option' => 'com_{{name}}',
      'task'   => 'card.edit'
    ]));
  }
}
