<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'author_id', 'description', 'image'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }
}
