<?php declare(strict_types = 1);
/**
 * This file represents the "Card" presentation layer and is responsible for
 * handling the display of and interaction with data.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  2018 {{author}}. All rights reserved.
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\View\Card;

use Joomla\CMS\Factory;
use Joomla\CMS\Toolbar\ToolbarHelper as Toolbar;
use Joomla\CMS\MVC\View\HtmlView as BaseView;

/**
 * The "Card" view is for a specific record from the database.
 */
class {{Name}}ViewCard extends BaseView {
  /**
   * An object representing a "Card" record from the database.
   *
   * @var  object
   */
  protected $card;

  /**
   * The form used to create or update a "Card" record.
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
    Toolbar::apply('card.apply');
    Toolbar::save('card.save');
    Toolbar::save2new('card.save2new');
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
    // Fetch the requested "Card" by the provided ID
    $this->form = $this->get('Form');
    $this->card = $this->get('Item');
    // Add the save buttons to the toolbar
    $this->addToolbarSaveButtons();
    // Hide the administrative menu while processing the form
    Factory::getApplication()->input->set('hidemainmenu', TRUE);
    // Determine whether to show the new or edit view
    $this->setLayout(!isset($this->card->id) ? 'create' : 'update');
    // Call the parent class implementation for this method
    return parent::display($template);
  }
}
