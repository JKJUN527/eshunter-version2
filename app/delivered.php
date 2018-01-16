<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/26
 * Time: 9:57
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivered extends Model
{
    //指定表明
    protected $table = 'jobs_delivered';

    //指定主键id
    protected $primaryKey = 'deid';

    //自动维护时间戳
    public $timestamps = true;
}