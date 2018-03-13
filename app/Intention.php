<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/8
 * Time: 23:53
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Intention extends Model
{
    //指定表明
    protected $table = 'jobs_intention';

    //指定主键id
    protected $primaryKey = 'inid';


    //自动维护时间戳
    public $timestamps = true;
}