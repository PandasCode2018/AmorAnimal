<?php

namespace App\Http\Traits;

trait WithMessages
{
    public function showMessage($type, $title, $message, $timer = 5000)
    {
        $this->dispatch('notification', [
            'type' => $type,
            'message' => $message,
            'title' => $title,
            'timer' => $timer,
        ]);
    }

    public function showSuccess($message, $title = '', $timer = 5000)
    {
        $this->showMessage('success', $title, $message, $timer);
    }

    public function showWarning($message, $title = 'Advertencia', $timer = 5000)
    {
        $this->showMessage('warning', $title, $message, $timer);
    }

    public function showError($message, $title = 'Error', $timer = 5000)
    {
        $this->showMessage('error', $title, $message, $timer);
    }
}
