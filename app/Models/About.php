<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $appends = ['about_image'];


    public function getAboutImageAttribute(){
        return url('public/image/'.$this->about_img);
    }

}
