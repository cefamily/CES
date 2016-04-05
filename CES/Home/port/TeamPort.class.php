<?php
namespace Home\Port;
interface TeamPort{


    /*
    获取组的信息
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
    */
	public function get_team_info();
    
    
    
    
    
    
    
    
    /*
    增加一个组
    传入参数
    tname         必填          组的名字

    成功输出参数
    int 1
    */
    public function add_team();
    
    
    
    
     /*
    删除一个组
    传入参数
    tid         必填          组的ID

    成功输出参数
    int 1
    */
    public function delete_team();
    
    
    
    
    
    
    /*
    获取组的信息
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
    */
    public function get_team_list();
    
    
    
    
    
    /*
    将一名成员添加进组
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    */
    public function add_member();
    
    
    
    
    
    /*
    将一名成员从组删除
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    */
    public function del_member();
    
    
    
    
    /*
    将一名成员设置为组的组长
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    */
	public function add_master();
    
    
    
    
    /*
    取消一名成员的组长职位
    传入参数
    type        默认uid       用户筛选形式
    value       必填          筛选的值
    team        必填          组的ID
    成功输出参数
    int 1
    */
    public function del_master();
	

	
	
	
	
	
	
}
?>