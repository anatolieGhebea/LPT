<?php 

namespace App\Services;

use Egulias\EmailValidator\Exception\CRNoLF;

class ModelEncodeService {

const DT_INT = 'int';
const DT_FLOAT = 'float';
const DT_BOOLEAN = 'boolean';
const DT_DATE = 'date';
const DT_DATE_TIME = 'datetime';
const DT_TEXT = 'text';
const DT_TEXT_AREA = 'textarea';
const dataTypes = [
    'int' => 'DT_INT',
    'float' => 'DT_FLOAT',
    'boolean' => 'DT_BOOLEAN',
    'date' => 'DT_DATE',
    'datetime' => 'DT_DATE_TIME',
    'text' => 'DT_TEXT',
    'textarea' => 'DT_TEXT_AREA',
];

const cmpTypes = [
    'text' => 'CMP_TEXT' ,
    'textarea' => 'CMP_TEXT_AREA' ,
    'number' => 'CMP_NUMBER' ,
    'select' => 'CMP_SELECT' ,
    'checkbox' => 'CMP_CHECKBOX' ,
    'hidden' => 'CMP_HIDDEN' ,
    'password' => 'CMP_PASSWORD' ,
    'email' => 'CMP_EMAIL' ,
];

public static function snail_to_camel( $str ){
    $bits = explode("_", $str);
    $res = '';
    foreach( $bits as $k => $v ){
        $res .= ucfirst($v);
    }
    return $res;
}

/**
 * 
 */
public static function modelContent($modelName,$modelNamespace = '', $tableName, $fields ) {

    $fillableStr = ''; //
    $datesStr = '';
    $filedStr = '';

    $extraSetMethods = '';
    $extraGetMethods = '';

    foreach( $fields as $fName => $props ){
        $fName = $props['name'];

        if($props['dataType'] == self::DT_DATE || $props['dataType'] == self::DT_DATE_TIME ){
            $datesStr .= '\''.$fName.'\',';

            // create data set
            $ffld = self::snail_to_camel($fName);
            $setMet = 'public function set'.$ffld.'Attribute($value) {'.PHP_EOL.
                            'if( $value ){'.PHP_EOL.
                                'if( is_string($value) ){'.PHP_EOL.
                                    '$this->attributes[\''.$fName.'\'] = \Carbon\Carbon::createFromFormat( getStdDateFmt(), $value)->format(\'Y-m-d\');'.PHP_EOL.
                                '} else {'.PHP_EOL.
                                    '$this->attributes[\''.$fName.'\'] = $value->format(\'Y-m-d\');'.PHP_EOL.
                                '}'.PHP_EOL.
                            '}'.PHP_EOL.
                        '}'.PHP_EOL;

            $extraSetMethods .= PHP_EOL. $setMet. PHP_EOL;

            // create getters
            $getMet = 'public function get'.$ffld.'(){'. PHP_EOL.
                        'if( $this->'.$fName.')'.PHP_EOL.
                            'return $this->birthdate->format( getStdDateFmt() );'.PHP_EOL.
                        'return \'\';'.PHP_EOL.
                    '}'.PHP_EOL;
                
            $extraGetMethods .= PHP_EOL. $getMet. PHP_EOL;
        }

        if(isset($props['fillable']) &&  $props['fillable']){
            $fillableStr .= '\''.$fName.'\',';
        }

        $cmpType = isset( self::cmpTypes[$props['cmpType']] ) ? self::cmpTypes[$props['cmpType']]: 'CMP_TEXT';
        $props['cmpType'] = 'AppConst::'.$cmpType;
        
        $dataType = isset( self::dataTypes[$props['dataType']] ) ? self::dataTypes[$props['dataType']]: 'DT_TEXT';
        $props['dataType'] = 'AppConst::'.$dataType;
        
        
        $stdProps = [ 'label', 'cmpType', 'dataType', 'length', 'description', 'required', 'primary', 'options' ];
        
        // converting array to string
        $fld = '\''.$fName.'\'=>[';
        // foreach( $props as $pn => $pv ) {
        foreach( $stdProps as $prop ) {
            
            if( isset( $props[$prop] ) ){
                $pn = $prop;
                $pv = $props[$prop];
            } else {
                continue;
            }

            if( $pn == 'fillable' )
                continue;

            $fld .= '\''.$pn .'\' =>';

            if( $pn == 'label' || $pn == 'description' || $pn == 'options' ) {
                $pv = str_replace("'", "\'", $pv);
                $fld .= '\''.$pv.'\'';
            } else {
                if( $pv === true ){
                    $fld .= 1 ;
                } else if ($pv ===  false) {
                    $fld .= 0 ;
                } else {
                    $fld .= $pv ;
                }
            }

            $fld .= ',';
        }

        $fld .= '\'fltCond\' =>\'=\' ';

        $fld .= '],';
        $filedStr .= PHP_EOL.'         '.$fld;
    }


    $class = '<?php '. PHP_EOL; // start file

    // $class .= 'namespace App\Models;';
    $nameSpace = empty($modelNamespace) ? 'App\Models;':$modelNamespace.';';
    $class .= 'namespace '.$nameSpace;

    $class .= '
use Illuminate\Database\Eloquent\Model;
use App\Helpers\AppConst;
';

    $class .= 'class '.$modelName.' extends Model { ';

    $class .= PHP_EOL . '
    /**
     * The table associated with the model.
     *
     * @var string
     */';

    $class .= PHP_EOL . '  protected $table = \''. $tableName .'\';';

    $class .= PHP_EOL . '
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    ';

    $class .= PHP_EOL . ' protected $fillable = [' . $fillableStr .'];';
    
    $class .= PHP_EOL . ' protected $dates = [' . $datesStr .'];';

    $class .= PHP_EOL . '
    /**
     * Return field structure
     */
    ';

    $class .= PHP_EOL . '   public static function getStandardFields($withId = false) {';
    $class .= PHP_EOL . '       $fields = [';
    $class .= PHP_EOL . $filedStr;
    $class .= PHP_EOL . '       ];';
    $class .= PHP_EOL . '       if(!$withId){';
    $class .= PHP_EOL . '           unset($fields[\'id\']);';
    $class .= PHP_EOL . '       }';
    $class .= PHP_EOL . '       return $fields;';
    $class .= PHP_EOL . '   }';

    $class .= PHP_EOL . '   '. $extraSetMethods;
    $class .= PHP_EOL . '   '. $extraGetMethods;

    $class .= PHP_EOL . '}'; // end of file

    return $class;

} // end of function

}