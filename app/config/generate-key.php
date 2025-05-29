<?php

$root_path = dirname(__DIR__);
$env_path = $root_path . '/../.env';

echo "Generating new CSRF_SECRET_KEY and updating .env...\n";


$new_key = bin2hex(random_bytes(32));

$env_content = '';


if (file_exists($env_path)) {
    $env_content = file_get_contents($env_path);
}

$updated_content = '';
$key_updated = false;


$lines = explode("\n", $env_content);

foreach ($lines as $line) {
    
    if (str_starts_with($line, 'CSRF_SECRET_KEY=')) {
        
        $updated_content .= "CSRF_SECRET_KEY=\"{$new_key}\"\n";
        $key_updated = true;
    } else {
        
        $updated_content .= $line . "\n";
    }
}


if (!$key_updated) {
    
    if (!empty($updated_content) && substr($updated_content, -1) !== "\n") {
        $updated_content .= "\n"; 
    }
    $updated_content .= "CSRF_SECRET_KEY=\"{$new_key}\"\n";
}


$updated_content = rtrim($updated_content, "\n");


if (file_put_contents($env_path, $updated_content) !== false) {
    echo "CSRF_SECRET_KEY updated in .env successfully!\n";
    echo "New Key: {$new_key}\n";
    echo "Remember to replace YOUR_RECAPTCHA_SITE_KEY and YOUR_RECAPTCHA_SECRET_KEY in your .env file manually.\n";
} else {
    echo "Failed to write to .env file. Please check file permissions for: {$env_path}\n";
    exit(1); 
}

?>