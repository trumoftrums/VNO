<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function dhtmlx_form($thongso=array(),$lbHeight=null,$lbwidth=null,$ipHeight =null,$ipWidth=null)
    {
        $content = "";
        if(!empty($thongso)){

            switch ($thongso['type']){
                case "input":
                    $content = '{type: "'.$thongso['type'].'", required: '.$thongso['required'].', name: "'.'thongso_'.$thongso['id'].'", labelAlign: "right", label: "'.$thongso['name'].'", labelWidth: 150, inputWidth: 150, value: "'.$thongso['default_value'].'", tooltip: "vui lòng nhập '.$thongso['name'].'"}';
                    break;
                case "checkbox":
                    $content = '{type: "'.$thongso['type'].'", required: '.$thongso['required'].', name: "'.'thongso_'
                        .$thongso['id'].'", labelAlign: "right", label: "'.$thongso['name'].'", labelWidth: 150, tooltip: "vui lòng nhập '.$thongso['name'].'"}';
                    break;
                case "combo":

                    $content = '{type: "'.$thongso['type'].'", labelAlign: "right", label: "'.$thongso['name'].'", name: "'.'thongso_'.$thongso['id'].'", labelWidth: 150, inputWidth: 150, options:'.$thongso['options'].'}';

                    //[{text: "2017", value: "AAC"},{text: "AC3", value: "AC3", selected: true},{text: "MP3", value: "MP3"},{text: "FLAC", value: "FLAC"}]
                    break;
            }

        }

        return $content;
    }
}