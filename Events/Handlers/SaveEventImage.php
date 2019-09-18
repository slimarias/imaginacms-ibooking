<?php

namespace Modules\Ibooking\Events\Handlers;

class SaveEventImage
{
   
   
    public function __construct()
    {
       
    }

    public function handle($event)
    {

        $eventCreated = $event->event;
        $data = $event->data;

        /* $id = $event->post->id;
        if (!empty($event->data['mainimage'])) {
            $mainimage = saveImage($event->data['mainimage'], "assets/iblog/post/" . $id . ".jpg");
            if(isset($event->data['options'])){
                $options=(array)$event->data['options'];
            }else{$options = array();}
            $options["mainimage"] = $mainimage;
            if (!empty($event->data['gallery']) && !empty($id)) {
                if (count(\Storage::disk('publicmedia')->files('assets/iblog/post/gallery/' . $event->data['gallery']))) {
                    \File::makeDirectory('assets/iblog/post/gallery/' . $id);
                    $success = rename('assets/iblog/post/gallery/' . $event->data['gallery'], 'assets/iblog/post/gallery/' . $id);
                }
            }
            $event->data['options'] = json_encode($options);
        }else{
            $event->data['options'] = json_encode($event->data['options']);
        }

        $this->post->update($event->post, $event->data);
       */
      
    }

    

}
