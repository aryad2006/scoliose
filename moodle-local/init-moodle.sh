#!/bin/bash
set -e

MOODLE_DIR="/var/www/html"
MOODLE_DATA="/var/www/moodledata"

# Télécharger Moodle si pas encore fait
if [ ! -f "$MOODLE_DIR/version.php" ]; then
    echo "=== Telechargement de Moodle 4.5 ==="
    cd /tmp
    curl -L -o moodle.tgz https://download.moodle.org/download.php/direct/stable405/moodle-latest-405.tgz
    tar xzf moodle.tgz --strip-components=1 -C "$MOODLE_DIR"
    rm moodle.tgz
    echo "=== Moodle telecharge ==="
fi

# Permissions
mkdir -p "$MOODLE_DATA"
chown -R www-data:www-data "$MOODLE_DIR" "$MOODLE_DATA"
chmod -R 755 "$MOODLE_DIR"
chmod -R 777 "$MOODLE_DATA"

# Attendre PostgreSQL via PHP
echo "=== Attente de PostgreSQL ==="
for i in $(seq 1 30); do
    if php -r "\$c = @pg_connect('host=db port=5432 dbname=moodle user=moodle_user password=moodle_password_2026'); if(\$c){echo 'OK';exit(0);}else{exit(1);}" 2>/dev/null; then
        echo " - PostgreSQL pret."
        break
    fi
    echo "Attente DB... $i/30"
    sleep 3
done

# Installer Moodle
if [ ! -f "$MOODLE_DIR/config.php" ]; then
    echo "=== Installation de Moodle avec PostgreSQL 17 ==="
    php "$MOODLE_DIR/admin/cli/install.php" \
        --wwwroot=http://localhost:8890 \
        --dataroot="$MOODLE_DATA" \
        --dbtype=pgsql \
        --dbhost=db \
        --dbport=5432 \
        --dbname=moodle \
        --dbuser=moodle_user \
        --dbpass=moodle_password_2026 \
        --fullname='Formation Scoliose avec SpineSim' \
        --shortname=ScolioseFR \
        --adminuser=admin \
        --adminpass=ScolioseLMS2026 \
        --adminemail=admin@scoliose.local \
        --lang=fr \
        --agree-license \
        --non-interactive
    echo "=== Moodle installe avec succes ==="
else
    echo "=== Moodle deja configure ==="
fi

# Lancer Apache
echo "=== Demarrage Apache ==="
exec apache2-foreground
