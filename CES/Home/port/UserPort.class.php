<?php
namespace Home\Port;
interface UserPort{
    
    
    
    
    public function getMyInfo();
    public function getUserInfo();
    public function test();
    public function getUserList();
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