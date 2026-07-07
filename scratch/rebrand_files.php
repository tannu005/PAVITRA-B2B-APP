<?php
// =================================================================
// PAVITRA TO PAVIITRA DESIGNER FILE CONTENT REBRANDING SCRIPT
// =================================================================

function rebrandFile($filePath) {
    $content = file_get_contents($filePath);
    $original = $content;

    // 1. Replace Pavitra B2B (case-insensitive) with Paviitra Designer
    $content = preg_replace('/\bPavitra\s+B2B\b/i', 'Paviitra Designer', $content);

    // 2. Replace Pavitra Wholesale (case-insensitive) with Paviitra Designer
    $content = preg_replace('/\bPavitra\s+Wholesale\b/i', 'Paviitra Designer', $content);

    // 3. Replace standalone Pavitra (but not if it starts with pavitra- or followed by - or part of class/id)
    // We can use a negative lookahead and lookbehind to avoid:
    // - pavitra-logo-svg, pavitra-edge-, pavitra-zoom-
    // - pavitra_wishlist
    // - PavitraB2B-Android-APK
    // Let's use regex:
    // Match Pavitra if NOT preceded by - or _ or a word char, and NOT followed by - or _ or B2B-Android
    // Standalone matches: 'Pavitra' in 'Pavitra ', 'Pavitra.', 'Pavitra\'s', etc.
    $content = preg_replace('/(?<![a-zA-Z0-9_-])Pavitra(?![a-zA-Z0-9_-])/i', 'Paviitra Designer', $content);

    if ($content !== $original) {
        file_put_contents($filePath, $content);
        echo "Rebranded: " . str_replace('C:\xampp\htdocs\pavitra-b2b\\', '', $filePath) . "\n";
    }
}

function processDirectory($dir) {
    $it = new RecursiveDirectoryIterator($dir);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            rebrandFile($file->getPathname());
        }
    }
}

echo "Starting files rebranding...\n";
processDirectory(__DIR__ . '/../src/Controllers');
processDirectory(__DIR__ . '/../src/Views');
echo "Files rebranding completed.\n";
