<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * モデルの日付カラムの保存フォーマット
     *
     * @var string
     */
    protected $dateFormat = 'U';
    
    /**
     * モデルのタイムスタンプを更新するかの指示
     *
     * @var bool
     */
    public $timestamps = false;
}
