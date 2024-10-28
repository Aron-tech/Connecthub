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

    public function membersCount()
    {
        return $this->belongsToMany(User::class, 'group_user')->count();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function postsCount(){
        return $this->hasMany(Post::class)->count();
    }
}
