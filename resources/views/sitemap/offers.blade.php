<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($offers as $offer)
    	@php
    	$companyName = strtolower($offer['companyName']);
		$title = str_replace(' ', '-', strtolower($offer['offerTitle']) );
		$region = "";
		foreach($offer['region'] as $key=>$r){
			$region = $region . str_replace(' ', '-', strtolower($r->regionName));
			if($key+1 < count($offer['region'])) $region = $region . "-";
		}
    	@endphp
        <url>
            <loc>{{route('data_details', ['companyName'=>$companyName, 'param'=>$title.'-'.$region])}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($offer['createdAt'])) }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>