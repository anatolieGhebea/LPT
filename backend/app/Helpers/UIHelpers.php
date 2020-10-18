<?php 

// const for model names 
const MODEL_EDUCATOR = 'educator';
const MODEL_MIGRANT = 'migrant';
const MODEL_CAS = 'cas';

/**
 * Default date format
 */
function getStdDateFmt(){
    $dateFmt = "d/m/Y";    
    return $dateFmt;
}

/* 
 * Standard icons 
 */

function getEmailIcon($class = 'text-muted mr-2'){
    return '<span class="'.$class.'"><i class="fa fa-envelope" aria-hidden="true"></i></span>';
}

function getPhoneIcon($class = 'text-muted mr-2'){
    return '<span class="'.$class.'"><i class="fa fa-phone" aria-hidden="true"></i></span>';
}

function getFaxIcon($class = 'text-muted mr-2'){
    return '<span class="'.$class.'"><i class="fa fa-fax" aria-hidden="true"></i></span>';
}

function getCheckOnOffIcon( $status ){
    $icon = '<i class="fa fa-minus text-danger" title="non attivo" aria-hidden="true"></i>';
    if( $status )
        $icon = '<i class="fa fa-check text-success" title="attivo" aria-hidden="true"></i>';

    return $icon;
}

function getUnderAgeIcon( $status ){
    $icon = '<i class="fa fa-circle text-danger" aria-hidden="true"></i>';
    return $icon;
}

/**
 * @param Int number of the alerts
 * @return String an html string 
 */
function warningRecalls($numAlerts) {

    $res = '';
        
    if( $numAlerts == 0 ) {
        $res = $numAlerts;
    } else if ( $numAlerts > 0 ){
        $res = '<span class="mr-2 text-warning" > <i  class="fa fa-exclamation-triangle" aria-hidden="true"></i></span> '. $numAlerts;

    } else if( $numAlerts > 2){
        $res = '<span class="mr-2 text-danger" > <i  class="fa fa-exclamation-triangle" aria-hidden="true"></i></span> ' . $numAlerts;
    }
        
    return $res;
}