<?php
namespace Home\Port;
interface UserPort{
    
    
    
    
    public function get_my_info();
    public function get_user_info($uid=0);
    public function test();
    public function get_user_list($page=1);
    public function get_admin_list();
	public function add_admin();
    public function del_admin();
    public function user_login();
    public function user_logout();
	public function reg();
	public function change_email();
    public function change_password();
    public function change_user_email();
    public function change_user_password();
    public function admin_login();
}
?>