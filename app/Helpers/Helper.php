<?php
namespace App\Helpers;

class Helper{
    public static function IDGenerator($model, $trow, $length = 1, $prefix)
    {
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '0';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number =  $actial_last_number+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;

        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="";

        }
        return $prefix.'-'.$zeros.$last_number;
        
    }
}
class Registrar_Helper{
    public static function Reg_Generator($model, $trow, $length = 1, $prefix)
    {
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '1';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number =  $actial_last_number+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;

        }
        $zeros = "0";
        for($i=0;$i<$og_length;$i++){
            $zeros.="";

        }
        return $prefix.'-'.$zeros.$last_number;
        
    }
}
class Cashier_Helper{
    public static function Cash_Generator($model, $trow, $length = 1, $prefix)
    {
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '1';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number =  $actial_last_number+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;

        }
        $zeros = "0";
        for($i=0;$i<$og_length;$i++){
            $zeros.="";

        }
        return $prefix.'-'.$zeros.$last_number;
        
    }
}
class Finance_Helper{
    public static function Fin_Generator($model, $trow, $length = 1, $prefix)
    {
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '1';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number =  $actial_last_number+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;

        }
        $zeros = "0";
        for($i=0;$i<$og_length;$i++){
            $zeros.="";

        }
        return $prefix.'-'.$zeros.$last_number;
        
    }
}

?>