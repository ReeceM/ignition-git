<?php

namespace ReeceM\GitTab\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use ReeceM\GitTab\IgnitionGitTab;
use ReeceM\GitTab\Utils\GitRepos;

class OpenIssueAction
{

    /**
     * the http client.
     * 
     * @var \GuzzleHttp\Client $client
     */
    private $client;
    
    /**
     * the Git Repository Handler.
     * 
     * @var \ReeceM\GitTab\Utils\GitRepos $gitRepos
     */
    private $gitRepos;


    /**
     * Constructs a new instance of action
     * 
     * @return self
     */
    public function __construct($data)
    {   
        $url        = $data['git']['remote'] ?? abort(402, 'Repo Url Not present');

        $this->gitRepos = new GitRepos($url);

        $this->client = new Client($this->getHeaders());
    }

    /**
     * Opens the issue on the repo.
     * 
     * Execute this in the backend to keep all secrets secret
     * 
     * @return mixed|\GuzzleHttp\ResponseInterface|\GuzzleHttp\Exception\RequestException
     */
    public static function execute($data)
    {
        $self = new self($data);

        $data = collect($data)->only(['title','body'])->toArray();

        try {

            $response = $self->client->request(
                'POST',
                $self->gitRepos->getPath(),
                [
                    \GuzzleHttp\RequestOptions::JSON => $data
                ]
            );

            return [
                'message'   => 'Issue Opened',
                'result'    => $response->getBody()->getContents(),
                'code'      => $response->getStatusCode()
            ];

        } catch (RequestException $exception) {
            return [
                'status'    => 'failed',
                'response'  => $exception->getResponse(),
                'message'     => $exception->getMessage(),
                'code'      => 500
            ];
        }
    }

    
    /**
     * Get headers for client.
     * 
     * @return array
     */
    private function getHeaders() : array
    {
        $userAgent  = sprintf("Ignition Git Tab/%s (github.com/ReeceM/ignition-git)", IgnitionGitTab::VERSION);

        $headers = [
            'headers' => [
                'User-Agent' => $userAgent,
                'Content-Type' => 'application/json'
                ]
            ];
        
        $headers['headers'] = array_merge($headers['headers'], $this->gitRepos->getAuthHeaders());

        return $headers;
    }
}