<?php
require dirname(__FILE__) . "/Vendor/facebook-php-sdk/facebook.php";
require dirname(__FILE__) . "/Vendor/google-php-client/apiClient.php";

class Phi_Socnet_Lib_Factory
{

    private static $registry;
    private static $instance;

    private function __construct () {
        if (is_null(self::$registry)) {
            self::$registry = new ArrayObject(array());
        }
    }

    private function __clone() {}

    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance = new Phi_Socnet_Lib_Factory;
        }
        return self::$instance;
    }

    public function add ($key, Phi_Socnet_Vendor_Interface $class)
    {
        if (isset(self::$registry[$key])) {
            Mage::logException("$key is already set up.");
        }
        self::$registry[$key] = $class;

        return $this;
    }

    public function remove ($key)
    {
        if (! isset(self::$registry[$key])) {
            Mage::logException("$key is not set up.");
        }
        unset(self::$registry[$key]);
        return $this;
    }

    /**
     * Returns an instance of the library in use.
     *
     * @todo refactor this.
     *
     * @param unknown_type $key
     * @param mixed $config
     *
     * @return mixed
     */
    protected function load ($key, $config)
    {
        if (! isset(self::$registry) || !isset(self::$registry[$key])) {
                self::$registry[$key] = new $key($config);
            }

        return self::$registry[$key];
    }

    public function getLib ($key, $config)
    {
        return $this->load($key, $config);
    }
}