<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //1.用户模型关联表
    public $table = 'category';
    //2.关联表的主键
    public $primaryKey = 'cate_id';

    //3.允许被操作字段
    
    // protected $fillable = [
    //     'user_name', 'user_pass','email','phone'
    // ];
    public $guarded = [];
    
     //是否维护create_at 和 updated_at字段
    public $timestamps = false;

    //格式化分类数据
    public function tree()
    {
        //获取所有的分类
        $cates = $this->orderBy('cate_order','asc')->get();
        //格式化（排序，二级缩进）
        return $this->getTree($cates);
    }

    public function getTree($category)
    {
        //排序
        //获取一级类
        //存放排序后的分类数据
        $arr = [];
        foreach ($category as $k => $v) {
            //获取一级类
            if ($v->cate_pid == 0) {
                $arr[] = $v;
                //获取一级类下的二级类
                foreach ($category as $m => $n) {
                    if ($v->cate_id == $n->cate_pid) {
                        //给分类名称添加缩进符
                        $n->cate_name = '|---'.$n->cate_name;
                        $arr[] = $n;
                    }
                }
            }
        }
        return $arr;
    }

    //关联模型
    public function article()
    {
        return $this->hasMany(
            'App\Model\Article',
            'cate_id',
            'cate_id'
        );
    }
}
