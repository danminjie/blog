<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    //1.用户模型关联表
    public $table = 'config';
    //2.关联表的主键
    public $primaryKey = 'conf_id';

    //3.允许被操作字段
    
    // protected $fillable = [
    //     'user_name', 'user_pass','email','phone'
    // ];
    public $guarded = [];
    
     //是否维护create_at 和 updated_at字段
    public $timestamps = false;
}
