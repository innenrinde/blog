<?php
class News_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function init_news() {
		return [
			"id"=>0,
			"title" => $this->init_definitions(),
			"subtitle" => $this->init_definitions(),
			"url" => "",
			"date" => "",
			"id_news_category" => "",
			"content_short" => $this->init_definitions(),
			"content" => $this->init_definitions(),
			"seo_keywords" => "",
			"seo_title" => "",
			"seo_description" => "",
			"enabled" => "1",
			"promoted" => "0",
			"id_user" => "1",
			"labels" => "",
			"slider" => "0",
			"home_page" => "0"
		];
	}

	public function get_news($id = FALSE, $current_page = 0, $per_page = 0, $where = array(), $order = array()) {
		if (!$id) {
			$this->db->select('a.*, c.title AS category, b.first_name AS author_name, b.last_name AS author_surname, pi.thumb_image_name');
			$this->db->from('news AS a');
			$this->db->join('news_categories AS c', 'a.id_news_category=c.id', 'left');
			$this->db->join('users AS b', 'b.id=a.id_user', 'left');
			$this->db->join('news_images AS pi', 'pi.id_news=a.id AND pi.main_image=1', 'left');

			if(sizeof($where) > 0) {
			    foreach($where as $i=>$v) {
			    	if(is_array($v)) {
			    		foreach($v as $ii=>$vv) {
			    			$this->db->where($i.' LIKE ', '%'.$vv.'%');
			    		}
			    	}
			    	else {
			    		$this->db->where($i, $v);
			    	}
			    }
			}

			if(sizeof($order) > 0) {
			    foreach($order as $i=>$v) {
			        $this->db->order_by($i, $v);
			    }
			}
			else {
			    $this->db->order_by('a.date', 'desc');
			}
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();

			return $query->result_array();
		}

		$query = $this->db->get_where('news', array('id' => $id));
		return $this->get_definitions(
			$query->row_array(),
			'news',
			['title', 'subtitle', 'content_short', 'content'],
			'id_news');
	}

	public function save_news($news = array()) {
		$data = array(
			'title' => current($news['title']),
			'subtitle' => current($news['subtitle']),
			'url' => $news['url'],
			'date' => $news['date'],
			'id_news_category' => $news['id_news_category'],
			'content_short' => current($news['content_short']),
			'content' => current($news['content']),
			'seo_keywords' => $news['seo_keywords'],
			'seo_title' => $news['seo_title'],
			'seo_description' => $news['seo_description'],
			'enabled' => $news['enabled'],
			'slider' => $news['slider'],
			'promoted' => $news['promoted'],
			'home_page' => $news['home_page'],
			'labels' => $news['labels'],
			'id_user' => $news['id_user']
		);

		if($news['id'] > 0) {
			// daca pun stirea pe prima pagina
			if($news['home_page'] == 1) {
			    $order = $this->get_home_page_order($news['id']);
			    $data['order'] = $order;
			}

		    $data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $news['id']);
			$this->db->update('news', $data);
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('news', $data);
			$news['id'] = $this->db->insert_id();
		}
		$this->save_definitions('news', $news, ['title', 'subtitle', 'content_short', 'content'], 'id_news', $news['id']);
		return $news['id'];
	}


	/**
	 * @param $id_news
	 */
	public function delete_news($id_news)
	{
		$this->delete_definitions('news', 'id_news', $id_news);
		$this->db->delete('news', array('id' => $id_news));
	}


	public function count_news($where = array()) {
		if(sizeof($where) > 0) {
			foreach($where as $i=>$v) {
				if(is_array($v)) {
					foreach($v as $ii=>$vv) {
						$this->db->where($i.' LIKE ', '%'.$vv.'%');
					}
				}
				else {
					$this->db->where($i, $v);
				}
			}
		}

		$this->db->from('news AS a');
		$total = $this->db->count_all_results();
		return $total;
	}

	public function save_order($id_news, $order) {
		$data = array('order' => $order);
		$this->db->where('id', $id_news);
		$this->db->update('news', $data);
	}

	public function remove_home_page($id_news) {
	    $data = array('home_page' => 0);
		$this->db->where('id', $id_news);
		$this->db->update('news', $data);
	}

	protected function get_home_page_order($id) {
	    $news = $this->get_news($id);

	    if($news['home_page'] == 1) {
	        return $news['order'];
	    }
	    else {
	        return 0; // sa apara prima in lista de stiri

	        /*
	        $last_news = $this->get_news(NULL, 0, 0, array('home_page'=>1), array('order'=>'desc'));
	        $last = current($last_news);

	        if(isset($last['order'])) {
	            return $last['order'] + 1;
	        }
	        */
	    }

	    return 1;
	}


	/**
	 * @param $id_news
	 */
	public function assign_images($id_news)
	{
		$this->db->update('news_images', array('id_news' => $id_news), array('id_news' => 0));
	}

	/**
	 * @param $id_news
	 * @param $image_name
	 * @param $thumb_image_name
	 */
	public function insert_image($id_news, $image_name, $thumb_image_name, $size)
	{
		$data = array(
			'id_news' => $id_news,
			'image_name' => $image_name,
			'thumb_image_name' => $thumb_image_name,
			'original_size_width' => $size['original']['width'],
			'original_size_height' => $size['original']['height'],
			'mediu_size_width' => $size['mediu']['width'],
			'mediu_size_height' => $size['original']['height']
		);
		$this->db->insert('news_images', $data);
	}

	/**
	 * @param $id_image array
	 * @param $id_news
	 */
	public function save_main_image($id_image = array(), $id_news)
	{
		$this->db->where('id_news', $id_news);
		$this->db->update('news_images', array('main_image' => 0));

		if(count($id_image)) {
			$this->db->where('id_news', $id_news);
			$this->db->where_in('id', $id_image);
			$this->db->update('news_images', array('main_image' => 1));
		}
	}

	/**
	 * @param $id_image array
	 * @param $id_news
	 */
	public function save_interview_image($id_image = array(), $id_news)
	{
		$this->db->where('id_news', $id_news);
		$this->db->update('news_images', array('interview' => 0));

		if(count($id_image)) {
			$this->db->where('id_news', $id_news);
			$this->db->where_in('id', $id_image);
			$this->db->update('news_images', array('interview' => 1));
		}
	}

	/**
	 * @param $id_news
	 * @param null $id_image
	 * @return mixed
	 */
	public function get_images($id_news = NULL, $id_image = NULL)
	{
		if(!$id_news && !$id_image) {
			return array();
		}

		$this->db->from('news_images');
		if($id_news) {
			$this->db->where('id_news', $id_news);
		}
		if($id_image) {
			$this->db->where('id', $id_image);
		}
		return $this->db->get()->result_array();
	}

	/**
	 * @param $id
	 */
	public function delete_image($id)
	{
		$this->db->where("id", $id)->delete("news_images");
	}

	/**
	 *
	 */
	/*public function prepare_image()
	{
		$res = $this->db->from('news_images')->where('id>', 390)->get()->result_array();
		foreach($res as $image) {
			$this->save_image_size($image);
		}
	}*/

	/**
	 * @param $image
	 */
	/*protected function save_image_size($image)
	{
		$ci = &get_instance();
		$file = $ci->config->item('live_path').'/files/news/original/'.$image['image_name'];
		$original = getimagesize($file);

		$file = $ci->config->item('live_path').'/files/news/mediu/'.$image['thumb_image_name'];
		$mediu = getimagesize($file);

		if (count($original) > 2) {
			$this->db->where('id', $image['id'])->update('news_images', [
				'original_size_width' => $original[0],
				'original_size_height' => $original[1],
				'mediu_size_width' => $mediu[0],
				'mediu_size_height' => $mediu[1]
			]);
		}
	}*/
}