<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($companies as $company)
        <url>
            <loc>{{route('data.company_offers', ['companyName'=>str_replace(' ', '', strtolower($company['companyName']) )])}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($company['created_at'])) }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>