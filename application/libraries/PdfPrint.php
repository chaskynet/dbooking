<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."libraries/PdfJs.php";

/**
* 
*/
class PdfPrint extends PdfJs 
{
	
	

	public function AutoPrint($dialog=false)
	{
		//Open the print dialog or start printing immediately on the standard printer
		
		$param=($dialog ? 'true' : 'false');
		$script.="print($param);";
		$this->IncludeJS($script);

	}

	public function AutoPrintToPrinter($server, $printer, $dialog=false)
	{
		//Print on a shared printer (requires at least Acrobat 6)
		$script = "var pp = getPrintParams();";
		if($dialog)
			$script .= "pp.interactive = pp.constants.interactionLevel.full;";
		else
			$script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
		$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
		$script .= "print(pp);";
		$this->IncludeJS($script);
	}
}
