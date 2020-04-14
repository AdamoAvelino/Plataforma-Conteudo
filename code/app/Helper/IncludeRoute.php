<?php

namespace App\Helper;

class IncludeRoute
{

	private $files_default = ['api.php', 'channels.php', 'console.php', 'web.php'];

	function __construct($pathDirectory){

		$this->includeRoutes($pathDirectory);
	}

	function includeRoutes($pathDirectory)
	{
		foreach(new \DirectoryIterator($pathDirectory) as $file) {

			$role_files = in_array($file->getFileName(), $this->files_default);
			$role_extension = ($file->isFile() and $file->getExtension() !== 'php');
			$role_dir  = substr($file->getFileName(), 0, 1) == '.';

			// echo $file->getFileName().'<br>';
			// echo substr($file->getFileName(), 0, 1).'<br>';

			if($role_files or $role_extension or $role_dir){
				continue;
			}

			if($file->isDir()) {
				$this->includeRoutes($file->getPathName());
				continue;
			}
			include_once($file->getPathName());
		}
	}
}
