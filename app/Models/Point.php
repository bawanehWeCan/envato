<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['stander_id', 'rate_id', 'points'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['points' => 'double', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    

	public function stander()
	{
		return $this->belongsTo(\App\Models\Stander::class);
	}	
	public function rate()
	{
		return $this->belongsTo(\App\Models\Rate::class);
	}
}
