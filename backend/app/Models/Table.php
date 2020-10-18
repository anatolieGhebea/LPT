<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'tables';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['schema_id', 'tableName','model','modelNamespace','modelExtraContent','controller','controllerNamespace','controllerPrependMethods','createMigration','createModel','createController','addTimestamp'];
    protected $dates = [];
    

    public function fields(){
        return $this->hasMany('App\Models\Field');
    }

    public function schema(){
        return $this->belongsTo('App\Models\Schema');
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
