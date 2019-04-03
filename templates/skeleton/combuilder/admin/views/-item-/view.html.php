<?php declare(strict_types = 1);
/**
 * This file represents the "{{Item}}" presentation layer and is responsible for
 * handling the display of and interaction with data.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\View\{{Item}};

use Joomla\CMS\Factory;
use Joomla\CMS\Toolbar\ToolbarHelper as Toolbar;
use Joomla\CMS\MVC\View\HtmlView as BaseView;

/**
 * The "{{Item}}" view is for a specific record from the database.
 */
class {{Name}}View{{Item}} extends BaseView {
  /**
   * An object representing a "{{Item}}" record from the database.
   *
   * @var  object
   */
  protected ${{item}};

  /**
   * The form used to create or update a "{{Item}}" record.
   *
   * @var  \Joomla\CMS\Form\Form
   */
  protected $form;

  /**
   * Adds common buttons to the toolbar used across all layouts.
   *
   * A "Save & Close", "Save" and "Save & New" button are added.
   */
  protected function addToolbarSaveButtons() {
    // Add the applicable save buttons to the toolbar
    Toolbar::apply('{{item}}.apply');
    Toolbar::save('{{item}}.save');
    Toolbar::save2new('{{item}}.save2new');
  }

  /**
   * This method prepares the class instance to render a template layout.
   *
   * This method will hide Joomla's main menu while modifying an object.
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
    // Fetch the requested "{{Item}}" by the provided ID
    $this->form = $this->get('Form');
    $this->{{item}} = $this->get('Item');
    // Add the save buttons to the toolbar
    $this->addToolbarSaveButtons();
    // Hide the administrative menu while processing the form
    Factory::getApplication()->input->set('hidemainmenu', TRUE);
    // Determine whether to show the new or edit view
    $this->setLayout(!isset($this->{{item}}->id) ? 'create' : 'update');
    // Call the parent class implementation for this method
    return parent::display($template);
  }
}
