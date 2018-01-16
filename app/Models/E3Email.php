<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/8/22
 * Time: 23:33
 */
namespace APP\Models;

class E3Email {

    public $from;//发件人邮箱
    public $to;//收件人邮箱
    public $toname;//收件人姓名
    public $cc;//抄送
    public $attach;//附件
    public $subject;//主题
    public $content;//内容
}