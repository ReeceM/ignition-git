<?php

namespace ReeceM\GitTab\Tests\Utils;

use ReeceM\GitTab\Tests\TestCase;
use ReeceM\GitTab\Utils\GitRepos;

class GitRepoTests extends TestCase
{
    /** @test */

    public function a_url_is_made_github()
    {;
        $gitRepos = new GitRepos('https://github.com/ReeceM/ignition-git.git');

        return $this->assertEquals(
            "https://api.github.com/repos/ReeceM/ignition-git/issues",
            $gitRepos->name(),
            'Url not the expected one'
        );
    }

    /** @test */
    public function open_issue_action()
    {    
        $gitRepos = new GitRepos('https://gitlab.com/ReeceM/ignition-git.git');

        return $this->assertEquals(
            "https://gitlab.com/api/v4/projects/ignition-git/issues",
            $gitRepos->name(),
            'URL not the expected one'
        );
    }
}
