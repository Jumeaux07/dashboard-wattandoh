<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class UserActivity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'ip', 'module', 'navigator', 'action', 'pays', 'codepays', 'url',
    ];

    public static function saveActivity($module, $action)
    {
        $activity = new UserActivity;

        $activity->user_id = Auth::user()->id;
        $activity->module = $module;
        $activity->action = $action;

        $agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        // Detect Device/Operating System ( systeme d'exploitatiion )
        if (preg_match('/Linux/i', $agent)) $os = 'Linux';
        elseif (preg_match('/Mac/i', $agent)) $os = 'Mac';
        elseif (preg_match('/iPhone/i', $agent)) $os = 'iPhone';
        elseif (preg_match('/iPad/i', $agent)) $os = 'iPad';
        elseif (preg_match('/Droid/i', $agent)) $os = 'Droid';
        elseif (preg_match('/Unix/i', $agent)) $os = 'Unix';
        elseif (preg_match('/Windows/i', $agent)) $os = 'Windows';
        else $os = 'Unknown';

        // Browser Detection ( navigateur)
        if (preg_match('/Firefox/i', $agent)) $br = 'Firefox';
        elseif (preg_match('/Mac/i', $agent)) $br = 'Mac';
        elseif (preg_match('/Chrome/i', $agent)) $br = 'Chrome';
        elseif (preg_match('/Opera/i', $agent)) $br = 'Opera';
        elseif (preg_match('/MSIE/i', $agent)) $br = 'IE';
        else $br = 'Unknown'; //  Unknown = Inconnue
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

        $activity->pays        = (isset($_SERVER['GEOIP_COUNTRY_NAME'])) ? $_SERVER['GEOIP_COUNTRY_NAME'] : '';
        $activity->codepays    = (isset($_SERVER['GEOIP_COUNTRY_CODE'])) ? $_SERVER['GEOIP_COUNTRY_CODE'] : '';
        $activity->url        = (isset($_SERVER['SCRIPT_URI'])) ? $_SERVER['SCRIPT_URI'] : '';

        $activity->pays = $br . '/' . $os;;
        $activity->navigator = $br . '/' . $os;;
        $activity->navigator = $br . '/' . $os;;
        $activity->navigator = $br . '/' . $os;;
        $activity->ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '';

        $activity->save();
        // dd($activity);

        return $activity;
    }
}
