<?php namespace app\Support;

class NavigationManager
{

    /**
     * @var array Cache of registration callbacks.
     */
    protected $callbacks = [];

    /**
     * @var array.
     */
    protected $items;

    protected $contextOwner;
    protected $contextMainMenuItemCode;
    protected $contextSubMenuItemCode;

    protected static $mainItemDefaults = [
        'code' => null,
        'label' => null,
        'icon' => null,
        'url' => null,
        'permissions' => [],
        'order' => 100,
        'subMenu' => []
    ];

    protected static $subItemDefaults = [
        'code' => null,
        'label' => null,
        'icon' => null,
        'url' => null,
        'counter' => null,
        'counterLabel' => null,
        'attributes' => [],
        'permissions' => []
    ];

    /**
     * Loads the menu items from modules and plugins
     * @return void
     */
    protected function loadItems()
    {
        /*
         * Load module items
         */
        foreach ($this->callbacks as $callback) {
            $callback($this);
        }
    }

    public function registerCallback(callable $callback)
    {
        $this->callbacks[] = $callback;
    }

    public function registerMenuItems($owner, array $definitions)
    {
        if (!$this->items) {
            $this->items = [];
        }

        foreach ($definitions as $code => $definition) {

            $item = (object)array_merge(self::$mainItemDefaults, array_merge($definition, [
                'code' => $code,
                'owner' => $owner
            ]));

            foreach ($item->subMenu as $subMenuItemCode => $subMenuDefinition) {
                $item->subMenu[$subMenuItemCode] = (object)array_merge(
                    self::$subItemDefaults,
                    array_merge($subMenuDefinition, [
                        'code' => $subMenuItemCode,
                        'owner' => $owner
                    ])
                );
            }

            $itemKey = $this->makeItemKey($owner, $code);
            $this->items[$itemKey] = $item;
        }
    }

    /**
     * Dynamically add an array of main menu items
     * @param string $owner
     * @param array $definitions
     */
    public function addMainMenuItems($owner, array $definitions)
    {
        foreach ($definitions as $code => $definition) {
            $this->addMainMenuItem($owner, $code, $definition);
        }
    }

    /**
     * Dynamically add a single main menu item
     * @param string $owner
     * @param string $code
     * @param array $definition
     */
    public function addMainMenuItem($owner, $code, array $definition)
    {
        $subMenu = isset($definition['subMenu']) ? $definition['subMenu'] : null;

        $itemKey = $this->makeItemKey($owner, $code);
        if (isset($this->items[$itemKey])) {
            $definition = array_merge((array)$this->items[$itemKey], $definition);
        }

        $item = (object)array_merge(self::$mainItemDefaults, array_merge($definition, [
            'code' => $code,
            'owner' => $owner
        ]));

        $this->items[$itemKey] = $item;

        if ($subMenu !== null) {
            $this->addSubMenuItems($owner, $code, $subMenu);
        }
    }

    /**
     * Dynamically add an array of sub menu items
     * @param string $owner
     * @param string $code
     * @param array $definitions
     */
    public function addSubMenuItems($owner, $code, array $definitions)
    {
        foreach ($definitions as $subCode => $definition) {
            $this->addSubMenuItem($owner, $code, $subCode, $definition);
        }
    }

    /**
     * Dynamically add a single sub menu item
     * @param string $owner
     * @param string $code
     * @param string $subCode
     * @param array $definition
     * @return bool|null
     */
    public function addSubMenuItem($owner, $code, $subCode, array $definition)
    {
        $itemKey = $this->makeItemKey($owner, $code);
        if (!isset($this->items[$itemKey])) {
            return false;
        }

        $mainItem = $this->items[$itemKey];
        if (isset($mainItem->subMenu[$subCode])) {
            $definition = array_merge((array)$mainItem->subMenu[$subCode], $definition);
        }

        $item = (object)array_merge(self::$subItemDefaults, $definition);
        $this->items[$itemKey]->subMenu[$subCode] = $item;
    }


    /**
     * @return array|null
     */
    public function listMainMenuItems()
    {
        if ($this->items === null) {
            $this->loadItems();
        }
        return $this->items;
    }

    /**
     * Returns a list of sub menu items for the currently active main menu item.
     * The currently active main menu item is set with the setContext methods.
     * @return array
     */
    public function listSubMenuItems()
    {
        $activeItem = null;

        foreach ($this->listMainMenuItems() as $item) {
            if ($this->isMainMenuItemActive($item)) {
                $activeItem = $item;
                break;
            }
        }

        if (!$activeItem) {
            return [];
        }

        $items = $activeItem->subMenu;

        foreach ($items as $item) {
            if ($item->counter !== null && is_callable($item->counter)) {
                $item->counter = call_user_func($item->counter, $item);
            }
        }

        return $items;
    }

    /**
     * Sets the navigation context.
     * The function sets the navigation owner, main menu item code and the sub menu item code.
     * @param string $owner Specifies the navigation owner in the format Vendor/Module
     * @param string $mainMenuItemCode Specifies the main menu item code
     * @param string $subMenuItemCode Specifies the sub menu item code
     */
    public function setContext($owner, $mainMenuItemCode, $subMenuItemCode = null)
    {
        $this->setContextOwner($owner);
        $this->setContextMainMenu($mainMenuItemCode);
        $this->setContextSubMenu($subMenuItemCode);
    }

    /**
     * Sets the navigation context.
     * The function sets the navigation owner.
     * @param string $owner Specifies the navigation owner in the format Vendor/Module
     */
    public function setContextOwner($owner)
    {
        $this->contextOwner = $owner;
    }

    /**
     * Specifies a code of the main menu item in the current navigation context.
     * @param string $mainMenuItemCode Specifies the main menu item code
     */
    public function setContextMainMenu($mainMenuItemCode)
    {
        $this->contextMainMenuItemCode = $mainMenuItemCode;
    }

    /**
     * Specifies a code of the sub menu item in the current navigation context.
     * If the code is set to TRUE, the first item will be flagged as active.
     * @param string $subMenuItemCode Specifies the sub menu item code
     */
    public function setContextSubMenu($subMenuItemCode)
    {
        $this->contextSubMenuItemCode = $subMenuItemCode;
    }

    /**
     * Returns information about the current navigation context.
     * @return mixed Returns an object with the following fields:
     * - mainMenuCode
     * - subMenuCode
     * - owner
     */
    public function getContext()
    {
        return (object)[
            'mainMenuCode' => $this->contextMainMenuItemCode,
            'subMenuCode' => $this->contextSubMenuItemCode,
            'owner' => $this->contextOwner
        ];
    }

    /**
     * Determines if a main menu item is active.
     * @param mixed $item Specifies the item object.
     * @return boolean Returns true if the menu item is active.
     */
    public function isMainMenuItemActive($item)
    {
        return $this->contextOwner == $item->owner && $this->contextMainMenuItemCode == $item->code;
    }

    /**
     * Returns the currently active main menu item
     * @return mixed|null
     */
    public function getActiveMainMenuItem()
    {
        foreach ($this->listMainMenuItems() as $item) {
            if ($this->isMainMenuItemActive($item)) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Determines if a sub menu item is active.
     * @param mixed $item Specifies the item object.
     * @return boolean Returns true if the sub item is active.
     */
    public function isSubMenuItemActive($item)
    {
        if ($this->contextSubMenuItemCode === true) {
            $this->contextSubMenuItemCode = null;
            return true;
        }

        return $this->contextOwner == $item->owner && $this->contextSubMenuItemCode == $item->code;
    }

    /**
     * Internal method to make a unique key for an item.
     * @param $owner
     * @param $code
     * @return string
     */
    protected function makeItemKey($owner, $code)
    {
        return strtoupper($owner) . '.' . strtoupper($code);
    }

}