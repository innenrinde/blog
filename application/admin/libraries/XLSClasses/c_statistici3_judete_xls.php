<?php
	
	if(!(isset($_SESSION['skey']) && $_SESSION['skey'] == "stats3")) {
		header("Location: ../../admin.php");
	}
	
	require_once('XLSClasses/PHPExcel.php');
	
	$data = array();
	$data['data_start'] = isset($_GET["data_start"]) ? $_GET["data_start"] : date("Y-m-d", strtotime(date("Y")."-01-01"));
	$data['data_end'] = isset($_GET["data_end"]) ? $_GET["data_end"] : date("Y-m-d", strtotime($data['data_start']) + 366*24*60*60);
	$data['id_judet'] = isset($_GET["id_judet"]) ? $_GET["id_judet"] : 0;
	$data['id_cotizatie'] = isset($_GET["id_cotizatie"]) ? $_GET["id_cotizatie"] : 0;
	
	
	if($data['id_judet'] == 0) {
		$chart_title = "";
		if($data['id_cotizatie'] > 0) {
			
			$cotizatie = db::Row("SELECT * FROM #cotizatii WHERE id='".$data['id_cotizatie']."'");
			$chart_title = 'Bugetul încasat din '.htmlspecialchars($cotizatie['denumire']).' ('.date("d.m.Y", strtotime($data['data_start'])).' - '.date("d.m.Y", strtotime($data['data_end'])).')';
			
			$res = db::Query("SELECT c.judet, c.id_judet, SUM(a.valoare) AS incasat
									FROM #asistenti_cotizatii AS a
									LEFT JOIN #asistenti AS b ON a.id_asistent=b.id
									LEFT JOIN _judete AS c ON b.id_judet=c.id_judet
									WHERE a.data>='".$data['data_start']."' AND a.data<='".$data['data_end']."' AND a.id_cotizatie=".$data['id_cotizatie']."
									GROUP BY c.id_judet
									ORDER BY c.judet ASC");
		}
		else {
			$chart_title = 'Bugetul încasat din cotizaţii ('.date("d.m.Y", strtotime($data['data_start'])).' - '.date("d.m.Y", strtotime($data['data_end'])).')';
			$res = db::Query("SELECT c.judet, c.id_judet, SUM(a.valoare) AS incasat
									FROM #asistenti_cotizatii AS a
									LEFT JOIN #asistenti AS b ON a.id_asistent=b.id
									LEFT JOIN _judete AS c ON b.id_judet=c.id_judet
									WHERE a.data>='".$data['data_start']."' AND a.data<='".$data['data_end']."'
									GROUP BY c.id_judet
									ORDER BY c.judet ASC");
		}
		
		$data['judete'] = array();
		
		$objWorksheet_fromArray = array();
		$objWorksheet_fromArray[] = array("", "Judeţ", "Suma (lei)");
		
		$nr = 0;
		if(mysql_num_rows($res) > 0) {
			while($r = db::CurrentRow($res)) {
				$nr++;
				$objWorksheet_fromArray[] = array($nr, $r['judet'], floatval(sprintf("%.2f", $r['incasat'])));
			}
		}
		
		
		$objPHPExcel = new PHPExcel();
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->fromArray($objWorksheet_fromArray);
		
		$objWorksheet->setCellValue('C'.($nr+2), '=SUM(C2:C'.($nr+1).')');
		$objWorksheet->getStyle('C'.($nr+2))->getFont()->applyFromArray(array(
																			'name' => 'Arial',
																			'color' => array(
																				'rgb' => 'FF0000'
																			)
																		)
																	);
		
		$dataseriesLabels = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1)
		);
		
		$xAxisTickValues = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$2:$B$'.($nr+1), NULL, 4)
		);
		
		$dataSeriesValues = array(
				new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$'.($nr+1), NULL, 4)
		);
		
		$layout1 = new PHPExcel_Chart_Layout();
		$layout1->setShowVal(TRUE);
		$layout1->setShowPercent(TRUE);
		
		//	Build the dataseries
		$series = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,	// plotGrouping
			range(0, count($dataSeriesValues)-1),			// plotOrder
			$dataseriesLabels,								// plotLabel
			$xAxisTickValues,								// plotCategory
			$dataSeriesValues								// plotValues
		);
		//	Set additional dataseries parameters
		//		Make it a horizontal bar rather than a vertical column graph
		$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);
		
		//	Set the series in the plot area
		$plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
		//	Set the chart legend
		$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
		
		$title = new PHPExcel_Chart_Title($chart_title);
		$yAxisLabel = new PHPExcel_Chart_Title('Suma (lei)');
		
		$xAxisLabel = new PHPExcel_Chart_Title('xAxisLabel');
		
		//	Create the chart
		$chart = new PHPExcel_Chart(
			'chart1',		// name
			$title,			// title
			NULL,			// legend  ---->  $legend
			$plotarea,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel		// yAxisLabel
		);
		
		//	Set the position where the chart should appear in the worksheet
		$chart->setTopLeftPosition('E2');
		$chart->setBottomRightPosition('P'.($nr+10));
		
		//	Add the chart to the worksheet
		$objWorksheet->addChart($chart);
		
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="statistici_cotizatii_judete.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
		//$objWriter->save(ROOT."/files/statistici_cotizatii_judete.xlsx");
	}
	else {
		$row = db::Row("SELECT * FROM #judete WHERE id_judet=".$data['id_judet']);
		$judet = $row['judet'];
		
		$res = db::Query("SELECT DATE_FORMAT(a.data, '%Y') AS an_plata, SUM(a.valoare) AS incasat
										FROM #asistenti_cotizatii AS a
										LEFT JOIN #asistenti AS b ON a.id_asistent=b.id
										WHERE a.data>='".$data['data_start']."' AND a.data<='".$data['data_end']."' AND b.id_judet='".$data['id_judet']."'
										GROUP BY DATE_FORMAT(a.data, '%Y')
										ORDER BY DATE_FORMAT(a.data, '%Y') ASC");
		
		$data['ani'] = array();
		
		$objWorksheet_fromArray = array();
		$objWorksheet_fromArray[] = array("", "An", "Suma (lei)");
		
		$nr = 0;
		if(mysql_num_rows($res) > 0) {
			while($r = db::CurrentRow($res)) {
				$nr++;
				$objWorksheet_fromArray[] = array($nr, $r['an_plata'], floatval(sprintf("%.2f", $r['incasat'])));
			}
		}
		
		$objPHPExcel = new PHPExcel();
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->fromArray($objWorksheet_fromArray);
		
		$objWorksheet->setCellValue('C'.($nr+2), '=SUM(C2:C'.($nr+1).')');
		$objWorksheet->getStyle('C'.($nr+2))->getFont()->applyFromArray(array(
																			'name' => 'Arial',
																			'color' => array(
																				'rgb' => 'FF0000'
																			)
																		)
																	);
		
		$dataseriesLabels = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', NULL, 1)
		);
		
		$xAxisTickValues = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$2:$B$'.($nr+1), NULL, 4)
		);
		
		$dataSeriesValues = array(
				new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$'.($nr+1), NULL, 4)
		);
		
		$layout1 = new PHPExcel_Chart_Layout();
		$layout1->setShowVal(TRUE);
		$layout1->setShowPercent(TRUE);
		
		//	Build the dataseries
		$series = new PHPExcel_Chart_DataSeries(
			PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,	// plotGrouping
			range(0, count($dataSeriesValues)-1),			// plotOrder
			$dataseriesLabels,								// plotLabel
			$xAxisTickValues,								// plotCategory
			$dataSeriesValues								// plotValues
		);
		//	Set additional dataseries parameters
		//		Make it a horizontal bar rather than a vertical column graph
		$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);
		
		//	Set the series in the plot area
		$plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
		//	Set the chart legend
		$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
		
		$title = new PHPExcel_Chart_Title('Bugetul încasat din cotizaţii ('.date("d.m.Y", strtotime($data['data_start'])).' - '.date("d.m.Y", strtotime($data['data_end'])).') - '.$judet);
		$yAxisLabel = new PHPExcel_Chart_Title('Suma (lei)');
		
		$xAxisLabel = new PHPExcel_Chart_Title('xAxisLabel');
		
		//	Create the chart
		$chart = new PHPExcel_Chart(
			'chart1',		// name
			$title,			// title
			NULL,			// legend  ---->  $legend
			$plotarea,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel		// yAxisLabel
		);
		
		//	Set the position where the chart should appear in the worksheet
		$chart->setTopLeftPosition('E2');
		$chart->setBottomRightPosition('Q'.($nr+10));
		
		//	Add the chart to the worksheet
		$objWorksheet->addChart($chart);
		
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="statistici_cotizatii_judete.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
	}
	
	
	exit;
?>
