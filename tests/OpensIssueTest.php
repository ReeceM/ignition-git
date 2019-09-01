<?php

namespace ReeceM\GitTab\Tests;

// use Facade\ReeceM\GitTab\Actions\OpenIssueAction;
// use Mockery\Mock;
use ReeceM\GitTab\IgnitionGitTab;
use ReeceM\GitTab\Tests\TestCase;

class OpensIssueTest extends TestCase
{
    /** @test */

    public function a_tab_can_be_made()
    {
        $tab = new IgnitionGitTab();

        return $this->assertEquals('Open Issue', $tab->name(), 'Tab name not the expected one');
    }

    /** @test */
    public function open_issue_action()
    {
        $mockData = [
            'git' => [
                'remote' => 'https://github.com/ReeceM/ignition-git.git'
            ],
            'title' => 'Issue',
            'body' => '**Test**'
        ];

        $response = OpenIssueAction::shouldReceive('execute')
                                    ->once()
                                    ->with($mockData)
                                    ->andReturn([
                                        'message'   => 'Issue Opened',
                                        'result'    => ['state' => 'open'],
                                        'code'      => 201
                                    ]);
        //
        $this->assertEquals(201, $response['code']);
    }
}
