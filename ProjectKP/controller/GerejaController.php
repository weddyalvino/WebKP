<?php
class GerejaController
{
    private $gerejaDaoImplement;
    function __construct()
    {
        $this->gerejaDaoImplement = new GerejaDaoImpl();
    }
    
	public function optionGereja()
	{
		$result = $this->gerejaDaoImplement->fetchGereja();
		require_once 'pengajuan_AK.php';
	}
}