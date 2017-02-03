<?php

namespace Bunta\Translations;

use App;

trait TranslationsTrait {

    public function getAttribute($key) {

        if (in_array($key, $this->translatedAttributes)) {
            return $this->Translation('name');
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value) {

        if (in_array($key, $this->translatedAttributes)) {
            return $this->$key = $value;
        }

        return parent::setAttribute($key, $value);
    }

    public function Translations() {

        $relation = $this->hasMany(config('translations.TranslationModel'), 'foreign_id', 'id')
                ->where('table', $this->table);

        return $relation;
    }

    public function Translation($field, $locale = null) {
        $relation = $this->translations;
        if (!$locale) {
            $locale = \App::getLocale();
            //$relation = $relation->where('lang', $locale);
        }
        return $this->getLangValue($locale, $field);
    }

    protected function getLangValue($lang, $field) {
        $data = [];
        foreach ($this->translations as $relation) {
            $data[$relation->lang][$relation->field] = $relation->value;
        }
        if (isset($data[$lang][$field])) {
            return $data[$lang][$field];
        }

        return null;
    }

    public function save(array $options = []) {
        // before save code 
        parent::save($options);
        // after save code
        $this->Translations()->delete();
        foreach ($this->translatedAttributes as $field) {

            if (is_array($this->$field)) {
                foreach ($this->$field as $k => $v)
                    \App\Translation::create([
                        'table' => 'groupes',
                        'foreign_id' => $this->id,
                        'lang' => $k,
                        'field' => $field,
                        'value' => $v,
                    ]);
            }
        }
    }

    public function delete() {
        // before save code 
        $this->Translations()->delete();

        parent::delete();
        // after save code
    }

}
