<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{

    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'fields';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['table_id','name','label','cmpType','dataType','length','description','primary','required','fillable'];
    protected $dates = [];
    
    public function table(){
        return $this->belongsTo('App\Models\Table');
    }

    public function getCreateAt()
	{
		if( $this->created_at )
			return $this->birthdate->created_at( 'd/m/Y H:i' );
		return '';
    }
    
    public function getUpdatedAt()
	{
		if( $this->updated_at )
			return $this->birthdate->updated_at( 'd/m/Y H:i' );
		return '';
	}
}
