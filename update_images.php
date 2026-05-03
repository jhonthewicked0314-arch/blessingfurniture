<?php
$files_to_update = [
    'index.php',
    'custom-furniture-makers-coimbatore.php',
    'custom-wooden-furniture-collections.php',
    'contact-blessing-furniture-coimbatore.php',
    'custom-furniture-faqs-coimbatore.php',
    'includes/header.php',
    'includes/footer.php'
];

foreach ($files_to_update as $filename) {
    if (!file_exists($filename)) continue;
    $content = file_get_contents($filename);
    
    $new_content = preg_replace_callback('/<img class="lazyload"[^>]+>/i', function($matches) {
        $img_tag = $matches[0];
        
        if (strpos($img_tag, 'loading="lazy"') === false && strpos($img_tag, "loading='lazy'") === false) {
            $img_tag = str_replace('<img class="lazyload" ', '<img class="lazyload" loading="lazy" ', $img_tag);
        }
        
        if (strpos($img_tag, 'class="lazyload"') === false && strpos($img_tag, "class='lazyload'") === false) {
            if (preg_match('/class=(["\'])(.*?)\1/i', $img_tag, $class_match)) {
                $classes = $class_match[2];
                if (strpos($classes, 'lazyload') === false) {
                    $new_classes = $classes . ' lazyload';
                    $img_tag = str_replace($class_match[0], 'class="' . $new_classes . '"', $img_tag);
                }
            } else {
                $img_tag = str_replace('<img loading="lazy" ', '<img loading="lazy" class="lazyload" ', $img_tag);
            }
        }
        return $img_tag;
    }, $content);
    
    file_put_contents($filename, $new_content);
    echo "Updated $filename\n";
}
?>
