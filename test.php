<pre>
<?php
include "app/Mage.php";
include "app/code/Local/autoload.php";
    $row = 0;
    $path = Mage::getImagePath("import/testq.csv");
    // echo $path;
    // die;
    if (($handle = fopen($path, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if(!$row) {
                $header = $data;
                $row++;
                continue;
            }
            $data1 = array_combine($header,$data);
            $data1= json_encode($data1);
            Mage::getModel("import/import")->addData("data",$data1)->save();
            $tableCollection = Mage::getModel('import/import')->getCollection()->getData();
        echo "<br>";
        $row++;
        foreach ($tableCollection as $productData) {
        $data = $productData->removeData('import_id')->removeData('status');
        $data = $data->getData();
        $dataNew= json_decode($data['data'],true);
        print_r($dataNew);
        $result = Mage::getModel('catalog/product')->setData($dataNew)->save();
        if($result){
            echo "<script>alert('hello')</script>";
        }else{
            print_r($result);
        }

        }
        // $num = count($data);
        // echo "<p> $num fields in line $row: <br /></p>\n";
        // $row++;
        // for ($c=0; $c < $num; $c++) {
        //     echo $data[$c] . "<br />\n";
        // }
        
      }
      echo $row;
      fclose($handle);

    }
    //   print_r($tableCollection->getData());
    //   foreach($tableCollection->getData() as  $val){
        
    //   $tableCollection = json_decode($val,true);
    //   }
    
    // foreach($data as $key => $val){
    //     $dataString=json_encode($val);
        
    //     print_r(json_decode($dataString,true));
    //     die();


    // }
?>