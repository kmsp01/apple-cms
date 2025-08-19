<?php
namespace app\common\validate;
use think\Validate;

class Carousel extends Validate
{
    protected $rule =   [
        'carousel_name'  => 'require',
        'carousel_url'   => 'require',
    ];

    protected $message  =   [
        'carousel_name.require' => 'validate/require_name',
        'carousel_url.require'   => 'validate/require_url',
    ];

    protected $scene = [
        'add'=> ['carousel_name','carousel_url'],
        'edit'=> ['carousel_name','carousel_url'],
    ];
}