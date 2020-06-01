<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($communities as $community)
        <url>
            <loc>{{route('data_community.'. str_replace( ' ', '_', strtolower($community->communityName)))}}</loc>
            <changefreq>daily</changefreq>
            <priority>0.4</priority>
        </url>
    @endforeach
</urlset>