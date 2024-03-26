<?php

class Import_Model_Import extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClass = "Import_Model_Resource_Import";
        $this->_collectionClass = "Import_Model_Resource_Collection_Import";
    }

    public function readCsv($fileName)
    {
        // print_r($fileName);
        $row = 0;
        $path = Mage::getImagePath("import/" . $fileName);
        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (!$row) {
                    $header = $data;
                    $row++;
                    continue;
                }
                $data1 = array_combine($header, $data);
                $data1 = json_encode($data1);
                Mage::getModel("import/import")->addData("json_data", $data1)->addData('type','product')->save();
                echo "<br>";
                $row++;
            }
        }

    }

    public function uploadCsv($type)
    {   
        $importCollection = Mage::getModel('import/import')
            ->getCollection()
            ->addFieldToFilter('type', $type)
            ->addFieldToFilter('status', 0)->
            getFirstItem();
          
        $id = Mage::getModel('catalog/product')
            ->setData(json_decode($importCollection->getJsonData(), true))
            ->save()
            ->getId();
        if ($id) {
            $importCollection->addData('status', 1)
                ->save();
            echo 'true';
        } else {

            $importCollection->addData('status', 2)
                ->save();
            echo 'false';
        }
    }
}