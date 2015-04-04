<?php
//1
        $awardFileHandler = fopen('awards.csv', 'r');
        $contractFileHandler = fopen('contracts.csv', 'r');
         while (($data = fgetcsv($awardFileHandler, 0, ",")) !== FALSE) {
            $awardArray[]=$data;
        }
        while (($data = fgetcsv($contractFileHandler, 0, ",")) !== FALSE) {
                $contractArray[]=$data;
        }


 //2  
        for($x=0;$x< count($contractArray);$x++)
        {
            if($x==0){
                unset($awardArray[0][0]);
                $line[$x]=array_merge($contractArray[0],$awardArray[0]); //header
            }
            else{
                $notSame=0;
                for($y=0;$y <= count($awardArray);$y++)
                {
                    if($awardArray[$y][0] == $contractArray[$x][0]){
                        unset($awardArray[$y][0]);
                        $line[$x]=array_merge($contractArray[$x],$awardArray[$y]);
                        $notSame=1;
                    }           
                }
                if($notSame==0)
                    $line[$x]=$contractArray[$x];
            }
        }


  //3     
        $finalFileHandlerW = fopen('final.csv', 'w');//output file set here

        foreach ($line as $fields) {
            fputcsv($finalFileHandlerW, $fields);
        }
        fclose($finalFileHandlerW);


//4
$finalFileHandlerR = fopen('final.csv', 'r');//read final.csv
$sum = 0;
while (($data = fgetcsv($finalFileHandlerR, 0, ",")) !== FALSE) {
                $finalArray[]=$data;
        }

for($z=0;$z<count($finalArray);$z++){
            if(($finalArray[$z][1]) == "Current"){ //1 is the status column
                $sum = $sum + $finalArray[$z][12]; //12 is the amount column
            }
}
echo "Total amount is : ".$sum;
fclose($finalFileHandlerR);
?>