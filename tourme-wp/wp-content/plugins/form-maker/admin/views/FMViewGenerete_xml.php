<?php

class FMViewGenerete_xml {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $model;

  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct($model) {
    $this->model = $model;
  }
  
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function display() {
	$params = $this->model->get_data();
	$limitstart = (int)$_REQUEST['limitstart'];
	$send_header = (int)$_REQUEST['send_header'];
	$data = $params[0];
	$title = $params[1]; 
	
	if(!file_exists(WD_FM_DIR . '/export'))
		mkdir(WD_FM_DIR . '/export' , 0777);
	
	if(file_exists(WD_FM_DIR . '/export/export.txt') && $limitstart == 0){
		unlink(WD_FM_DIR . '/export/export.txt');
	}
	
	define('PHP_TAB', "\t");
	$output = fopen(WD_FM_DIR . '/export/export.txt', "a");
	if($limitstart == 0) {
		fwrite($output, '<?xml version="1.0" encoding="utf-8" ?>'.PHP_EOL);
		fwrite($output, '<form title="'.$title.'">'.PHP_EOL);
	}	
	
	foreach ($data as $key1 => $value1) {
		fwrite($output, PHP_TAB.'<submission id="'.$key1.'">'.PHP_EOL);
		foreach ($value1 as $key => $value) {
			fwrite($output, PHP_TAB.PHP_TAB.'<field title="'.$key.'">'.PHP_EOL);
			fwrite($output, PHP_TAB.PHP_TAB.PHP_TAB.'<![CDATA['.$value.']]>'.PHP_EOL);
			fwrite($output, PHP_TAB.PHP_TAB.'</field>'.PHP_EOL);
		}
		fwrite($output, PHP_TAB.'</submission>'.PHP_EOL);
	}
	
	if($send_header == 1){
		fwrite($output, '</form>');
		fclose($output);
		$filename = $title . "_" . date('Ymd') . ".xml";
		header('Content-Encoding: Windows-1252');
		header('Content-type: text/xml; charset=utf-8');
		header("Content-Disposition: attachment; filename=\"$filename\"");
		
		$exported = copy(WD_FM_DIR . '/export/export.txt', "php://output");
		die(); 
	} 
	
  }

  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}