<?php


/**
 * Description
 *
 * @param  String $xxxxx
 * @return Float
 */
if (!function_exists('ibooking_subtractHours')) {
    function ibooking_subtractHours($hourFin,$hourIni){
        return (date("H:i:s", strtotime("00:00:00") + strtotime($hourFin) - strtotime($hourIni) ));
    }
}

/* Old Gallery
if (! function_exists('ibooking_postgallery')){

    function ibooking_postgallery($id){
        $images = Storage::disk('publicmedia')->files('assets/ibooking/post/gallery/' . $id);
        return $images;
    }
}
 */
