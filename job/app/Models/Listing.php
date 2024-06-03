<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    protected $fillable=['title','company','location','email','description','website','tags','user_id','listing_id'];
    public function scopeFilter($query, array $filters)
    {
        if($filters['tag']??false){
            $query->where('tags','like','%'.request('tag').'%');
        }
        if($filters['search']??false){
            $query->where('title','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%')
            ->orWhere('tags','like','%'.request('search').'%');
        }
    }

    //Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // Define the relationship with JobApplication
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
