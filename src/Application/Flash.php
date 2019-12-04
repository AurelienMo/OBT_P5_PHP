<?php


namespace App\Application;


trait Flash
{
    public function getFlashMessage()
    {
        return $_SESSION['_flashes'];
    }
    public function addFlashMessage(string $type, string $message)
    {
        $_SESSION['_flashes'][$type][] = $message;
    }
    public function removeFlashMessage(string $type, string $message)
    {
        unset($_SESSION['_flashes'][$type][$message]);
    }
    public function clearFlash()
    {
        $_SESSION['_flashes'] = [];
    }
    private function initFlashMessages()
    {
        if (!array_key_exists('_flashes', $_SESSION)) {
            $_SESSION['_flashes'] = [];
        }
    }
}