<?php 
namespace App\Helpers;

// HELPER CLASS 
// creating this helper class to keep the custom data types consistent acrosso all the application files
class AppConst {

    // CONST DOR FIELD $cmpType
    const CMP_TEXT = 'text';
    const CMP_TEXT_AREA = 'textarea';
    const CMP_NUMBER = 'number';
    const CMP_SELECT = 'select';
    const CMP_CHECKBOX = 'checkbox';
    const CMP_HIDDEN = 'hidden';
    const CMP_PASSWORD = 'password';
    const CMP_EMAIL = 'email';
    
    // CONST FOR FIELD $dataType
    const DT_INT = 'int';
    const DT_FLOAT = 'float';
    const DT_BOOLEAN = 'boolean';
    const DT_DATE = 'date';
    const DT_TEXT = 'text';
    const DT_TEXT_AREA = 'textarea';

    // CONST DOR FIELD $fltType
    const FLT_DEFAULT = 'default';
    const FLT_RANGE = 'range';


    // crud operation costants
    const OP_CREATE = 'create';
    const OP_READ = 'read';
    const OP_UPDATE = 'update';
    const OP_DELETE = 'delete';

    const CRUD_OPERATIONS = ['create', 'read', 'update', 'delete'];

    // 
    const DEFAULT_PAGE_SIZE = 30;

}
?>