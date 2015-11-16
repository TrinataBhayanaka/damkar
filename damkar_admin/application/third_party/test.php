<?php
/**
 * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
 */
	header('Content-Type: text/plain');

	// if (isset($argv[1]))
	// {
	// 	$Filepath = $argv[1];
	// }
	// elseif (isset($_GET['File']))
	// {
	// 	$Filepath = $_GET['File'];
	// }
	// else
	// {
	// 	if (php_sapi_name() == 'cli')
	// 	{
	// 		echo 'Please specify filename as the first argument'.PHP_EOL;
	// 	}
	// 	else
	// 	{
	// 		echo 'Please specify filename as a HTTP GET parameter "File", e.g., "/test.php?File=test.xlsx"';
	// 	}
	// 	exit;
	// }
function pr($d){
	echo"<pre>";
	print_r($d);
	echo"</pre>";
}
	// Excel reader from http://code.google.com/p/php-excel-reader/
	require('php-excel-reader/excel_reader2.php');
	require('SpreadsheetReader.php');

	  $Reader = "damkar.xlsx";
	  // pr($Reader);
	// try
	// {
		$Spreadsheet = new SpreadsheetReader($Reader);
		
		 $Sheets = $Spreadsheet -> Sheets();

// $numRows = $Sheets['numRows']; // ex: 14
// $numCols = $Sheets['numCols']; // ex: 4

// pr($Spreadsheet);
// pr($numCols);
    foreach ($Sheets as $Index => $Name)
    {
        echo 'Sheet #'.$Index.': '.$Name;

        $Spreadsheet -> ChangeSheet($Index);

        foreach ($Spreadsheet as $Row)
        {
            print_r($Row);
        }
    }
		
	// }
	// catch (Exception $E)
	// {
	// 	echo $E -> getMessage();
	// }
?>
