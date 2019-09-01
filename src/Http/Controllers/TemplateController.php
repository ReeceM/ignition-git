<?php

namespace ReeceM\GitTab\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController
{
     /**
     * Opens the issue for the current error
     * 
     */
    public function __invoke(Request $request, $template)
    {
        return config('ignition-git.issue.' . $template);
    }
}
