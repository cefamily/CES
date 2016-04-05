<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('<script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>','utf-8');
    }
}