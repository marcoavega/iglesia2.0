<?php
class ViewController
{
    private static $view_path = './views/';

    public function load_view($view)
    {
        if ($view != 'hymn') {
            require_once self::$view_path . 'header.php';
            require_once self::$view_path . $view . '.php';
            require_once self::$view_path . 'footer.php';
        } else {
            require_once self::$view_path . 'headerh.php';
            require_once self::$view_path . $view . '.php';
            require_once self::$view_path . 'footerh.php';
        }
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}