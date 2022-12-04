<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Hero extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_hero', 'nama_hero','id_atribut','id_posisi'
    ];
    protected $primaryKey = 'id_hero';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}