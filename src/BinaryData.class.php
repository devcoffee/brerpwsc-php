<?php
class BinaryData {
        public function img2base64($pathfile){
            $data = file_get_contents($pathfile);
            $base64 = base64_encode($data);
            return $base64;
        }

        public function base64img($b64code){
            $img = base64_decode($b64code);
            return $img;
        }
}
?>