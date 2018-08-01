<?php

namespace Codwelt\codinstagram\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Codinstagrammodelscope extends Model
{
    use SoftDeletes;
    protected $table = "codinstagramscope";
    protected $fillable = ['scope'];

    public function ConfigScope(){
        return $this->hasOne(Codinstagrammodelconfig::class, 'ScopeId', 'id');
    }
}
