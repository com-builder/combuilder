<?php declare(strict_types = 1);
/**
 * This file serves as the component's router for Joomla's SEF URLs.
 *
 * @author     {{author}} <{{email}}>
 * @copyright  {{copyright}}
 * @license    GNU General Public License v3 (GPL-3.0).
 */

use Joomla\CMS\Component\Router\RouterBase;
use Joomla\CMS\Menu\MenuItem;

/**
 * The site router for the this component to enable the use of SEF URLs.
 *
 * This class is responsible for generating and processing SEF URLs in
 * accordance with Joomla! standards.
 *
 * @see    {{Name}}Router::build()    To see how SEF URLs are generated.
 * @see    {{Name}}Router::parse()    To see how SEF URLs are processed.
 */
class {{Name}}Router extends RouterBase
{
    /**
     * A regular sub-expression that represents a valid PHP identifier name.
     *
     * @var    string
     */
    protected $identExpr = '[_a-z][_a-z0-9]*';

    /**
     * Builds a list of Joomla! SEF URL segments from a list of query parameters.
     *
     * This method selects a "best-fit" menu item in order to build the most
     * efficient (and often the most elegant) route. Menu items that are
     * descendants of the active menu item are preferred over other routes.
     *
     * @see self::buildGetMenuItem()  For more information regarding the
     *                                selection of a "best-fit" menu item.
     *
     * @param   array  $query  An array of query parameters for which to build
     *                         a route.
     *
     * @return  array          An array of Joomla! SEF URL segments to
     *                         represent the resulting route.
     */
    public function build(&$query): array
    {
        // Extract all pertinent information from the query parameter list
        $id   = filter_var($query['id'] ?? NULL, FILTER_VALIDATE_INT) ?: NULL;
        $mid  = filter_var($query['Itemid'] ?? NULL, FILTER_VALIDATE_INT) ?: NULL;
        $task = strval($query['task'] ?? NULL) ?: NULL;
        $view = strval($query['view'] ?? NULL) ?: NULL;
        // Determine which menu item best fits this route
        $item = $this->buildGetMenuItem($mid, $view, $id);
        // Check whether a valid menu item was returned
        if ($item !== NULL)
        {
            // Replace the current working menu item in the query parameter list
            $query['Itemid'] = $item->id ?? $query['Itemid'];
            // Initialize an array to hold each SEF URL segment 'id', 'task'
            // and remove any invalid entries (i.e. `FALSE`-ish) from the array
            $segments = array_filter([
                !isset($item->query['id']) ? $id : FALSE,
                $this->buildGetMethod($task)
            ]);
            // Remove any query parameters used to generate this SEF URL (except for
            // the menu item identification number)
            unset($query['id'], $query['task'], $query['view']);
            // Return the resulting SEF URL segment list from the requested input
            return $segments;
        }
        // Assume failure if we reach this point; return zero segments
        return [];
    }

    /**
     * Finds the most closely related menu item using the given parameters.
     *
     * This method follows an algorithm of best-fit to select a menu item
     * candidate for building routes based on the provided parameters. A priority
     * queue is formed based on the following attributes of each menu item:
     *
     * 1. Menu items that match both 'view' and 'id' query parameters (exact
     *        matches) have the highest sorting precedence.
     * 2. Menu items that contain the provided menu item ancestor in their tree
     *        have the next highest sorting precedence.
     * 3. Menu items with the lowest 'level' (or depth) in the menu hierarchy have
     *        the lowest sorting precedence.
     *
     * Menu items that don't have a query parameter list or ones whose 'view'
     * query parameter don't match the provided view name are ignored. If a menu
     * item has a non-matching 'id' query parameter, it is also ignored. Note:
     * menu items without an 'id' query parameter are still considered valid.
     *
     * Once the priority queue has been built, the first entry is removed from the
     * queue and returned as the best-fit menu item for the provided parameters.
     *
     * @param   ?int     $ancestor  The desired common ancestor used to
     *                              determine descendant status.
     * @param   ?string  $view      The view name that each menu item must
     *                              reference to be applicable.
     * @param   ?int     $id        An optional item identification number used
     *                              to find an exact menu item match.
     *
     * @return  ?MenuItem           The best-fit menu item for the provided
     *                              parameters to be used for route building.
     */
    protected function buildGetMenuItem(?int $ancestor, ?string $view,
        ?int $id): ?MenuItem
    {
        // Fetch either an array of menu items or a single menu item
        $items = $this->menu->getItems([], []);
        // Make sure that `$items` is always an `array`, even with only one entry
        $items = is_array($items) ? $items : [$items];
        // Enumerate a list of applicable menu items using the provided parameters
        $items = array_map(function(MenuItem $item) use ($id, $ancestor) {
            // Determine whether this item is a descendant of the requested menu item
            $item->related = $item->id != $ancestor &&
                in_array($ancestor, $item->tree);
            // Determine whether this menu item matches the item ID
            $item->exact = is_numeric($item->query['id'] ?? NULL) && intval($item->query['id']) === $id;
            // Replace the original menu item with a decorated menu item
            return $item;
        }, array_filter($items, function(MenuItem $item) use ($id, $view)
        {
            // Ensure that this menu item has a valid default query parameter list
            if (property_exists($item, 'query') && is_array($item->query))
            {
                // Check the validity of the menu item's 'id' query parameter
                $hasID = is_numeric($item->query['id'] ?? NULL);
                $sameID = $hasID ? intval($item->query['id']) === $id : FALSE;
                // Check whether this menu item's 'view' query parameter matches
                $sameView = ($item->query['view'] ?? FALSE) === $view;
                // Ensure that this menu item has a maching view and ID (if it exists)
                return $sameView && (!$hasID || $sameID);
            }
            // Assume failure as a last resort and return `FALSE`
            return FALSE;
        }));
        // Sort the array of menu items by their level, ancestry, and exact ID match
        usort($items, function(MenuItem $left, MenuItem $right)
        {
            // Calculate our sorting metrics in preferential order
            $exact = $right->exact <=> $left->exact;
            $related = $right->related <=> $left->related;
            $level = $left->level <=> $right->level;
            // Return the comparative value of these two menu items
            return $exact === 0 ? ($related === 0 ? $level : $related) : $exact;
        });
        // Return the first menu item in the priority queue
        return array_shift($items) ?: NULL;
    }

    /**
     * Determines the necessity of a method segment in a SEF URL.
     *
     * This method returns the method name from the task string if it is
     * non-default (i.e. not equal to 'display'). Otherwise, `NULL` is returned.
     *
     * @see  self::getMethod()  For more information about the method name
     *                          extraction process.
     *
     * @param   ?string  $task  A user-provided task query parameter.
     *
     * @return  ?string         The name of the method to use.
     */
    protected function buildGetMethod(?string $task): ?string
    {
        // Offload the method name extraction of the task string
        $method = $this->getMethod($task);
        // If the resulting method name is a non-default identifier then return
        // it
        return $method !== 'display' ? $method : NULL;
    }

    /**
     * Determines which controller method should be used for the request.
     *
     * If the provided task contains a method portion (i.e. the task is a period
     * separated two-part string), then the method will be extracted from it.
     * Otherwise the provided task, if non-empty, is the assumed method. If the
     * task is empty, 'display' is used.
     *
     * @param     ?string    $task    A user-provided task query parameter.
     *
     * @return    ?string                 The name of the method to use.
     */
    protected function getMethod(?string $task): ?string
    {
        // Fetch the lowercase method name from the provided task
        $method = strtolower(ltrim(strstr($task ?? '', '.') ?: ($task ?? ''), '.'));
        // Default the method to 'display' if one could not be found
        $method = $method ?: 'display';
        // If the resulting method name is a non-default identifier then return
        // it
        return $this->isIdent($method) ? $method : NULL;
    }

    /**
     * Determines whether a string could represent a PHP identifier name.
     *
     * @param   ?string  $input  An arbitrary string.
     *
     * @return  bool             `TRUE` if `$input` is a possible identifier,
     *                           `FALSE` otherwise.
     */
    protected function isIdent(?string $input): bool
    {
        // A PHP identifier is a letter or underscore followed by any length of
        // numbers, letters or underscores
        return preg_match('/^'.$this->identExpr.'$/i', $input ?? '') === 1;
    }

    /**
     * Fetches the query parameter list from the active menu item.
     *
     * This method attempts to fetch the active menu item in an attempt to locate
     * its default query parameter list.
     *
     * @return    ?array    A query parameter list on success, `NULL` on failure.
     */
    protected function menuItemGetQuery(): ?array
    {
        // Check whether the current menu is assigned as an instance property
        if (isset($this->menu))
        {
            // Fetch the current working menu item
            $item = $this->menu->getActive();
            // Check whether the resulting menu item contains a query parameter
            // list
            if (is_object($item) && property_exists($item, 'query')) {
                // Return the resulting query parameter list for the menu item
                // or `NULL` if the `query` property is not an array
                return is_array($item->query) ? $item->query : NULL;
            }
        }
        // Assume failure as a last resort and return `NULL`
        return NULL;
    }

    /**
     * Parse a Joomla! SEF URL and convert it into input parameters.
     *
     * The active menu item is used to define the 'view' query parameter used
     * for selecting a controller/model/view triad group to satisfy the request.
     *
     * Optional parameters can be provided via the SEF URL. The first optional
     * parameter represents the 'id' query parameter and can be any 32-bit
     * unsigned integer. The last optional parameter represents the method used
     * to construct the 'task' query parameter and can be any valid PHP
     * identifier.
     *
     * The 'task' query parameter is always constructed using the 'view' query
     * parameter and the provided method name (which defaults to 'display' if
     * none is provided). This is to disallow deviation from the class triad
     * group.
     *
     * @param     array    $segments    An array of Joomla! SEF URL segments.
     *
     * @return    array                         An array of input parameters.
     */
    public function parse(&$segments): array
    {
        // Fetch the active menu item's default query parameter list
        $query = $this->menuItemGetQuery() ?? [];
        // Check whether a valid default view name is available for this menu item
        if (array_key_exists('view', $query) && $this->isIdent($query['view']))
        {
            // Process the segment list into an array of provisional query parameters
            $result = $this->parseGetQuery($segments);
            // Override the item ID segment from the SEF URL using the menu item
            $result['id'] = ($query['id'] ?? FALSE) ?: $result['id'];
            // Canonicalize the requested task string to Joomla! format
            $result['task'] = $this->parseGetTask($query['view'],
                $result['method'], $query['task']);
            // Override the original menu item parameters with values from the SEF URL
            $query = array_merge($query, $result);
            // Filter the query parameter list to contain only the following keys
            return array_intersect_key($query, array_flip(['id', 'task', 'view']));
        }
        // Assume failure if we reach this point; return zero query parameters
        return [];
    }

    /**
     * Process the provided SEF URL segments to obtain a provisional list of
     * query parameters.
     *
     * This method returns an array with keys 'id' and 'method'. One or both of
     * the values held by these keys can be `NULL` if their respective segment was
     * not matched.
     *
     * 'id' holds a `?string`-typed value representing an unsigned integer value.
     * 'method' holds a `?string`-typed value representing a method name.
     *
     * @see  self::$identExpr  The regular sub-expression used to match a PHP
     *                         identifier name.
     *
     * @param   array  $segments  An array of SEF URL segments provided by
     *                            Joomla!
     *
     * @return  array             A list of provisional query parameters.
     */
    protected function parseGetQuery(array $segments): array
    {
        // Define a regular expression used to parse the SEF URL
        $expr = '/^(?P<id>\\d+)?(?:(?:^|\\/)(?P<method>'.$this->identExpr.'))?$/i';
        // Attempt to match the provided segments using `preg_match()`
        preg_match($expr, implode('/', $segments), $result, PREG_UNMATCHED_AS_NULL);
        // Ensure that each named group exists (as `NULL` by default)
        $result = array_merge(['id' => NULL, 'method' => NULL], $result);
        // Filter the results to contain only named query parameters
        return array_filter($result, 'is_string', ARRAY_FILTER_USE_KEY);
    }

    /**
     * Determine the task to be used with the provided request details.
     *
     * The method name is used as-is if not `NULL`, otherwise the method name is
     * extracted from the provided task string.
     *
     * Prepended to the method name is the provided view name separated by '.'
     * (as per Joomla! standards).
     *
     * If a valid method name cannot be located, `NULL` is returned.
     *
     * @param   string   $view    The name of the requested view.
     * @param   ?string  $method  The name of the requested method.
     * @param   ?string  $task    The default menu item task.
     *
     * @return  ?string           A Joomla!-standard task string.
     */
    protected function parseGetTask(string $view, ?string $method, ?string $task) : ?string
    {
        // Determine which method name should be used in the resulting task string
        $name = ($method ?: $this->getMethod($task)) ?: 'display';
        // Concatenate the view name with the requested/default method name
        return $this->isIdent($name) ? $view.'.'.$name : NULL;
    }
}
