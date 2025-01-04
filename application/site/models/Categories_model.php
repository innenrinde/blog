<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 5/2/2017
 * Time: 10:48 AM
 */
class Categories_model extends MY_Model
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
     * @param array $conditions
     * @return mixed
     */
    function get_categories($conditions = array())
    {
        $this->db->select('a.id, a.url, a.order, a.id_parent, b.title');
        $this->db->from('news_categories a');
        $this->db->join('news_categories_languages b', 'a.id=b.id_news_category', 'left');
        $this->db->where('a.enabled', 1);
        $this->db->where('b.id_language', $this->currentLanguage());
        if(sizeof($conditions) > 0) {
            foreach($conditions as $i=>$v) {
                $this->db->where($i, $v);
            }
        }
        $this->db->order_by('a.id_parent', 'ASC');
        $this->db->order_by('a.order', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_by_id($id)
    {
        $res = $this->get_categories(['a.id' => $id]);
        return current($res);
    }
}