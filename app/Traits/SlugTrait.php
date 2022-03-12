<?php

namespace App\Traits;

trait SlugTrait
{

    /**
     * this function to convert given value to slug (replace ( ) to (-)) .
     *
     * @return String
     */
    public function generateUniqueSlug ($value) {
        if (is_null($value)) {
            return "";
        }
        $slug = trim($value);

        //to handle arabic characters if exists in value parameter
        $slug = mb_strtolower($value, "UTF-8");

        //to prevent some arabic character issue in urls
        $slug = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $value);

        $slug = preg_replace("/[\s-]+/", " ", $value);
        $slug = preg_replace("/[\s_]/", '-', $value);
        return $slug;

    }
}
