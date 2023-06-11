<?php

class ArrayHelper {

    /**
     *
     * @param integer $year
     * @return array
     */
    public static function arrayRange(array $data)
    {   
        foreach ($data[0] as $key=>$row) {
            $dateTime = new DateTime($row);
            $montName = strftime('%B', $dateTime->getTimestamp());
            $finalArray [] = ["month" => $montName,
                                "salarie" =>$row,
                                "bonnus" =>$data[1][$key]
                             ];
        }
        return $finalArray;
    }
   
}

?>
