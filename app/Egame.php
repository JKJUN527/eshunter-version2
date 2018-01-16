<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/26
 * Time: 9:57
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Egame extends Model
{
    //指定表明
    protected $table = 'jobs_egamename';

    //指定主键id
    protected $primaryKey = 'id';

    //允许批量赋值,自定义允许批量赋值的字段名
    //protected $fillable = ['name','age','sex'];

    //自动维护时间戳
    public $timestamps = true;
}