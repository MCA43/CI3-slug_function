<?php

function isSlug($model = null, $column = null, $slug = null) {
    if (is_null($slug) || empty($slug) || is_null($model) || empty($model) || is_null($column) || empty($column)){ return false; }
    $slug = convertToSEO($slug);
    $t = get_instance();
    $isSlug = $t->$model->get([$column => $slug]);
    if ($isSlug){
        $say = 1;
        while ($isSlug == true){
            $new_slug = $slug."-".$say++;
            $isSlug = $t->$model->get([$column => $new_slug]);
            if ($isSlug){
                $new_slug = $slug;
            }else{
                break;
            }
        }
        return $new_slug;
    }else{
        return $slug;
    }

}

?>