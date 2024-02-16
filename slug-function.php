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

<?php 

    // Yapay Zekanın Revize Ettiği Kod
    function generate_unique_slug($table = null, $slug_column = null, $input_slug = null) {
        if (empty($table) || empty($slug_column) || empty($input_slug)) { return false; }
        $input_slug = convertToSEO($input_slug);
        $ci = get_instance();
        $all_slugs = $ci->$table->get_all($slug_column);
        $slug_array = array_column($all_slugs, $slug_column);
        $exists = in_array($input_slug, $slug_array);
        if ($exists) {
            $count = 0;
            while ($exists) {
                $output_slug = $input_slug."-".++$count;
                $exists = in_array($output_slug, $slug_array);
            }
            return $output_slug;
        } else {
            return $input_slug;
        }
    }

?>