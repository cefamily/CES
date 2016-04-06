<?php
namespace Home\Port;
interface TeamPort{


    /*
    获取组的信息
    
    权限
    后台
    权限3以及以上
    
    
    传入参数
    tid         必填          组的ID

    成功输出参数
    {
        team:{
                tid:'1',                   组ID
                tname:'我的组',             组名
                tctime:'1758000000'        创建时间（时间截）
        },
        master:{
            '2':'测试用户2',                用户的id：用户的名字
            '3':'测试用户3',
        },
        member:{
            '2':'测试用户2',
            '3':'测试用户3',
            '4':'测试用户4',
            '5':'测试用户5',
            '6':'测试用户6',
        }
    }
    如果没有组error
    如果没有组长或组员 master:[],member:[]
    
    API接口：domain/index.php/Home/Team/getTeamInfo
    */
	public function getTeamInfo();
    
    
    
    
    
    
    
    
    /*
    增加一个组
    
    权限
    后台
    权限4
    
    
    传入参数
    tname         必填          组的名字

    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/addTeam
    */
    public function addTeam();
    
    
    
    
     /*
    删除一个组
    
    权限
    后台
    权限4
    
    传入参数
    tid         必填          组的ID

    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/deleteTeam
    */
    public function deleteTeam();
    
    
    
    
    
    
    /*
    获取组的列表（金可获得有权限管理的组）
    
    权限
    后台
    权限3以及以上
    
    传入参数
    page        默认1         页数
    limit       默认10        每页的数量
    成功输出参数
    {
        teams:[
            {
                tid:'1',
                tname:'我的组',
                tctime:'1758000000'
            },
            {
                tid:'2',
                tname:'我的组2',
                tctime:'1759000000'
            }
            ...
            ...
            ...
        ],
        row:7
    }
    如果没有则输出{teams:[],row:0}
    
    API接口：domain/index.php/Home/Team/getTeamList
    */
    public function getTeamList();
    
    
    
    
    
    /*
    将一名成员添加进组
    
    权限
    后台
    权限3以及以上
    权限3需要验证是否是该组的组长
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/addMember
    */
    public function addMember();
    
    
    
    
    
    /*
    将一名成员从组删除
    
    权限
    后台
    权限3以及以上
    权限3需要验证是否是该组的组长
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/delMember
    */
    public function delMember();
    
    
    
    
    /*
    将一名成员设置为组的组长
    
    权限
    后台
    权限4
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/addMaster
    */
	public function addMaster();
    
    
    
    
    /*
    取消一名成员的组长职位
    
    权限
    后台
    权限4
    仅可操作比自己权限低的用户
    
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    
    API接口：domain/index.php/Home/Team/delMaster
    */
    public function delMaster();
	

	
	
	
	
	
	
}
?>