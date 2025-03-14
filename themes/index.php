
<?php

require '../themes/handlers/index.php';

$theme = themeChecker();
$theme = $theme ?? 'default';

function load_assets(string $type, string $themePath): void {

    $dir = $themePath.'/'.$type;

    if (!is_dir($dir)) {
        echo '<!-- Error: Folder '.$dir.' does not exist! -->';
    }

    $files = glob($dir . '/*.'.$type);
    if (!$files) {
        echo '<!-- No '.$type.' files found in '.$dir.' -->';
    }

    foreach ($files as $file) {
        $url = str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath($file));
        $url = str_replace('\\', '/', $url); // fix for Windows

        if ($type === 'css') {
            echo "<link rel='stylesheet' href='$url'>\n";
        } elseif ($type === 'js') {
            echo "<script src='$url'></script>\n";
        } else {
            echo "<!-- Error: Unknown file type '$type' -->\n";
        }
    }
    echo PHP_EOL;
}

load_assets('css', '../themes/'.$theme);

load_assets('js', '../themes/'.$theme);
