<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/8
 * Time: 15:25
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Resumes extends Model
{
    //指定表明
    protected $table = 'jobs_resumes';

    //指定主键id
    protected $primaryKey = 'rid';

    //自动维护时间戳
    public $timestamps = true;
}