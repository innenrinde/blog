<?php

class Charts_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_charts() {
	    $json = $this->json_model();
		return array('id'=>0,
		            'title'=>"Titlul graficului",
		            'type' => '',
                    'headline' => '',
                    'note' => '',
                    'description' => '',
                    'enabled' => '1',
                    'date' => '',
                    'id_news_category' => 0,
		            'json' => $json);
	}
	
	public function json_model() {
		// http://www.fusioncharts.com/dev/getting-started/list-of-charts.html
	    $json = array();
        $json['renderAt'] = 'chart-container';
        $json['type'] = 'msline'; // line, area2d, bar2d, column2d
        $json['width'] = '100%';
        $json['height'] = '400';
        $json['dataFormat'] = 'json';
        $json['dataSource']['chart'] = array("caption" => "",
                                                "subCaption" => "Subtitlul graficului",
                                                "xAxisName" => "Denumire axa X",
                                                "yAxisName" => "Denumire Axa Y",
                                                "numberPrefix" => "",
                                                "numberSuffix" => "",
                                                "paletteColors" => "#0075c2,#1aaf5d,#f2c500,#cc0000,#7d7d7d",
                                                "bgColor" => "#ffffff",
                                                "borderAlpha" => "20",
                                                "canvasBorderAlpha" => "0",
                                                "canvasBgAlpha" => "0",
                                                "usePlotGradientColor" => "0",
                                                "plotBorderAlpha" => "10",
                                                "placevaluesInside" => "1",
                                                "rotatevalues" => "0",
                                                "valueFontColor" => "#767676",
                                                "showXAxisLine" => "1",
                                                "xAxisLineColor" => "#999999",
                                                "divlineColor" => "#999999",
                                                "divLineIsDashed" => "1",
                                                "showAlternateHGridColor" => "0",
                                                "subcaptionFontBold" => "0",
                                                "subcaptionFontSize" => "14",
                                                "formatNumberScale" => 0,
                                                "formatNumber" => 1,
                                                "decimalSeparator" => ",",
                                                "thousandSeparator" => "."
                                            );
        // categorii
        $json['dataSource']['categories'][] = array(
                                                    "category" => array(
                                                                            array("label" => 'eticheta1'),
                                                                            array("label" => 'eticheta2'),
                                                                            array("label" => 'eticheta3'),
                                                                            array("label" => 'eticheta4'),
                                                                            array("label" => 'eticheta5'),
                                                                            array("label" => 'eticheta6'),
                                                                            array("label" => 'eticheta7'),
                                                                            array("label" => 'eticheta8'),
                                                                            array("label" => 'eticheta9')
                                                                        )
                                                );
        
        $json['dataSource']['dataset'][] = array(
                                                    "seriesname" => 'Serie 1',
                                                    "data" => array(
                                                                        array("value" => 57),
                                                                        array("value" => 52),
                                                                        array("value" => 61),
                                                                        array("value" => 11),
                                                                        array("value" => 34),
                                                                        array("value" => 27),
                                                                        array("value" => 20),
                                                                        array("value" => 23),
                                                                        array("value" => 14),
                                                                    )
                                                );
        
        $json['dataSource']['dataset'][] = array(
                                                    "seriesname" => 'Serie 2',
                                                    "data" => array(
                                                                        array("value" => 47),
                                                                        array("value" => 42),
                                                                        array("value" => 71),
                                                                        array("value" => 16),
                                                                        array("value" => 28),
                                                                        array("value" => 17),
                                                                        array("value" => 10),
                                                                        array("value" => 25),
                                                                        array("value" => 4),
                                                                    )
                                                );
        
        // pentru grafice simple
        /*
        $json['dataSource']['data'] = array(
                                            array(
                                                    "label" => "eticheta1",
                                                    "value" => "57"
                                                ),
                                            array(
                                                    "label" => "eticheta2",
                                                    "value" => "52",
                                                    "paletteColors" => "#cc254c"
                                                ),
                                            array(
                                                    "label" => "eticheta3",
                                                    "value" => "61"
                                                ),
                                            array(
                                                    "label" => "eticheta4",
                                                    "value" => "11"
                                                ),
                                            array(
                                                    "label" => "eticheta5",
                                                    "value" => "34"
                                                ),
                                            array(
                                                    "label" => "eticheta6",
                                                    "value" => "27"
                                                ),
                                            array(
                                                    "label" => "eticheta7",
                                                    "value" => "20"
                                                ),
                                            array(
                                                    "label" => "eticheta8",
                                                    "value" => "23"
                                                ),
                                            array(
                                                    "label" => "eticheta9",
                                                    "value" => "14"
                                                )
                                        );
        */
        
        return $json;
	}
	
	public function get_charts($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*, b.title AS category_name');
			$this->db->from('charts AS a');
			$this->db->join('news_categories AS b', 'a.id_news_category=b.id', 'left');
			$this->db->order_by("a.date", "desc");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('charts', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_charts($charts = array()) {
		$data = array(
			'title' => $charts['title'],
			'type' => $charts['type'],
			'headline' => $charts['headline'],
			'note' => $charts['note'],
			'description' => $charts['description'],
			'enabled' => $charts['enabled'],
			'date' => $charts['date'],
			'json' => serialize($charts['json']),
			'id_news_category' => $charts['id_news_category']
		);
		
		if($charts['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $charts['id']);
			$this->db->update('charts', $data);
			
			return $charts['id'];
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('charts', $data);
			
			return $this->db->insert_id();
		}
		return;
	}
	
	public function count_charts() {
		return $this->db->count_all('charts');
	}
	
	public function delete_charts($id) {
		$this->db->delete('charts', array('id' => $id));
	}
}