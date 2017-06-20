<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Department;
use App\User;
use App\Models\ProjectFile;
use App\Models\Label;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id', 'title', 'objective', 'description', 'status', 'creator_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'creator_id');
    }

    public function contributor(){
        return $this->belongsToMany(User::class,'project_contributors','project_id','contributor_id');
    }

    public function file(){
        return $this->hasMany(ProjectFile::class,'project_id');
    }

    public function label(){
        return $this->belongsToMany(Label::class,'project_label','project_id','label_id');
    }
}
