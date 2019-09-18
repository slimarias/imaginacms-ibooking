<?php

namespace Modules\Ibooking\Imports;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;

// Maatwebsite excel
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use DB;
use Exception;

//Others
use Carbon\Carbon;

/*
class ReservationsImport implements ToCollection,WithChunkReading,WithHeadingRow,ShouldQueue
{
*/

class ReservationsImport implements ToCollection,WithHeadingRow
{

    private $reservation;

    public function __construct(){
        $this->reservation = app('Modules\Ibooking\Repositories\ReservationRepository');
    }

    public function collection(Collection $rows)
    {
        
        $rows=json_decode(json_encode($rows));
        foreach ($rows as $row)
        {
           
            if(isset($row->id) && $row->id!=NULL && !empty($row->email)){
                //echo "entro {$row->email}<br>";
                try {

                    DB::beginTransaction();

                    $data=[];
                    $fields=[];
                    $data['id'] = $row->id;

                    if(isset($row->first_name)){
                        $data['first_name'] = $row->first_name;
                    }
                    if(isset($row->last_name)){
                        $data['last_name'] = $row->last_name;
                    }

                    if(isset($row->email)){
                        $data['email'] = $row->email;
                    }

                    if(isset($row->phone)){
                        $fields['phone'] = $row->phone;
                    }

                    if(isset($row->description)){
                        $data['description'] = $row->description;
                    }

                    if(isset($row->slot_id)){
                        $data['slot_id'] = $row->slot_id;
                    }

                    if(isset($row->start_date)){
                        $start_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row->start_date);
                        $data['start_date'] = $start_date->format('Y-m-d');
                    }

                    if(isset($row->value)){
                        $data['value'] = (float)$row->value;
                    }

                    if(isset($row->status)){
                        $data['status'] = $row->status;
                    }

                    if(isset($row->people)){
                        $data['people'] = (string)$row->people;
                    }

                    if(isset($row->plan)){
                        $data['plan'] = (string)$row->plan;
                    }

                    if(isset($row->coupon_id)){
                        $data['coupon_id'] = $row->coupon_id;
                    }

                    if(count($fields)>0)
                        $data['fields'] = $fields;

                    
                    $reservation = $this->reservation->find($data["id"]);
                    if($reservation){
                        //Update
                        $this->reservation->update($reservation,  $data);

                        \Log::info('Update Reservation: '.$reservation->id);
                    }else{
                        //Create
                        $newReservation = $this->reservation->create($data);
                        // Take id from excel
                        $newReservation->id = $data["id"];
                        $newReservation->save();

                        \Log::info('Created a reservation: '.$newReservation->id);
                    }
                    
                    DB::commit();

                } catch (\Exception $e) {

                    dd($e);
                    DB::rollBack();
                    \Log::error('Error import reservation: '.$e->getMessage());

                }//catch
            }

        }// End foreach

       

    }

     /*
    The most ideal situation (regarding time and memory consumption)
    you will find when combining batch inserts and chunk reading.
    */
    /*
    public function batchSize(): int
    {
        return 1000;
    }
    */

    /*
     This will read the spreadsheet in chunks and keep the memory usage under control.
    */
    /*
    public function chunkSize(): int
    {
        return 1000;
    }
    */

}