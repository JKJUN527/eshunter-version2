<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/9
 * Time: 0:46
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Projectexp extends Model
{
    //指定表明
    protected $table = 'jobs_projectexp';

    //指定主键id
    protected $primaryKey = 'id';


    //自动维护时间戳
    public $timestamps = false;
}