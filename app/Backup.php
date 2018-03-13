<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/26
 * Time: 9:57
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    //指定表明
    protected $table = 'jobs_backup';

    //指定主键id
    protected $primaryKey = 'did';

    public $timestamps = true;
}