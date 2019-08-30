<?php

namespace ReeceM\GitTab;

use Facade\Ignition\Tabs\Tab as BaseTab;

class Tab extends BaseTab
{
    public function name(): string
    {
        return 'Open Issue';
    }

    public function component(): string
    {
        return 'ignition-git';
    }

    public function registerAssets()
    {
        $this->script('igntion-git', __DIR__.'/../dist/js/tab.js');
    }

    public function meta(): array
    {
        return [
            'title' => $this->name(),
        ];
    }
}
