<?php

namespace barooei\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    const Pending ='pending';
    const IN_ProGrEss ='in_proggress';
    const Done = 'done';

    static $type=[self::Pending,self::IN_ProGrEss,self::Done];

}
