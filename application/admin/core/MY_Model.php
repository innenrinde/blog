<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 5/2/2017
 * Time: 10:02 PM
 */
class MY_Model extends CI_Model
{
    /**
     * @var array
     */
    public $languages = array();

    /**
     * MY_Model constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('functions');
        $this->load->model('languages_model');

        $this->languages = $this->languages_model->get_languages();
    }

    /**
     * @param $table
     * @param $data
     * @param $fields
     * @param $fk
     * @param $id
     */
    protected function save_definitions($table, $data, $fields, $fk, $id)
    {
        $this->delete_definitions($table, $fk, $id);

        $values = [];
        foreach($this->languages as $lang) {
            $array = [
                $fk => $id,
                'id_language' => $lang['id']
            ];
            foreach($fields as $field) {
                $array[$field] = $data[$field][$lang['id']];
            }
            $values[] = $array;
        }
        $this->db->insert_batch($table.'_languages', $values);
    }

    /**
     * @param $table
     * @param $fk
     * @param $id
     */
    protected function delete_definitions($table, $fk, $id)
    {
        $this->db->delete($table.'_languages', array($fk => $id));
    }

    /**
     * @param $obj
     * @param $table
     * @param $fields
     * @param $fk
     */
    protected function get_definitions($obj, $table, $fields, $fk)
    {
        $res = $this->db->from($table.'_languages')->where($fk, $obj['id'])->get()->result_array();
        foreach($fields as $field) {

            $default_value = $obj[$field]; // pastrez valoare default, netradusa
            $obj[$field] = $this->init_definitions();

            if(count($res)) {
                foreach($res as $item) {
                    $obj[$field][$item['id_language']] = $item[$field];
                }
            }
            else { // daca traducerile au fost adaugate ulterior, initializez toate traducerile cu valoarea default
                foreach($this->languages as $language) {
                    $obj[$field][$language['id']] = $default_value;
                }
            }
        }
        return $obj;
    }

    /**
     * @return array
     */
    protected function init_definitions()
    {
        $values = [];
        foreach($this->languages as $language) {
            $values[$language['id']] = '';
        }
        return $values;
    }
}