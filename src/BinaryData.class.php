<?php
class BinaryData {
        public function img2base64($pathfile){
            $data = file_get_contents($pathfile);
            $base64 = base64_encode($data);
            return $base64;
        }
}
?>