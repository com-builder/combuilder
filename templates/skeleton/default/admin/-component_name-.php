<?php declare(strict_types = 1);
/**
 * This file serves as the component's logical entrypoint for execution.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Find the appropriate controller and begin component execution.
 *
 * This file is limited to an immediately-invoked function expression so that
 * it can be compliant with PSR 1.2.3: "A file SHOULD declare new symbols ...
 * and cause no other side effects, or it SHOULD execute logic with side
 * effects, but SHOULD NOT do both."
 *
 * @throws    \Exception    When the application fails to start.
 * @throws    \Exception    If the controller couldn't be loaded.
 * @throws    \Exception    If the task couldn't be found.
 */
(function()
{
    // Require the helper
    require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/{{name}}.php';
    // Fetch the client's desired class task from its request input
    $input = Factory::getApplication()->input;
    // Check whether a view was supplied in the application input parameters
    if ($input->get('view', FALSE) === FALSE)
    {
        // Supply a default view to absolve this extension of requiring a
        // generic controller class
        $input->set('view', '{{item}}s');
    }
    // Check whether a task was supplied in the application input parameters
    if ($input->get('task', FALSE) === FALSE)
    {
        // Supply a default task of `$view`.display to absolve this extension
        // of requiring a generic controller class
        $input->set('task', $input->get('view').'.display');
    }
    // Fetch an instance of the appropriate `BaseController` child class
    $controller = BaseController::getInstance('{{Name}}');
    // Execute the task using the controller instance
    $controller->execute($input->get('task'));
    // Perform any pending redirect set by the controller
    $controller->redirect();
})();
