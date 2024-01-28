<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>{{ url('/') }}/home</loc>
            <lastmod>{{ Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>

        <url>
            <loc>{{ url('/') }}/service</loc>
            <lastmod>{{ Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ url('/') }}/about-us</loc>
            <lastmod>{{ Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ url('/') }}/contact-us</loc>
            <lastmod>{{ Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>

    @foreach ($posts as $post)

        <?php if($post->type == 'service') { ?>
        <url>
            <loc>{{ url('/') }}/service/{{ $post->slug }}</loc>
            <lastmod>{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <?php } else  if($post->type == 'blog_category') { ?>
            <url>
                <loc>{{ url('/') }}/blog/category/{{ $post->slug }}</loc>
                <lastmod>{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        <?php } else  if($post->type == 'post') { ?>
            <url>
                <loc>{{ url('/') }}/blog/{{ $post->slug }}</loc>
                <lastmod>{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        <?php } else  if($post->type == 'blog_post') { ?>
            <url>
                <loc>{{ url('/') }}/blog/{{ $post->slug }}</loc>
                <lastmod>{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        <?php } else  if($post->type == 'main_service') { ?>
            <url>
                <loc>{{ url('/') }}/service/{{ $post->slug }}</loc>
                <lastmod>{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        <?php } ?>
    @endforeach
</urlset>