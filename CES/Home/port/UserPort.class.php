<?php
namespace Home\Port;
interface UserPort{
    
    
    
    
    public function getMyInfo();
    public function getUserInfo($uid=0);
    public function test();
    public function getUserList($page=1);
    public function getAdminList();
	public function addAdmin();
    public function delAdmin();
    public function userLogin();
    public function userLogout();
	public function reg();
	public function changeEmail();
    public function changePassword();
    public function changeUserEmail();
    public function changeUserPassword();
    public function admin_Login();
}
?>