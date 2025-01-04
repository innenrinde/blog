<?php

class LanguageLoader
{
    /** @var  object */
    protected $ci;

    /** @var  array */
    protected $languages;

    /**
     * LanguageLoader constructor.
     */
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    /**
     * Get language code from url and load specified libraries
     */
    public function initialize()
    {
        $lang = $this->ci->uri->segment(1);

        $this->languages = $this->ci->languages_model->get_languages();

        $language_detect = $this->search_language($lang);
        if(!$language_detect) {
            $this->search_language(LANGUAGE_DEFAULT);
        }

        $this->ci->staticdata->setlanguages($this->languages);
    }

    /**
     * @param $short
     * @return bool
     */
    private function search_language($short)
    {
        foreach($this->languages as $language) {
            if($language['short'] == $short) {
                $this->ci->lang->load('index', $language['slug']);
                $this->set_language($language);
                return true;
            }
        }
        return false;
    }

    /**
     * @param $language
     */
    private function set_language($language)
    {
        $this->ci->staticdata->setLanguage([
            'id' => $language['id'],
            'short' => $language['short'],
            'slug' => $language['slug']
        ]);
    }
}