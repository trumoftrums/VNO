<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function dhtmlx_form($thongso=array(),$lbwidth=null,$ipWidth=null)
    {
        if(empty($lbwidth)){
            $lbwidth = 150;
        }
        if(empty($ipWidth)){
            $ipWidth = 150;
        }
        $content = "";
        if(!empty($thongso)){

            switch ($thongso['type']){
                case "input":
                    $rows = "";
                    if(!empty($thongso['rows'])){
                        $rows = ', rows:'.$thongso['rows'];
                    }
                    $content = '{type: "'.$thongso['type'].'", required: '.$thongso['required'].', name: "'
                        .'thongso_'.$thongso['id'].'", labelAlign: "right", label: "'.$thongso['name'].'", labelWidth: '
                        .$lbwidth.', inputWidth: '.$ipWidth.', value: "'.$thongso['default_value'].'", tooltip: "vui lòng nhập '
                        .$thongso['name'].'" '.$rows.'}';
                    break;
                case "checkbox":
                    $content = '{type: "'.$thongso['type'].'", required: '.$thongso['required'].', name: "'.'thongso_'
                        .$thongso['id'].'", labelAlign: "right", label: "'.$thongso['name'].'", labelWidth: '.$lbwidth.', tooltip: "vui lòng nhập '.$thongso['name'].'"}';
                    break;
                case "combo":

                    $content = '{type: "'.$thongso['type'].'", labelAlign: "right", label: "'.$thongso['name'].'", name: "'.'thongso_'.$thongso['id'].'", labelWidth: '.$lbwidth.', inputWidth: '.$ipWidth.', options:'.$thongso['options'].'}';

                    //[{text: "2017", value: "AAC"},{text: "AC3", value: "AC3", selected: true},{text: "MP3", value: "MP3"},{text: "FLAC", value: "FLAC"}]
                    break;
            }

        }

        return $content;
    }
}