<?php

    function isSlug($model = null, $column = null, $slug = null) {
        if (is_null($slug) || empty($slug) || is_null($model) || empty($model) || is_null($column) || empty($column)){ return false; }
        $slug = convertToSEO($slug);
        $ci = get_instance();
        $isSlug = $ci->$model->get([$column => $slug]);
        if ($isSlug){
            $say = 1;
            while ($isSlug == true){
                $new_slug = $slug."-".$say++;
                $isSlug = $ci->$model->get([$column => $new_slug]);
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

<?php 

    // Revize Edilen Kod
    function isSlug($table = null, $slug_column = null, $input_slug = null) {
    $ci = get_instance();
    $existingSeflinks = $ci->$table->get_all();
    $desiredSeflink = convertToSEO($input_slug);

    if (in_array($desiredSeflink, array_column($existingSeflinks, $slug_column)) === true) {
        $i = 1;
        while (in_array($desiredSeflink . '-' . $i, array_column($existingSeflinks, $slug_column))) {
            $i++;
        }
        return $desiredSeflink. '-' . $i; die();
    } else {
        return $desiredSeflink; die();
    }
}

?>