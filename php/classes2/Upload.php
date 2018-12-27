<?php
class Upload
{

	private $fileName , $fileSize , $fileTemp , $fileType , $fileExtention;
	private $fileNameUploaded;
	private $requiredExtention = [];
	private $errors = [];

	public function __construct($filename , $tempname)
	{
		$this->fileName = $filename;
		$this->fileTemp = $tempname;
	}


	private function getFileName()
	{
		return $this->fileName;
	}

	public function setFileNameUploaded($name)
	{
		$this->fileNameUploaded = $name;
	}


	private function getFileNameUploaded()
	{
		return $this->fileNameUploaded;
	}


	private function getFileSize()
	{
		return $_FILES[$this->getFileName()]['size'];
	}

	private function getFileTemp()
	{
		return $this->fileTemp;
	}


	private function getFileType()
	{
		return $_FILES[$this->getFileName()]['type'];
	}

	private function getFileExtension()
	{
		$fileExtentionExplode = explode('.', $this->getFileName());
		$fileExtention = strtolower(end($fileExtentionExplode));
		return $fileExtention;
	}

	public function setRequiredExtension($extensions)
	{
		foreach ($extensions as $extension) 
		{
			$this->requiredExtention[]  = $extension;	
		}
	}

	private function getRequiredExtension()
	{
		return $this->requiredExtention;	
	}

	public function setError($error)
	{
		$this->errors[] = $error;
	}

	public function getError()
	{
		return $this->errors;
	}

	public function checkExtensionExist()
	{
		if(in_array($this->getFileExtension(),$this->getRequiredExtension()) === true)
		{
         	return true;
      	}

		return false;
	}


	public function uploadFile($location)
	{
		if(!empty($this->getFileNameUploaded()) )
		{
			
			$result = move_uploaded_file($this->getFileTemp(), $location . $this->getFileNameUploaded() . '.' . $this->getFileExtension() );
		}
		else
		{
		
			$result = move_uploaded_file($this->getFileTemp(), $location . $this->getFileName() );
		}

		if($result)
		{
			return true;
		}
		return false;
	}



	public function checkFileExist($location )
	{
		if(!empty($this->getFileNameUploaded()))
		{
			if(file_exists($location . $this->getFileNameUploaded()))
			{
				return true;
			}
		}
		else
		{
			if(file_exists($location . $this->getFileName()))
			{
				return true;
			}
		}
		return false;
	}






}//class Upload end 


 ?>