<?php

class Controller
{
    private static function isAdminSessionFound()
    {
        session_start();
        return null != $_SESSION["admin"];
    }

    public function redirect($url, $permanent = 301)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    public function beforeAction($controllerName)
    {
        if ($controllerName != 'login') {
            if (!self::isAdminSessionFound()) $this->redirect("/index.php?login=1");
        }
    }

    public static function openAdminSession()
    {
        // Start the session
        session_start();
        $_SESSION["admin"] = "ok";
    }
}


?>