<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSVEHICLEMANAGERusersTable extends JSVEHICLEMANAGERtable {

    public $id = '';
    public $uid = '';
    public $name = '';
    public $cell = '';
    public $phone = '';
    public $email = '';
    public $weblink = '';
    public $status = '';
    public $autogenerated = '';
    public $issocial = '';
    public $socialid = '';
    public $photo = '';
    public $cityid = '';
    public $address = '';
    public $latitude = '';
    public $longitude = '';
    public $description = '';
    public $videotypeid = '';
    public $video = '';
    public $facebook = '';
    public $twitter = '';
    public $linkedin = '';
    public $googleplus = '';
    public $pinterest = '';
    public $instagram = '';
    public $reddit = '';
    public $created = '';
    public $params = '';
    public $hash = '';

    function __construct() {
        parent::__construct('users', 'id'); // tablename, primarykey
    }

}

?>