<?php 
    function readFileData($filename){
        if(file_exists($filename)){
            return json_decode(file_get_contents($filename), true);
        }
    }
    function writeFileData($filename, $data){
        if (filesize($filename) == 0) {
            $dataToSave = [$data];
        } else {
            $dataToSave = readFileData($filename);
            array_unshift($dataToSave, $data);
        }
        $newContent = json_encode($dataToSave, JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $newContent);
    }
    function overWriteFileData($filename, $data){
        $overWriteData = json_encode($data, JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $overWriteData);
    }
?>