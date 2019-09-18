<?php

namespace Modules\Ibooking\Repositories\Eloquent;

use Modules\Ibooking\Repositories\PlanRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

use Modules\Ibooking\Events\PlanWasCreated;
use Modules\Ibooking\Events\PlanWasUpdated;
use Modules\Ibooking\Events\PlanWasDeleted;

class EloquentPlanRepository extends EloquentBaseRepository implements PlanRepository
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
            ->orWhere('title', 'like', '%' . $filter->search . '%')
            ->orWhere('event_id', 'like', '%' . $filter->search . '%')
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

        //add filter by event id
        if (isset($filter->eventId)){
          $query->where('event_id', $filter->eventId);
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
      if (isset($params->fields)) {
        $query->select($params->fields);
      }
      return $query->first();

    }

    public function create($data)
    {
       
        $plan = $this->model->create($data);

        event(new PlanWasCreated($plan, $data));

        return $plan;
       
    }

    public function update($plan, $data)
    {
       
        $plan->update($data);

        event(new PlanWasUpdated($plan, $data));

        return $plan;
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
          event(new PlanWasUpdated($model, $data));
        
        }
    
        return $model;
    }

    public function destroy($plan)
    {
        event(new PlanWasDeleted($plan));

        return $plan->delete();
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

        event(new PlanWasDeleted($model));

        $model->delete();

      }
    }

    /**
     * Check the price with plan and number people
     *
     * @return Response
     */
    public function checkPrice($data){

      $filter =array( "status" => 1,);
      $include = array('prices');

      $plan = $this->getItem($data['plan_id'],(object)[
                'take' => false,
                'include' => $include,
                'filter' => json_decode(json_encode($filter))
      ]);

      $priceBD = false;

      if(isset($plan->prices)){
          foreach($plan->prices as $index => $price){
              if($price->price==$data["value"] && $price->people==$data["people"]):
                  $priceBD = true; 
              endif; 
          }
      }

      return $priceBD;

    }

}
