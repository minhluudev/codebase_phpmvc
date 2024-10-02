<?php
namespace Core;

class Session
{
  protected const FLASH_KEY = 'flash_messages';

  public function __construct()
  {
    session_start();
    $this->initFlashMessages();
  }

  public function __destruct()
  {
    $this->removeFlashMessages();
  }

  public function setFlash($key, $message)
  {
    $_SESSION[self::FLASH_KEY][$key] = [
      'value' => $message,
      'remove' => false
    ];
  }

  public function getFlash($key)
  {
    return $_SESSION[self::FLASH_KEY][$key] ?? null;
  }

  private function initFlashMessages()
  {
    $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

    foreach ($flashMessages as $key => &$flashMessage) {
      $flashMessage['remove'] = true;
    }

    $_SESSION[self::FLASH_KEY] = $flashMessages;
  }

  private function removeFlashMessages()
  {
    $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

    foreach ($flashMessages as $key => &$flashMessage) {
      if ($flashMessage['remove']) {
        unset($flashMessages[$key]);
      }
    }

    $_SESSION[self::FLASH_KEY] = $flashMessages;
  }
}