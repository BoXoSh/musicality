<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $template;

    public function __construct()
    {
        $this->setTemplate(config('app.template'));
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template): void
    {
        $this->template = $template;
    }

    public function view($view = null, $data = [], $mergeData = [])
    {
        return view($this->template . '.' . $view, $data, $mergeData);
    }
}
