<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $alert;
    public $type;
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($alert)
    {
        switch ($alert['type']) {
            case 'error':
                $this->type = 'danger';
                break;
            case 'warning':
                $this->type = 'warning';
                break;
            case 'success':
                $this->type = 'success';
                break;
            default:
                $this->type = 'info';
                break;
        }

        $this->message = $alert['message'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
