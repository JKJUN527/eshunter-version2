<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/26
 * Time: 9:57
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    //指定表明
    protected $table = 'jobs_occupation';

    //指定主键id
    protected $primaryKey = 'id';

    //自动维护时间戳
    public $timestamps = true;
}