<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //1.用户模型关联表
    public $table = 'role';
    //2.关联表的主键
    public $primaryKey = 'id';

    //3.允许被操作字段
    
    // protected $fillable = [
    //     'user_name', 'user_pass','email','phone'
    // ];
    public $guarded = [];
    
     //是否维护create_at 和 updated_at字段
    public $timestamps = false;

    //添加动态属性，关联权限模型
    public function permission()
    {
        return $this->belongsToMany(
            'App\Model\Permission', //被关联的模型
            'role_permission',       //被关联的表
            'role_id',      //需要关联的ID
            'permission_id' //被关联表的id
    );
    }
}
