<?php

namespace Modules\Ibooking\Support;

class Coupon
{

    private $coupon;

    public function __construct(){
        $this->coupon = app('Modules\Ishoppingcart\Repositories\CouponRepository');;
    }

    /**
     * Coupon Proccess
     *
     * @return Response
     */
    public function getValueReservation($data){

        $dateNow = date("Y-m-d");
        $coupon = $this->coupon->findByCode($data["coupon_code"],$dateNow);

        if(count($coupon)==0){
            // Cupon ya no esta disponible (Paso las fechas)
            return redirect()->back();
                
        }else{
            
            if(($coupon->cant>0)){
    
                $data["coupon_id"] = $coupon->id;
                $price = $data["value"];

                // Verifica el tipo de cupon
                if($coupon->type=="p"){
                    $discount = ($price * $coupon->value) / 100;
                }else{
                    $discount = $coupon->value;
                }
                        
                $amount = (float)$price - (float)$discount;
                        
                // Cancela completo
                if($amount<=0){
                            
                    $data["value"] = 0;
                    $data["status"] = 1; //Approved
    
                }else{

                    // Queda un saldo a cancelar
                    $data["value"] = $amount;

                }

                $coupon->cant = $coupon->cant - 1;
                $coupon->save();

                $data["couponInfor"] = $coupon->id;
                        
            }else{
                // Ya no se puede cambiar mas
                return redirect()->back();
            }

        }// End cupon disponible

        return $data;
    }

}