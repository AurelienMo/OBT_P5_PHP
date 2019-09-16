<?php


namespace App\Session;


class PHPSession implements SessionInterface
{

    /**
     * check if the session is started
     */
    private function ensureStarted(){
        if (session_status () === PHP_SESSION_NONE){
            session_start ();
        }
    }

    /**
     * keep information in session
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $this->ensureStarted ();
        if (array_key_exists ($key, $_SESSION)){
            return $_SESSION[$key];
        }
        return $default;
    }

    /**
     * add an information in session
     *
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value): void
    {
        $this->ensureStarted ();
        $_SESSION[$key] = $value;
    }

    /**
     * delete a key in session
     *
     * @param string $key
     */
    public function delete(string $key): void
    {
        $this->ensureStarted ();
        unset($_SESSION[$key]);
    }
}