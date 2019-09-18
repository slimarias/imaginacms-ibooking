<?php

namespace Modules\Ibooking\Repositories\Eloquent;

use Modules\Ibooking\Repositories\ReservationRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

use Modules\Ibooking\Events\ReservationIsCreating;
use Modules\Ibooking\Events\ReservationWasCreated;

use DateTime;

class EloquentReservationRepository extends EloquentBaseRepository implements ReservationRepository
{

    public function getItemsBy($params)
    {

      // INITIALIZE QUERY
      $query = $this->model->query();

      // RELATIONSHIPS
      $defaultInclude = [];
      if(isset($params->include))
        $query->with(array_merge($defaultInclude, $params->include));

      // FILTERS
      if($params->filter) {
        $filter = $params->filter;

        //add filter by search
        if (isset($filter->search)) {
          //find search in columns
          $query->where('id', 'like', '%' . $filter->search . '%')
            ->orWhere('slot_id', 'like', '%' . $filter->search . '%')
            ->orWhere('updated_at', 'like', '%' . $filter->search . '%')
            ->orWhere('created_at', 'like', '%' . $filter->search . '%');
        }
      
        //add filter by date
        if (isset($filter->date)) {
          $date = $filter->date;//Short filter date
          $date->field = $date->field ?? 'created_at';
          if (isset($date->from))//From a date
              $query->whereDate($date->field, '>=', $date->from);
          if (isset($date->to))//to a date
              $query->whereDate($date->field, '<=', $date->to);
        }
          
        //add filter by status id
        if (isset($filter->status)){
            $query->where('status', $filter->status);
        }

         //add filter by start_date
        if (isset($filter->startDate)){
          $query->whereDate('start_date', $filter->startDate);
        }

         //add filter Order By
        if (isset($filter->orderBy)){

          $orderBy = $filter->orderBy;
          $orderBy->field = $orderBy->field ?? 'created_at';
          $orderBy->order = $orderBy->order ?? 'ASC';

          $query->orderBy($orderBy->field, $orderBy->order);
        }

      }

      /*== FIELDS ==*/
      if (isset($params->fields) && count($params->fields))
        $query->select($params->fields);

      /*== REQUEST ==*/
      if (isset($params->page) && $params->page) {
        return $query->paginate($params->take);
      } else {
        $params->take ? $query->take($params->take) : false;//Take
        return $query->get();
      }
    
    }

    public function getItem($criteria, $params)
    {
      // INITIALIZE QUERY
      $query = $this->model->query();

      $query->where('id', $criteria);

      // RELATIONSHIPS
      $includeDefault = [];
      $query->with(array_merge($includeDefault, $params->include));

      // FIELDS
      if ($params->fields) {
        $query->select($params->fields);
      }
      return $query->first();

    }

    public function create($data)
    {
       
        // Event to create customer_id
        $result = event(new ReservationIsCreating($data));
        $data = $result[0];

        $reservation = $this->model->create($data);

       
        //event(new ReservationWasCreated($reservation, $data));

        return $reservation;
       
    }

    public function update($reservation,$data)
    {
       
        $reservation->update($data);

        return $reservation;
       
    }

    public function updateBy($criteria, $data, $params){

      // INITIALIZE QUERY
      $query = $this->model->query();
  
      // FILTER
      if (isset($params->filter)) {
        $filter = $params->filter;
  
        if (isset($filter->field))//Where field
          $query->where($filter->field, $criteria);
        else//where id
          $query->where('id', $criteria);
      }
  
      // REQUEST
      $model = $query->first();
  
      if($model){
  
        $model->update($data);
        
        // Event 
        //event(new PlanWasUpdated($model, $data));
      
      }
  
      return $model;
    }

    public function deleteBy($criteria, $params)
    {
      // INITIALIZE QUERY
      $query = $this->model->query();
  
      // FILTER
      if (isset($params->filter)) {
        $filter = $params->filter;
  
        if (isset($filter->field)) //Where field
          $query->where($filter->field, $criteria);
        else //where id
          $query->where('id', $criteria);
      }
  
      // REQUEST
      $model = $query->first();
  
      if($model) {

        //event(new PlanWasDeleted($model));

        $model->delete();

      }
    }

    public function clearReservation(){
      
      $reservations = $this->model->where("status",2)->get(); //Pending
      \Log::info('Revisando Reservaciones - Cantidad: '.count($reservations));

      if(count($reservations)>0){

        $hourNow = date("H:i:s");
        foreach ($reservations as $reservation) {

            $dateReservation = "";
            $hourReservation = "";

            $dateReservation = new DateTime($reservation->created_at);
            $hourReservation = $dateReservation->format('H:i:s');

            $diff = date("H:i:s", strtotime("00:00:00") + strtotime($hourNow) - strtotime($hourReservation) );

            if($diff>="00:30:00"){
                $data['status'] = 3;
                $reservation->update($data);
            }

        }
      }// End if

    }


}
