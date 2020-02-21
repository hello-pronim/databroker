<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Region;
use App\Models\Community;
use App\Models\Theme;

class Offer extends Model
{
    protected $primaryKey = 'offerIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offerIdx', 'communityIdx', 'providerIdx', 'offerTitle', 'offerImage', 'offerDescription', 'status', 'themes'
    ];    

    public function community(){
    	return $this->hasOne('App\Models\Community', 'communityIdx', 'communityIdx');
    }

    public function provider(){
        return $this->hasOne('App\Models\Provider', 'providerIdx', 'providerIdx');
    }

    public function offersample(){
        return $this->belongsTo('App\Models\OfferSample', 'offerIdx', 'offerIdx');
    }    

    public function offerproduct(){
        return $this->belongsTo('App\Models\OfferProduct', 'offerIdx', 'offerIdx');
    }    

    public function usecase(){
    	return $this->belongsTo('App\Models\UseCase', 'offerIdx', 'offerIdx');
    }

    public function region(){
    	return $this->belongsToMany('App\Models\Region', 'App\Models\OfferCountry', 'offerIdx', 'regionIdx');
    }

    public function theme(){
        return $this->belongsToMany('App\Models\Theme', 'App\Models\OfferTheme', 'offerIdx', 'themeIdx');
    }

    protected static function filter_offer($param){
        
        if($param->region){
            $dataoffer = Offer::with(['provider'])->select('offers.*', 'regions.*') 
                        ->leftjoin('offerCountries', 'offerCountries.offerIdx', '=',  'offers.offerIdx')
                        ->leftjoin('regions', 'regions.regionIdx', '=',  'offerCountries.regionIdx');
        }else{
            $dataoffer = Offer::with(['region', 'provider'])->select('offers.*'); 
        }        
        

        $dataoffer->leftjoin('offerThemes', 'offerThemes.offerIdx', '=',  'offers.offerIdx')
                  ->leftjoin('themes', 'themes.themeIdx', '=',  'offerThemes.themeIdx')                    
                  ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx');

        if($param->community && $param->community != 'all'){            
            $dataoffer->where('communities.communityIdx', $param->community);
        }   

        if($param->theme && $param->theme != 'all' ){
            $dataoffer->where('themes.themeIdx', $param->theme);
        }   

        if($param->region){
            $dataoffer->where('regions.regionIdx', $param->region);
        }   

        $dataoffer->where('offers.status', 1);
        $total_count = $dataoffer->get()->count();

        if( !isset($param->loadmore) || $param->loadmore == "false" ){
            if( $param->community == 'all' ){
                $result = $dataoffer->offset(0)->orderby('offers.offerIdx', 'DESC')->limit(12)->get();                
            }else{
                $result = $dataoffer->offset(0)->orderby('offers.offerIdx', 'DESC')->limit(11)->get();                
            }            
        }else{
            $result = $dataoffer->offset($param->loadmore-1)->orderby('offers.offerIdx', 'DESC')->limit(12)->get();
        }    

        $res = array( 'total_count' => $total_count, 'offers' => $result );

        return $res;                    
    }

    protected static function getProduct($user_id){
        $dataproduct = Offer::with(['region', 'offerproduct' => function($query){
                $query->select( DB::raw('count(*) as product_count, offerIdx'))->groupby('offerIdx');
            }])                        
            ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
            ->where('providers.userIdx', '=', $user_id)->get();

        return $dataproduct;
    }

}
