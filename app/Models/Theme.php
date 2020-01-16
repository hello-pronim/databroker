<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $primaryKey = 'themeIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'themeIdx', 'communityIdx', 'themeName', 'themeText'
    ];
 	
 	public function offer(){
    	return $this->belongsToMany('App\Models\Offer', 'App\Models\OfferTheme', 'themeIdx', 'offerIdx');
    }   

    protected static function get_theme_by_community($community){
    	$themes = Theme::select('themes.*', 'communities.communityName') 
                        ->join('communities', 'communities.communityIdx', '=',  'themes.communityIdx')
                        ->where('communities.communityName', ucfirst($community))->get();                        

		return $themes;                        
    }
}
