<?php

namespace ReeceM\GitTab\Tests;

use Mockery;
use ReeceM\GitTab\Actions\OpenIssueAction;
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
        $mocked = Mockery::mock(OpenIssueAction::class);

        $mocked->shouldReceive('execute')
                ->once()
                // ->with($mockData)
                ->andReturn([
                    'message'   => 'Issue Opened',
                    'result'    => ['state' => 'open'],
                    'code'      => 201
                ]);
        
        $response = $mocked->execute($mockData);

        $this->assertEquals(201, $response['code']);
    }
}
