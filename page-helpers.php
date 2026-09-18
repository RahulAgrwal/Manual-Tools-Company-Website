<?php
// Shared helpers, loaded by common-head.php. Paths are relative to the repo root.
if (!function_exists('mtc_img')) {
    // The WebP copy made by tools/optimize_images.py when it exists,
    // otherwise the original path.
    function mtc_img($path)
    {
        $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);
        return ($webp !== $path && is_file(__DIR__ . '/' . $webp)) ? $webp : $path;
    }

    // Small gallery thumbnail (<name>.thumb.webp), falling back to mtc_img().
    function mtc_thumb($path)
    {
        $thumb = preg_replace('/\.(jpe?g|png)$/i', '.thumb.webp', $path);
        return ($thumb !== $path && is_file(__DIR__ . '/' . $thumb)) ? $thumb : mtc_img($path);
    }

    // width="…" height="…" for an image file, so the browser can reserve
    // space before it loads (prevents layout shift). Empty if unreadable.
    function mtc_img_size($path)
    {
        $info = @getimagesize(__DIR__ . '/' . $path);
        return $info ? 'width="' . $info[0] . '" height="' . $info[1] . '"' : '';
    }

    // An asset URL with ?v=<mtime>, so a deploy invalidates it immediately.
    // .htaccess caches CSS and JS for a week and filenames are not hashed, so
    // without this a returning visitor gets new markup with the old stylesheet.
    function mtc_asset($path)
    {
        $mtime = @filemtime(__DIR__ . '/' . $path);
        return $mtime ? $path . '?v=' . $mtime : $path;
    }

    // BreadcrumbList JSON-LD. $trail maps page names to slugs ('' = home),
    // e.g. ['Products' => 'products', 'Haulage Machine' => 'haulage'].
    function mtc_breadcrumb_schema(array $trail)
    {
        $items = [];
        $position = 1;
        foreach (['Home' => ''] + $trail as $name => $slug) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $name,
                'item' => 'https://www.manualtoolsco.com/' . $slug,
            ];
        }
        $data = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items];
        echo '<script type="application/ld+json">' . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
    }
}
