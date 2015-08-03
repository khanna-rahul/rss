<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
	protected $table = 'feeds';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url'];

}


?>