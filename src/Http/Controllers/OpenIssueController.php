<?php

namespace ReeceM\GitTab\Http\Controllers;

use GuzzleHttp\Exception\BadResponseException;
use ReeceM\GitTab\Actions\OpenIssueAction;
use ReeceM\GitTab\Http\Requests\OpenIssueRequest;

class OpenIssueController
{
     /**
     * Opens the issue for the current error
     * 
     */
    public function __invoke(OpenIssueRequest $openIssueRequest)
    {            
        $result = OpenIssueAction::execute($openIssueRequest->validated());

        return response()->json($result);
    }
}
