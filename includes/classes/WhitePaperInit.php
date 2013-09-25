<?php
	class WhitePaperInit
	{
		public $whitePaper_Folder = "";
		public $whitePaper_URL = "";
		public $whitePaper_FilePath = "";
		public $whitePaper_DirName = "";
		public $whitePaper_siteURL = "";
		
		function __construct($folder, $url, $filePath, $dirName, $siteURL) 
		{
			$this->whitePaper_Folder = $folder;
			$this->whitePaper_URL = $url;
			$this->whitePaper_FilePath = $filePath;
			$this->whitePaper_DirName = $dirName;
			$this->whitePaper_siteURL = $siteURL;
		}

		public function get_folder()
		{
			return $this->whitePaper_Folder;
		}
		
		public function get_url()
		{
			return $this->whitePaper_URL;
		}
		
		public function get_filePath()
		{
			return $this->whitePaper_FilePath;
		}
		
		public function get_dirName()
		{
			return $this->whitePaper_DirName;
		}
		
		public function get_siteURL()
		{
			return $this->whitePaper_siteURL;
		}
	}
?>