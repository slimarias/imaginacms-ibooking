<?php

namespace Modules\Ibooking\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface SlotRepository extends BaseRepository
{

    public function getItemsBy($params);
  
    public function getItem($criteria, $params);

    public function updateBy($criteria, $data, $params);

    public function deleteBy($criteria, $params);
    
}
