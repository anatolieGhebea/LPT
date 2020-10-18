<?php 

namespace App\Services;

class MigrationEncodeService {

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
public static function magrationContent($tableName, $fileds, $timeStamp = false ){

    $migrationClassName = 'Create'. MigrationEncodeService::snail_to_camel($tableName).'Table';

    $dataTypes = [
        'int' => 'DT_INT',
        'float' => 'DT_FLOAT',
        'boolean' => 'DT_BOOLEAN',
        'date' => 'DT_DATE',
        'datetime' => 'DT_DATE_TIME',
        'text' => 'DT_TEXT',
        'textarea' => 'DT_TEXT_AREA',
    ];

    $upFunction = '';
    foreach( $fileds as $fName => $props ){
        $fName = $props['name'];
        if( $fName == 'id' && $props['primary'] == true ){
            $upFunction .= '            $table->id();';
            continue;
        }
            
        $tb = '$table->';
        switch($props['dataType']){
            case "int":
                //"DT_INT"
                $row = $tb. 'integer(';
                break;

            case "float":
                //"DT_FLOAT"
                $row = $tb. 'float(';
                break;

            case "boolean": 
                //"DT_BOOLEAN"
                $row = $tb. 'tinyInteger(';
                break;

            case "date":
                //"DT_DATE"
                $row = $tb. 'date(';
                break;

            case "datetime":
                //"DT_DATE_TIME":
                $row = $tb. 'dateTime(';
                break;

            case "text":
                //"DT_TEXT":
                $row = $tb. 'string(';
                break;

            case "textarea":
                //"DT_TEXT_AREA":
                $row = $tb. 'longtext(';
                break;
        }

        $row .= '\''.$fName. '\'';

        if( isset($props['length']) && $props['length'] > 0 ){
            if( $props['dataType'] == 'text' || $props['dataType'] == 'textarea' )
                $row .= ','.$props['length'];
        }
        $row .= ')';

        if( !isset($props['required']) || !$props['required'] ){
            $row .= '->nullable()';
        }
        $row .= ';';

        $upFunction .=PHP_EOL .'            ' . $row;
    }

    if( $timeStamp ) {
        $upFunction .=PHP_EOL .'            $table->timestamps();';
    }


    $class = '<?php '. PHP_EOL ;

    $class .=PHP_EOL. '
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;';

    $class .=PHP_EOL.PHP_EOL. 'class  '. $migrationClassName .' extends Migration {';
    
    $class .=PHP_EOL. '
/**
* Run the migrations.
*
* @return void
*/';

    $class .=PHP_EOL. '     public function up() {';
    $class .=PHP_EOL. '         Schema::create(\''.$tableName.'\', function (Blueprint $table) { ';
    $class .=PHP_EOL. $upFunction;
    $class .=PHP_EOL. '         });';
    $class .=PHP_EOL. '     }'; // close up method

    $class .=PHP_EOL. '
/**
* Reverse the migrations.
*
* @return void
*/';

    $class .=PHP_EOL. '     public function down() { ';
    $class .=PHP_EOL. '         Schema::dropIfExists(\''.$tableName.'\');';
    $class .=PHP_EOL. '     }'; // close down method

    $class .=PHP_EOL. '}';

    return $class;

}//end of function

}