<?php declare(strict_types = 1);
/**
 * This controller is responsible for coordinating the "{{Item}}" data and
 * presentation layers.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

// namespace Joomla\Component\{{Name}}\Administrator\Controller;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * The "{{Item}}" controller is responsible for facilitating Model and View
 * logic.
 */
class {{Name}}Controller{{Item}} extends FormController
{
    /**
     * Fetch the model used to fetch or manipulate a "{{Item}}".
     *
     * The "ignore_request" configuration key is overriden to be `FALSE`.
     *
     * @param   string  $name    The name of the model class.
     * @param   string  $prefix  The prefix of the model class.
     * @param   array   $config  An array of configuration parameters for the
     *                           model.
     *
     * @return  mixed            `\Joomla\CMS\MVC\Model\BaseDatabaseModel` on
     *                           success, `FALSE` on failure.
     */
    public function getModel($name = '', $prefix = '', $config = [])
    {
        $config['ignore_request'] = FALSE;
        return parent::getModel($name, $prefix, $config);
    }
}
