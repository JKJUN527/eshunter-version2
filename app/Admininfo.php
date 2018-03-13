<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/11
 * Time: 15:38
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Admininfo extends Model
{
    //指定表明
    protected $table = 'jobs_admininfo';

    //指定主键id
    protected $primaryKey = 'aid';

    //允许批量赋值,自定义允许批量赋值的字段名
    //protected $fillable = ['name','age','sex'];

    //自动维护时间戳
    public $timestamps = true;
}