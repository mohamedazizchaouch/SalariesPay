<?php

namespace App\Manager;

use ArrayHelper;
use PaySalesDepartmentDate;

class SalariesPayManager
{
    

    public function __construct()
    {
    }

   public function getDateOfPay(int $years)
   {
        if($years === 0){
            $years = date('Y');
        }

        $data[0] = PaySalesDepartmentDate::salaryDates($years);
        $data[1] =PaySalesDepartmentDate::bonnusDates($years);
        $payDate = ArrayHelper::arrayRange($data);
        return $payDate ;
   }

   
}
