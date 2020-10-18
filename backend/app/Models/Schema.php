<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    //
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'schemas';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['title', 'description'];
    protected $dates = [];

    public function tables(){
        return $this->hasMany('App\Models\Table');
    }


    public function getCreatedAt()
	{
		if( $this->created_at )
			return $this->created_at->format( 'd/m/Y H:i' );
		return '';
    }
    
    public function getUpdatedAt()
	{
		if( $this->updated_at )
			return $this->updated_at->format( 'd/m/Y H:i' );
		return '';
	}


}
