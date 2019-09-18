<?php

namespace Modules\Ibooking\Repositories\Eloquent;

use Modules\Ibooking\Repositories\DayRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentDayRepository extends EloquentBaseRepository implements DayRepository
{

    public function getItemsBy($params)
    {

      // INITIALIZE QUERY
      $query = $this->model->query();

      // RELATIONSHIPS
      $defaultInclude = [];
      $query->with(array_merge($defaultInclude, $params->include));

      // FILTERS
      if($params->filter) {
        $filter = $params->filter;

        //add filter by search
        if (isset($filter->search)) {
          //find search in columns
          $query->where('id', 'like', '%' . $filter->search . '%')
            ->orWhere('num', 'like', '%' . $filter->search . '%')
            ->orWhere('date', 'like', '%' . $filter->search . '%');
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

        //add filter by event id
        if (isset($filter->events)){
          /*
          is_array($filter->events) ? true : $filter->events = [$filter->events];
          $query->whereIn('ibooking__day_event.event_id', $filter->events);
          */
        }

        //add filter by day Date
        if (isset($filter->dayDate)){
          $query->whereDate('date', $filter->dayDate);
          //$dayNumber = date('N',strotime($filter->dayDate));
          //$query->where('num',"=",$dayNumber);
        }

        //add filter by day Date
        if(isset($filter->dayNum)){
          $query->where('num',"=",$filter->dayNum);
          $query->WhereNull('date');
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

    public function create($data){

        if(isset($data["date"]) && !empty($data["date"])){
            $dayNumber = date('N',strtotime($data["date"]));
            $data["num"] = $dayNumber;
        }
        
        $day = $this->model->create($data);

        // sync tables
        if($day){

          $day->events()->sync(array_get($data, 'events', []));

          if(isset($data["slots"]))
            $day->slots()->sync(array_get($data, 'slots', []));

        }

        return $day;

    }

    public function update($day, $data)
    {
      
        if(isset($data["date"]) && !empty($data["date"])){
            $dayNumber = date('N',strtotime($data["date"]));
            $data["num"] = $dayNumber;
        }
        
        $day->update($data);

        // sync tables
        if($day){

          $day->events()->sync(array_get($data, 'events', []));

          $day->slots()->sync(array_get($data, 'slots', []));

        }

        return $day;

    }

    public function destroy($day)
    {
        
         // desync tables
        if(count($day->events())>0)
            $day->events()->detach();

        if(count($day->slots())>0)
            $day->slots()->detach();
        

        return $day->delete();
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

          // sync tables
          $model->events()->sync(array_get($data, 'events', []));
          $model->slots()->sync(array_get($data, 'slots', []));
          
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

         // desync tables
        if(count($model->events())>0)
          $model->events()->detach();

        if(count($model->slots())>0)
          $model->slots()->detach();

        $model->delete();

      }
    }


}
