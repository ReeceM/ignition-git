<?php

namespace ReeceM\GitTab;

use Facade\Ignition\Tabs\Tab as BaseTab;

class IgnitionGitTab extends BaseTab
{
    /**
     * Tab Version.
     * 
     * @var string VERSION
     */
    public const VERSION = '0.1.0';

    public function name(): string
    {
        return 'Open Issue';
    }

    public function description(): string
    {
        return 'Opens an issue on the selected repository';
    }

    public function component(): string
    {
        return 'ignition-git';
    }

    public function registerAssets()
    {
        $this->script('ignition-git', __DIR__.'/../dist/js/tab.js');
    }

    public function meta(): array
    {
        return [
            'title'         => $this->name(),
            'description'   => $this->description(),
            'version'       => self::VERSION
        ];
    }
}
