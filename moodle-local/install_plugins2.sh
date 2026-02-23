#!/bin/bash
set -e

echo "=== INSTALLATION DES PLUGINS TIERS MOODLE ==="

cd /var/www/html/mod

# 1. Customcert
echo "[1/5] mod_customcert..."
if [ ! -d "customcert" ]; then
    curl -sL -o customcert.zip "https://github.com/mdjnelson/moodle-mod_customcert/archive/refs/heads/MOODLE_404_STABLE.zip"
    unzip -q customcert.zip
    mv moodle-mod_customcert-* customcert
    rm customcert.zip
    chown -R www-data:www-data customcert
    echo "  [OK] mod_customcert"
else
    echo "  [SKIP] deja present"
fi

# 2. Attendance
echo "[2/5] mod_attendance..."
if [ ! -d "attendance" ]; then
    curl -sL -o attendance.zip "https://github.com/danmarsden/moodle-mod_attendance/archive/refs/heads/main.zip"
    unzip -q attendance.zip
    mv moodle-mod_attendance-* attendance
    rm attendance.zip
    chown -R www-data:www-data attendance
    echo "  [OK] mod_attendance"
else
    echo "  [SKIP] deja present"
fi

# 3. Completion Progress block
echo "[3/5] block_completion_progress..."
cd /var/www/html/blocks
if [ ! -d "completion_progress" ]; then
    curl -sL -o cp.zip "https://github.com/deraadt/moodle-block_completion_progress/archive/refs/heads/master.zip"
    unzip -q cp.zip
    mv moodle-block_completion_progress-* completion_progress
    rm cp.zip
    chown -R www-data:www-data completion_progress
    echo "  [OK] block_completion_progress"
else
    echo "  [SKIP] deja present"
fi

# 4. Theme Boost Union
echo "[4/5] theme_boost_union..."
cd /var/www/html/theme
if [ ! -d "boost_union" ]; then
    curl -sL -o bu.zip "https://github.com/moodle-an-hochschulen/moodle-theme_boost_union/archive/refs/heads/main.zip"
    if file bu.zip | grep -q "Zip archive"; then
        unzip -q bu.zip
        mv moodle-theme_boost_union-* boost_union
        rm bu.zip
        chown -R www-data:www-data boost_union
        echo "  [OK] theme_boost_union"
    else
        echo "  [SKIP] zip invalide"
        rm -f bu.zip
    fi
else
    echo "  [SKIP] deja present"
fi

# 5. Logstore xAPI
echo "[5/5] logstore_xapi..."
cd /var/www/html/admin/tool/log/store
if [ ! -d "xapi" ]; then
    curl -sL -o xapi.zip "https://github.com/xAPI-vle/moodle-logstore_xapi/archive/refs/heads/master.zip"
    if file xapi.zip | grep -q "Zip archive"; then
        unzip -q xapi.zip
        mv moodle-logstore_xapi-* xapi
        rm xapi.zip
        chown -R www-data:www-data xapi
        echo "  [OK] logstore_xapi"
    else
        echo "  [SKIP] zip invalide"
        rm -f xapi.zip
    fi
else
    echo "  [SKIP] deja present"
fi

echo ""
echo "=== VERIFICATION FINALE ==="
for p in /var/www/html/mod/hvp /var/www/html/mod/customcert /var/www/html/mod/attendance; do
    if [ -d "$p" ]; then echo "[OK] $p"; else echo "[MANQUE] $p"; fi
done
for p in /var/www/html/blocks/completion_progress; do
    if [ -d "$p" ]; then echo "[OK] $p"; else echo "[MANQUE] $p"; fi
done
for p in /var/www/html/theme/boost_union; do
    if [ -d "$p" ]; then echo "[OK] $p"; else echo "[MANQUE] $p"; fi
done
