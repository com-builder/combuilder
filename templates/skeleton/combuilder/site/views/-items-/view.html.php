<?php declare(strict_types = 1);
/**
 * This file represents the "{{Item}}s" presentation layer and is responsible for
 * handling the display of and interaction with data.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Site\View\{{Item}}s;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri as URI;

/**
 * The "{{Item}}s" view is a list of "{{Item}}" records from the database.
 */
class {{Name}}View{{Item}}s extends BaseView {
  /**
   * A possibly-filtered result set of "{{Item}}" objects from the database.
   *
   * @var  array
   */
  protected ${{item}}s;

  /**
   * A reference to the model's pagination object instance.
   *
   * @var  \Joomla\CMS\Pagination\Pagination
   */
  protected $pagination;

  /**
   * The translated page title for the current view/layout.
   *
   * This property is equivalent to the unescaped, translated value of the
   * language constant 'COM_{{NAME}}_VIEW_{{ITEM}}S_READ'.
   *
   * @var  string
   */
  protected $title;

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
    // Fetch the "{{Item}}s" and pagination state from the database
    $this->{{item}}s      = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    // Fetch references to Joomla's application and document object instances
    $app = Factory::getApplication();
    $doc = Factory::getDocument();
    // Set the document title to the name of the current view/layout
    $this->title = Text::_('COM_{{NAME}}_VIEW_{{ITEM}}S_READ');
    $doc->setTitle($this->title.' - '.$app->get('sitename'));
    // Set the layout manually since we only have one layout
    $this->setLayout('read');
    // Call the parent class implementation for this method
    return parent::display($template);
  }

  /**
   * Fetches a link to view a single "{{Item}}" record.
   *
   * @param   object  $row  An object (usually from the database) containing an
   *                        identification number (`id`) and name (`name`).
   *
   * @return  string        A fully rendered anchor tag for direct placement in
   *                        a template.
   */
  protected function get{{Item}}ViewLink(object $row): string {
    return Route::_('index.php?'.URI::buildQuery([
      'id'     => intval($row->id),
      'option' => 'com_{{name}}',
      'task'   => '{{item}}.display',
      'view'   => '{{item}}'
    ]));
  }
}
