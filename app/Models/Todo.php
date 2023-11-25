<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Request;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todos';
    protected $fillable = ['user_id','name', 'description', 'status'];

    /**
     * relations belongs to todos table
     */
    public function User() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get List Data
     */
    public function scopeGetLists($query, Request $request)
    {
        $sort = $request->input('sort') ? explode('|', $request->input('sort') ) : ['id', 'desc'];
        return $query
        ->from('todos')
        ->where( function( $todo ) use( $request ){

             /**
              * This fucntion for search By search
              * @param $request->search
              */
             if( $request->has('search') ){
                 $lowerSearch = '%'.strtolower($request->input('search')).'%';
                 $todo->where(\DB::raw('lower(name)'), 'like', $lowerSearch);
             }

             /**
              * This fucntion for search By start date & end date
              * @param $request->start_date
              * @param $request->end_date
              */
             if( $request->has('start_date') && $request->has('end_date') ){
                 $startDate = $request->input('start_date');
                 $endDate = $request->input('end_date');
                 $todo->whereBetween('price', array($startDate, $endDate));
             }
        })->orderby($sort[0], $sort[1]);
    }
}
