<?php
namespace TOOL\core\analysis;

class CreateGrafics {

	public $vnytr_vs_vnesh 					= false;
	public $grafica_nofollow_vs_follow 		= false;
	//public $adress_one = false;
	//public $adress_one = false;
	
	public function __construct ($data_array, $dir, $name) {
		
		if (isset($data_array['vnytr']) && is_array($data_array['vnytr']) && isset($data_array['vnesh']) && is_array($data_array['vnesh'])) {
			$write_file = $dir.DIR_SEPARATOR.$name.'_vnytr_vs_vnesh.png';
			$this->do_graphic ($write_file, array (count($data_array['vnytr']), count($data_array['vnesh'])));
			if (is_file($write_file)) {
				$this->vnytr_vs_vnesh = 'img'.DIR_SEPARATOR.$name.'_vnytr_vs_vnesh.png';
			}
			
			if(count($data_array['vnesh'])>0) {
				$buf_nofollow = 0;
				$buf_follow = 0;
				for ($i=0; $i<count($data_array['vnesh']); $i++) {
					if ($data_array['vnesh'][$i]['nofollow']===true) {
						$buf_nofollow ++;
					} else {
						$buf_follow ++;
					}
				}
				$write_file = $dir.DIR_SEPARATOR.$name.'_grafica_nofollow_vs_follow.png';
				$this->do_graphic ($write_file, array ($buf_nofollow,$buf_follow));
				if (is_file($write_file)) {
					$this->grafica_nofollow_vs_follow = 'img'.DIR_SEPARATOR.$name.'_grafica_nofollow_vs_follow.png';
				}
			}
			
			
		}
		
	}
	
	private function do_graphic ($write_file, $arr) {
		
		/* Create and populate the pData object */
		$MyData = new \pData();   
		$MyData->addPoints($arr,"ScoreA");  
		$MyData->setSerieDescription("ScoreA","Application A");
		/* Define the absissa serie */
		$MyData->addPoints(array('',''),"Labels");
		$MyData->setAbscissa("Labels");
		/* Create the pChart object */
		$myPicture = new \pImage(540,380,$MyData,TRUE);
		/* Set the default font properties */ 
		$myPicture->setFontProperties(array("FontName"=>DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'pChart2'.DIR_SEPARATOR.'fonts'.DIR_SEPARATOR.'Forgotte.ttf',"FontSize"=>52,"R"=>25,"G"=>25,"B"=>25));
		/* Create the pPie object */ 
		$PieChart = new \pPie($myPicture,$MyData);
		$PieChart->setSliceColor(0,array("R"=>50,"G"=>100,"B"=>34));
		$PieChart->setSliceColor(1,array("R"=>102,"G"=>0,"B"=>17));
		/* Enable shadow computing */ 
		$myPicture->setShadow(TRUE,array("X"=>5,"Y"=>5,"R"=>44,"G"=>44,"B"=>44,"Alpha"=>30));
		/* Draw a splitted pie chart */ 
		$PieChart->draw3DPie(270,190,array("WriteValues"=>TRUE,"Radius"=>250,"DataGapAngle"=>3,"DataGapRadius"=>26,"Border"=>TRUE, "SliceHeight"=>45));
		/* Write the legend box */ 
		$myPicture->setFontProperties(array("FontName"=>DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'pChart2'.DIR_SEPARATOR.'fonts'.DIR_SEPARATOR.'Silkscreen.ttf',"FontSize"=>32,"R"=>105,"G"=>105,"B"=>105));
		//$PieChart->drawPieLegend(140,160,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));
		/* Render the picture (choose the best way) */
		$myPicture->Render($write_file);
		
		unset ($MyData);
		unset ($myPicture);
		
		
		/*
		Example10 : A 3D exploded pie graph
		
		$DataSet = new \pData;
		$DataSet->AddPoint($arr,"Serie1");
		$DataSet->AddPoint($arr,"Serie2");
		$DataSet->AddAllSeries();
		$DataSet->SetAbsciseLabelSerie("Serie2");
		// Initialise the graph
		$Graph = new \pChart(600,260);
		
		//$Graph->drawTextBox(0,0,600,260,'',0,255,255,255,ALIGN_LEFT,TRUE,255,255,255,50);
		//$Graph->drawFilledRectangle(0,0,600,260,255,255,255,FALSE,10);
		//$Graph->drawGraphArea(250,250,250,0); 
		//$Graph->drawBackground(255,255,255); 
		//$Graph->drawFilledRoundedRectangle(7,7,413,243,5,240,240,240);
		//$Graph->drawRoundedRectangle(5,5,415,245,5,230,230,230);
		$Graph->createColorGradientPalette(32,96,62,230,10,24,2);
		// Draw the pie chart
		$Graph->setFontProperties(DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'pChart'.DIR_SEPARATOR.'Fonts'.DIR_SEPARATOR.'tahoma.ttf',16);
		//$Graph->AntialiasQuality = 0;
		//drawPieGraph($Data,$DataDescription,$XPos,$YPos,$Radius=100,$DrawLabels=PIE_NOLABEL,$EnhanceColors=TRUE,$Skew=60,$SpliceHeight=20,$SpliceDistance=0,$Decimals=0) 
		$Graph->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),300,115,115,PIE_PERCENTAGE_LABEL,TRUE,60,25,3,0);
		//$Graph->drawPieLegend(330,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
		// Write the title
		//$Graph->setFontProperties("Fonts/MankSans.ttf",10);S
		//$Graph->drawTitle(10,20,"Sales per month",100,100,100);
		$Graph->Render($write_file);
		
		unset ($Test);
		unset ($DataSet);
		
		*/
	}


}

?>