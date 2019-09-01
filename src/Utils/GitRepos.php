<?php

namespace ReeceM\GitTab\Utils;

class GitRepos
{
	// no tailing slash
	public const GITHUB = "https://api.github.com/repos";
	public const GITLAB = "https://gitlab.com/api/v4/projects";

	/**
	 * the repos relations.
	 * 
	 * @var array $repos
	 */
	public $repos = [
		'github.com' => self::GITHUB,
		'gitlab.com' => self::GITLAB
	];

	/**
	 * the resolved repo.
	 * 
	 * @var array $repo
	 */
	private $repo = [];

	/**
	 * construct the class
	 * 
	 * @param string $url
	 * 
	 * @return self
	 */
	public function __construct($url)
	{
		$this->splitUrl($url);
	}

	/**
	 * gets the relative auth header.
	 * 
	 * @return string
	 */
	public function getAuthHeaders()
	{ 
		$token = config('ignition.git.token');

		if ($this->repo[3] == 'gitlab.com') {
			return "Private-Token: {$token}";
		}

		return "token {$token}";
	}

	/**
	 * splits the url up
	 * 
	 * @param string $url
	 * 
	 * @return void
	 */
	public function splitUrl($url)
	{
		$this->repo = preg_split(
						'/(^(https|git)(:\/\/|@)([^\/:]+)[\/:]([^\/:]+)\/(.+).git$)/', /* https://serverfault.com/a/917253 */
						$url, 
						-1, 
						PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
					);
	}

	/**
	 * Gets the path to submit to
	 * 
	 * @return string 
	 */
	public function getPath()
	{
		$github = $this->repo[3] == 'github.com';
		if(! $github) {
			
			return sprintf("%s/%s/issues", $this->getBaseUrl() , $this->repo[5]);
		}

		return sprintf("%s/%s/%s/issues", $this->getBaseUrl() , $this->repo[4], $this->repo[5]);
	}

	/**
	 * gets the base Url needed for request
	 * 
	 * @return string
	 */
	private function getBaseUrl()
	{
		return $this->repos[$this->repo[3]] ?? $this->repos['github.com'];
	}


}
