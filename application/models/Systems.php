<?php
class Systems extends CI_Model {
    public $ftp_root;
    public $default;

    public function __construct()
    {
        parent::__construct();
        $this->ftp_root = "/var/ftp/pub";
        $this->default = "centos7";
        // Your own constructor code
    }

    public function listDir() {
        $str = "ls ".$this->ftp_root;
        $dirs = shell_exec($str);
        //把最后的一个换行符去掉，否则界面会多显示一个的
        echo $dirs;
        $dirs = substr($dirs, strlen($dirs)-1);
        echo strlen($dirs);
        echo $dirs;
        $res = explode("\n" ,$dirs);
        return $res;
    }
    public function listSystems(){
        $res = array();
        $dirs = $this->listDir();
        foreach ($dirs as $dirname) {
            $item = array();
            $item['name'] = $dirname;
            if($dirname == $this->default){
                $item['isDefault'] = TRUE;
            }
            else{
                $item['isDefault'] = FALSE;
            }
            $item['desc'] = "描述"; 
            array_push($res,$item);
        }
        return $res;
    }
}