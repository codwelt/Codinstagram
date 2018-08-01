<?php

namespace Codwelt\codinstagram\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Codinstagrammodelconfig extends Model
{
    use SoftDeletes;
    protected $table = "codinstagramconfig";
    protected $fillable = ['id', 'ClientID', 'ClientSecret', 'RedirectUrl', 'ScopeId', 'token', 'code', 'idinstagram', 'username', 'profile_picture', 'full_name', 'bio', 'website', 'is_business', 'media', 'follows', 'followed_by'];

    public function Scope()
    {
        return $this->belongsTo(Codinstagrammodelscope::class, 'ScopeId', 'id');
    }
}
