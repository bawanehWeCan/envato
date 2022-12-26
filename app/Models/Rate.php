<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'by_id', 'extra', 'anonymous', 'avg', 'request'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['extra' => 'string', 'anonymous' => 'boolean', 'avg' => 'double', 'request' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}	
	public function sender()
	{
		return $this->belongsTo(\App\Models\User::class,'by_id');
	}
}
