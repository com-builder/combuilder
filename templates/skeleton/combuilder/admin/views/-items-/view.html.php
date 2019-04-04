<?php declare(strict_types = 1);
/**
 * This file represents the "{{Item}}s" presentation layer and is responsible for
 * handling the display of and interaction with data.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\View\{{Item}}s;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri as URI;

/**
 * The "{{Item}}s" view is a list of "{{Item}}" records from the database.
 */
class {{Name}}View{{Item}}s extends BaseView {
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
   * A possibly-filtered result set of "{{Item}}" objects from the database.
   *
   * @var  array
   */
  protected ${{item}}s;

  /**
   * The form used to filter the "{{Item}}s" result set.
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
    // Load the submenu
    {{Name}}Helper::addSubmenu('{{item}}s');
    // Fetch the "{{Item}}s" and pagination state from the database
    $this->{{item}}s      = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    // Fetch the sorting column and direction from the user state
    $this->filterOrder    = $this->app->getUserStateFromRequest(
      '{{name}}.list.admin.{{item}}.filterOrder',
      'filter_order', '{{item}}s.id', 'cmd');
    $this->filterOrderDir = $this->app->getUserStateFromRequest(
      '{{name}}.list.admin.{{item}}.filterOrderDir',
      'filter_order_Dir', 'asc', 'cmd');
    $this->filterForm     = $this->get('FilterForm');
    $this->activeFilters  = $this->get('ActiveFilters');
    // Set the layout manually since we only have one layout
    $this->setLayout('read');
    // Call the parent class implementation for this method
    return parent::display($template);
  }

  /**
   * Fetches a link to update a single "{{Item}}" record.
   *
   * @param   object  $row  An object (usually from the database) containing an
   *                        identification number (`id`) and name (`name`).
   *
   * @return  string        A fully rendered anchor tag for direct placement in
   *                        a template.
   */
  protected function get{{Item}}UpdateLink(object $row): string {
    return Route::_('index.php?'.URI::buildQuery([
      'id'     => intval($row->id),
      'option' => 'com_{{name}}',
      'task'   => '{{item}}.edit'
    ]));
  }
}
