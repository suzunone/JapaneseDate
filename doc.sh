
if [ ! -f doctum.phar ]; then
    curl -O https://doctum.long-term.support/releases/latest/doctum.phar
    chmod 0777 doctum.phar
fi
./doctum.phar update doctum-config.php -vvv --force
./doctum.phar update doctum-config-md.php -vvv --force
php man.php

