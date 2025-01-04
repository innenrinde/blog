<?php

class Charts extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		/*check_login($this->session);*/
		
		$this->load->model('charts_model');
		$this->load->model('newscategories_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'FERMA DE DATE - Lista de grafice';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/chrts");
		$pagination['total_rows'] = $this->charts_model->count_charts();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['charts'] = $this->charts_model->get_charts(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('charts/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă un grafic în Ferma de date';
		$data['item'] = $this->charts_model->init_charts();
		$data['xAxisName_labels'] = "";
        $data['xAxisName_values'] = "";
        
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['title'] = $this->input->post('title');
			$data['item']['headline'] = $this->input->post('headline');
			$data['item']['note'] = $this->input->post('note');
			$data['item']['description'] = $this->input->post('description');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['date'] = $this->input->post('date');
			$data['item']['id_news_category'] = $this->input->post('id_news_category');
			$json_paletteColors = $this->input->post('json_paletteColors');
			$json_seriesName = $this->input->post('json_seriesName');
			$labels = $this->input->post('xAxisName_labels');
			$values = $this->input->post('xAxisName_values');
			
			// prepare values - pentru multiseries
            $xAxisName_labels = array();
            $xAxisName_values = array();
            if(strlen($labels) > 0) {
                $xAxisName_labels = explode("\n", $labels);
            }
            if(sizeof($values) > 0) {
                foreach($values as $i=>$v) {
                    if(strlen($v) > 0) {
                        $xAxisName_values[] = explode("\n", $v);
                    }
                    else {
                        $xAxisName_values[] = array();
                    }
                }
            }
            
			/* prepare date time */
			$array = explode(" ", $data['item']['date']);
			if(sizeof($array) == 2) {
				$array1 = explode(".", $array[0]);
				$array2 = explode(":", $array[1]);
				
				$data['item']['date'] = $array1[2]."-".$array1[1]."-".$array1[0]." ".$array[1].":00";
			}
			else {
				$data['item']['date'] = "";
			}
			
			/* get json info */
			$json = $this->input->post('json');
			
			$data['item']['json'] = $this->charts_model->json_model();
			$data['item']['json']['type'] = $data['item']['type'] = $json['type'];
			$data['item']['json']['width'] = $json['width'];
			$data['item']['json']['height'] = $json['height'];
			$data['item']['json']['dataSource']['chart']['caption'] = $data['item']['title'];
			$data['item']['json']['dataSource']['chart']['subCaption'] = $json['dataSource']['chart']['subCaption'];
			$data['item']['json']['dataSource']['chart']['xAxisName'] = $json['dataSource']['chart']['xAxisName'];
			$data['item']['json']['dataSource']['chart']['yAxisName'] = $json['dataSource']['chart']['yAxisName'];
			$data['item']['json']['dataSource']['chart']['paletteColors'] = implode(",", $json_paletteColors); // $json['dataSource']['chart']['paletteColors'];
			$data['item']['json']['dataSource']['chart']['bgColor'] = $json['dataSource']['chart']['bgColor'];
			$data['item']['json']['dataSource']['chart']['valueFontColor'] = $json['dataSource']['chart']['valueFontColor'];
			$data['item']['json']['dataSource']['chart']['numberPrefix'] = $json['dataSource']['chart']['numberPrefix'];
            $data['item']['json']['dataSource']['chart']['numberSuffix'] = $json['dataSource']['chart']['numberSuffix'];
            $data['item']['json']['dataSource']['chart']['rotatevalues'] = isset($json['dataSource']['chart']['rotatevalues']) ? $json['dataSource']['chart']['rotatevalues'] : 0;
            
			//$data['item']['json']['dataSource']['data'] = array();
			
			// pentru serie simpla
			/*
			if(strlen($xAxisName_labels) > 0) {
			    $xAxisName_labels = explode("\n", $xAxisName_labels);
			    $xAxisName_values = explode("\n", $xAxisName_values);
			    foreach($xAxisName_labels as $i => $v) {
			        $value = isset($xAxisName_values[$i]) ? $xAxisName_values[$i] : 0;
			        $data['item']['json']['dataSource']['data'][] = array(
			                                                                "label" => $v,
                                                                            "value" => $value
			                                                            );
			    }
			}
			*/
			// pentru multiseries
            $data['item']['json']['dataSource']['categories'] = array();
            $values = array();
            foreach($xAxisName_labels as $i=>$v) {
                $value = isset($xAxisName_values[$i]) ? $xAxisName_values[$i] : 0;
                $values[] = array(
                                    "label" => $v
                                );
            }
            $data['item']['json']['dataSource']['categories'][] = array("category" => $values);
            
            $data['item']['json']['dataSource']['dataset'] = array();
            foreach($xAxisName_values as $i=>$v) {
                $values = array();
                if(sizeof($v) > 0) {
                    foreach($v as $ii => $vv) {
                        $values[] = array("value" => $vv);
                    }
                    $data['item']['json']['dataSource']['dataset'][] = array(
                                                                "seriesname" => $json_seriesName[$i],
                                                                "data" => $values
                                                            );
                }
            }
            
			$this->form_validation->set_rules('title', 'Titlu', 'trim|required');
			//$this->form_validation->set_rules('email', 'Email', 'valid_email');
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->charts_model->save_charts($data['item']);
				
				redirect(base_url(array("admin.php", "charts")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre grafic';
			$data['item'] = $this->charts_model->get_charts($id);
			$data['item']['json'] = unserialize($data['item']['json']);
			if($data['item']['date'] != "0000-00-00 00:00:00") {
			    $data['item']['date'] = date("d.m.Y H:i", strtotime($data['item']['date']));
			}
		}
		
		// prepare values / data series / pentru single series
		/*
        $xAxisName_labels = array();
        $xAxisName_values = array();
        foreach($data['item']['json']['dataSource']['data'] as $i=>$v) {
            $xAxisName_labels[] = $v['label'];
            $xAxisName_values[] = $v['value'];
        }
        $data['xAxisName_labels'] = implode("\n", $xAxisName_labels);
        $data['xAxisName_values'] = implode("\n", $xAxisName_values);
        */
        
        // pentru multiseries - etichete
        $xAxisName_labels = array();
        if(isset($data['item']['json']['dataSource']['categories'])) {
            $category = current(current($data['item']['json']['dataSource']['categories']));
            foreach($category as $i=>$v) {
                $xAxisName_labels[] = $v['label'];
            }
        }
        $data['xAxisName_labels'] = implode("\n", $xAxisName_labels);
        
        // pentru multiseries - valori
        $data['xAxisName_values'] = array();
        $data['json_seriesName'] = array();
        if(isset($data['item']['json']['dataSource']['dataset'])) {
            foreach($data['item']['json']['dataSource']['dataset'] as $i=>$v) {
                //p($v);
                $data['json_seriesName'][] = $v['seriesname'];
                $values = array();
                foreach($v['data'] as $ii=>$vv) {
                    $values[] = $vv['value'];
                }
                $data['xAxisName_values'][] = implode("\n", $values);
            }
        }
        
        // culori
        $data['json_paletteColors'] = explode(",", $data['item']['json']['dataSource']['chart']['paletteColors']);
        
        
        // categories
        $categories = $this->newscategories_model->get_categories_tree(array('a.type' => 'chart'));
		$data['categories'] = array();
		if(isset($categories['childs'])) {
			$data['categories'] = $categories['childs'];
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('charts/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id');
		if($id > 0) {
			$this->charts_model->delete_charts($id);
		}
	}
	
	public function preview() {
		$title = $this->input->post('title');
		$json_post = $this->input->post('json');
		$json_paletteColors = $this->input->post('json_paletteColors');
		$json_seriesName = $this->input->post('json_seriesName');
		$labels = $this->input->post('xAxisName_labels');
		$values = $this->input->post('xAxisName_values');
		
		// prepare values
		$xAxisName_labels = array();
		$xAxisName_values = array();
		if(strlen($labels) > 0) {
		    $xAxisName_labels = explode("\n", $labels);
		}
		if(sizeof($values) > 0) {
		    foreach($values as $i=>$v) {
		        if(strlen($v) > 0) {
		            $xAxisName_values[] = explode("\n", $v);
		        }
		        else {
		            $xAxisName_values[] = array();
		        }
		    }
		}
		
		$json = $this->charts_model->json_model();
		//unset($json['dataSource']['data']);
		$json['type'] = $json_post['type'];
		$json['width'] = $json_post['width'];
		$json['height'] = $json_post['height'];
		$json['dataSource']['chart']['caption'] = $title;
		$json['dataSource']['chart']['subCaption'] = $json_post['dataSource']['chart']['subCaption'];
		$json['dataSource']['chart']['xAxisName'] = $json_post['dataSource']['chart']['xAxisName'];
		$json['dataSource']['chart']['yAxisName'] = $json_post['dataSource']['chart']['yAxisName'];
		$json['dataSource']['chart']['paletteColors'] = implode(",", $json_paletteColors); //$json_post['dataSource']['chart']['paletteColors'];
		$json['dataSource']['chart']['bgColor'] = $json_post['dataSource']['chart']['bgColor'];
		$json['dataSource']['chart']['valueFontColor'] = $json_post['dataSource']['chart']['valueFontColor'];
		$json['dataSource']['chart']['numberPrefix'] = $json_post['dataSource']['chart']['numberPrefix'];
		$json['dataSource']['chart']['numberSuffix'] = $json_post['dataSource']['chart']['numberSuffix'];
		$json['dataSource']['chart']['rotatevalues'] = isset($json_post['dataSource']['chart']['rotatevalues']) ? 1 : 0;
		
		// pentru grafice simple
		/*
		$json['dataSource']['data'] = array();
		foreach($xAxisName_labels as $i=>$v) {
		    $value = isset($xAxisName_values[$i]) ? $xAxisName_values[$i] : 0;
		    $json['dataSource']['data'][] = array(
		                                            "label" => $v,
													"value" => $value
		                                        );
		}
		*/
		
		// pentru multiseries
		$json['dataSource']['categories'] = array();
		$values = array();
		foreach($xAxisName_labels as $i=>$v) {
		    $value = isset($xAxisName_values[$i]) ? $xAxisName_values[$i] : 0;
		    $values[] = array(
                                "label" => $v
                            );
        }
        $json['dataSource']['categories'][] = array("category" => $values);
		
		$json['dataSource']['dataset'] = array();
		foreach($xAxisName_values as $i=>$v) {
            $values = array();
            if(sizeof($v) > 0) {
                foreach($v as $ii => $vv) {
                    $values[] = array("value" => $vv);
                }
                $json['dataSource']['dataset'][] = array(
                                                            "seriesname" => $json_seriesName[$i],
                                                            "data" => $values
                                                        );
            }
        }
		
		$response['json'] = $json;
		print json_encode($response);
	}
}