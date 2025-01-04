<?php
class News_model extends MY_Model
{
	/**
	 * News_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = array())
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('news AS n');
		$this->db->join('news_languages AS el', 'el.id_news=n.id AND el.id_language='.$this->id_language, 'left');
		$this->db->join('news_categories', 'n.id_news_category=news_categories.id', 'left');
		$this->db->join('users AS b', 'b.id=n.id_user', 'left');
		$this->db->where('n.enabled', '1');
		$this->db->where('n.date<=NOW()', NULL);

		if(sizeof($where) > 0) {
			foreach($where as $i=>$v) {
				if(is_array($v)) {
					$this->db->group_start();
					foreach($v as $field) {
						$this->db->or_like($field, $i);
					}
					$this->db->group_end();
				}
				else {
					$this->db->where($i, $v);
				}
			}
		}

		$query = $this->db->get();
		$res = $query->row_array();

		return $res['total'];
	}

	/**
	 * @param Pagination2 $pagination
	 * @param array $where
	 * @param array $order
	 * @param bool $with_users
	 * @return mixed
	 */
	public function get_news($pagination, $where = array(), $order = array(), $with_users = true)
	{
		$fields = [
			'n.id', 'n.date', 'n.image_name', 'n.image_file', 'n.image_title', 'n.image_original_file', 'n.seo_title', 'n.seo_description', 'n.seo_keywords', 'n.url', 'n.labels', 'n.id_news_category',
			'nl.title', 'nl.subtitle', 'nl.content', 'nl.content_short',
			'ncl.title AS news_category',
			'nc.url AS news_category_url',
			'ni.thumb_image_name'
		];

		if($with_users) {
			$fields[] = 'b.first_name AS author_name';
			$fields[] = 'b.last_name AS author_surname';
			$fields[] = 'b.slug AS author_slug';
			$fields[] = 'ui.thumb_image_name AS author_image';
			$fields[] = 'ui2.thumb_image_name AS interview_image';
		}

		$this->db->select(implode(',', $fields));
		$this->db->from('news n');
		$this->db->join('news_languages nl', 'nl.id_news=n.id AND nl.id_language='.$this->currentLanguage(), 'left');
		$this->db->join('news_categories nc', 'n.id_news_category=nc.id', 'left');
		$this->db->join('news_categories_languages ncl', 'nc.id=ncl.id_news_category', 'left');
		$this->db->join('news_images ni', 'n.id=ni.id_news AND ni.main_image=1', 'left');
		if($with_users) {
			$this->db->join('users b', 'b.id=n.id_user', 'left');
			$this->db->join('users_images ui', 'ui.id_user=b.id AND ui.main_image=1', 'left');
			$this->db->join('news_images ui2', 'n.id=ui2.id_news AND ui2.interview=1', 'left');
		}
		$this->db->where('ncl.id_language', $this->currentLanguage());
		$this->db->where('n.enabled', '1');
		$this->db->where('n.date<=NOW()', NULL);

		if(sizeof($where) > 0) {
			foreach($where as $i=>$v) {
				if(is_array($v)) {
					$this->db->group_start();
					foreach($v as $field) {
						$this->db->or_like($field, $i);
					}
					$this->db->group_end();
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
		    $this->db->order_by('n.date', 'desc');
		}

		if(null !== $pagination) {
			$this->db->limit($pagination->limit(), $pagination->offset());
		}
		else {
			$this->db->limit(6, 0);
		}


		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function get_by_id($id)
	{
		$res = $this->get_news(null, ['n.id' => $id]);
		return current($res);
	}

	/**
	 * @param $id
	 */
	function get_news_images($id)
	{
		return $this->db->select('a.*')->where('a.id_news', $id)->from('news_images a')->get()->result_array();
	}
}