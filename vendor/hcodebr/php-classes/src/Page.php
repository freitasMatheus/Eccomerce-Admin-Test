<?php 

namespace Hcode;

use Rain\Tpl;
/*
* Class Page 
*/

class Page
{
	private $tpl; // Objetc from TPL Class
	private $options  = []; // Options for my class
	private $defaults = ["data"=>[]]; // IF not sent any opt in Construct

	/*
	* Function Construct
	* Set common configurations
	* Start and Draw header.php in /viwes/
	*/
	public function __construct($opts = array())
	{
		$this->options = array_merge($this->defaults, $opts);

		$config = array(
			"tpl_dir" 	=> $_SERVER["DOCUMENT_ROOT"]."/views/" ,
			"cache_dir" => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"		=> false  
		);

		Tpl::configure($config);

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");

	}

	/* Function setTpl
	* This function get the name of your HTML documment,
	* get options *IF Exists*
	* Can Return the HTML Page IF you want
	*/

	public function setTpl($name, $data = array(), $returnHtml = false)
	{
		$this->setData($data);

		return $this->tpl->draw($name, $returnHtml);

	}
	/* Function Destruct
	* Destroy Objetct and draw Footer
	*/
	public function __destruct()
	{
		$this->tpl->draw("footer");
	}

	/* Function setData
	* Only get an array with data and assign in Tpl
	*/
	private function setData($data = array())
	{
		foreach ($data as $key => $value)
		{
			$this->tpl->assign($key, $value);
		}
	}
}

?>