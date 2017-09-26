<?php
namespace src\Utils;
class Logger {

    static public  $logfile_base=null;

    static public $display_flag=1;
    static public $logger=null;

    static public function init_logfile_base($file_name="/home/jim/co-framework/runtime/new_"){
        self::$logfile_base=$file_name;
        $dirname= dirname(self::$logfile_base);
        if (!file_exists($dirname ) ){
            if (!file_exists($dirname)){
                mkdir($dirname, 0777,true );

            }
        }
    }

    static public function write($args){
        if (!static::$logfile_base ) {
            static::init_logfile_base();
        }

        $varArray = func_get_args();     //获取参数，返回参数数组

        if ( func_num_args() ==1 ) {
            $arg0= $varArray[0];
            if(is_string( $arg0 )  || is_numeric( $arg0) ){
                $desc =  $arg0 ;
            }else{
                $desc = var_export( $arg0 ,true) ;
            }
        }else{
            $desc="";
            foreach($varArray as $value) {
                $desc.=var_export($value,true). " |";
            }
        }

        $t=time();
        $msg=strftime("%H:%M:%S :",$t).$desc."\n";
        if (self::$display_flag  ){
            echo $msg;
        }


        $date=strftime("%Y%m%d",$t);
        $logfile=self::$logfile_base.$date;
        $fp = fopen($logfile, "a");
        flock($fp, LOCK_EX) ;
        fwrite($fp,$msg);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

}

