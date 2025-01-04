<?php

class Newsletter extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		
		$this->load->model('newsletter_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Adrese de e-mail înscrise la newsletter';
		
		/* filters */
		$this->filters->set(array(
									'email' => array('type' => 'text', 'title' => 'E-mail', 'fields' => 'a.email'),
									'confirmed' => array('type' => 'select', 'title' => 'Confirmat', 'fields' => 'a.confirmed', 'values' => array(0=>'Nu', 1=>'Da')),
									'date' => array('type' => 'date', 'title' => 'Data confirmării', 'fields' => 'a.date_confirmed')
								)
							);
		$data['filters'] = $this->filters->html();
		/* END filters */
		
		if($this->input->post('search')) {
			$params = $this->filters->get($this->input->post());
			redirect(base_url(array("admin.php", "newsletter"))."?".$params);
		}
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/newsletter");
		$pagination['total_rows'] = $this->newsletter_model->count_newsletter($this->filters->where());
		$this->cpagination->initialize($pagination);
		/* END pagination */
		
		$data['newsletter'] = $this->newsletter_model->get_newsletter(0, $pg, $pagination['per_page'], $this->filters->where(), $this->sort->get());
		
        $this->load->view('templates/header', $data);
        $this->load->view('newsletter/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o adresă de e-mail la newsletter';
		$data['item'] = $this->newsletter_model->init_newsletter();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['email'] = $this->input->post('email');
			$data['item']['confirmed'] = $this->input->post('confirmed');
			
			//$this->form_validation->set_rules('email', 'Email', 'valid_email|[newsletter.email]');
			$this->form_validation->set_rules('email', 'Email', 'valid_email');
			$this->form_validation->set_message('valid_email', 'Adresa de e-mail introdusa este invalida!');
			//$this->form_validation->set_message('is_unique', 'Adresa de e-mail exista deja in baza de date!');
			
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->newsletter_model->save_newsletter($data['item']);
				
				redirect(base_url(array("admin.php", "newsletter")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre adresa de e-mail';
			$data['item'] = $this->newsletter_model->get_newsletter($id);
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('newsletter/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id');
		if($id > 0) {
			$this->newsletter_model->delete_newsletter($id);
		}
	}
	
	public function export() {
		$this->load->library('XLSClasses/PHPExcel.php');
		
		$emails = $this->newsletter_model->get_newsletter(0);
		
		$objWorksheet_fromArray = array();
		$objWorksheet_fromArray[] = array("", "E-mail", "Confirmat", "Data confirmare", "Data nscriere");
		foreach($emails as $i=>$v) {
			$objWorksheet_fromArray[] = array($i+1, $v['email'], $v['confirmed'], date("d.m.Y H:i:s", strtotime($v['date_confirmed'])), date("d.m.Y H:i:s", strtotime($v['date_registered'])));
		}
		
		$objPHPExcel = new PHPExcel();
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->fromArray($objWorksheet_fromArray);
		
		$objWorksheet->getColumnDimension('B')->setWidth(50);
		$objWorksheet->getColumnDimension('C')->setWidth(10);
		$objWorksheet->getColumnDimension('D')->setWidth(20);
		$objWorksheet->getColumnDimension('E')->setWidth(20);
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="newsletter.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		
	}
}