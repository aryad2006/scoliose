#!/bin/bash
set -e

echo "=== INSTALLATION DES PLUGINS MOODLE ==="
cd /var/www/html

# 1. mod_hvp - H5P Interactive Content (version compatible Moodle 4.5)
echo ""
echo "[1/7] Installation mod_hvp (H5P)..."
cd /var/www/html/mod
if [ ! -d "hvp" ]; then
    curl -L -o hvp.zip "https://github.com/h5p/moodle-mod_hvp/archive/refs/heads/stable.zip" 2>/dev/null
    unzip -q hvp.zip
    mv moodle-mod_hvp-stable hvp
    rm hvp.zip
    chown -R www-data:www-data hvp
    echo "    [OK] mod_hvp installe"
else
    echo "    [SKIP] mod_hvp deja present"
fi

# 2. mod_customcert - Certificats personnalisables
echo ""
echo "[2/7] Installation mod_customcert (Certificats)..."
cd /var/www/html/mod
if [ ! -d "customcert" ]; then
    curl -L -o customcert.zip "https://github.com/mdjnelson/moodle-mod_customcert/archive/refs/heads/MOODLE_405_STABLE.zip" 2>/dev/null
    if [ $? -ne 0 ]; then
        curl -L -o customcert.zip "https://github.com/mdjnelson/moodle-mod_customcert/archive/refs/heads/master.zip" 2>/dev/null
    fi
    unzip -q customcert.zip
    mv moodle-mod_customcert-* customcert
    rm customcert.zip
    chown -R www-data:www-data customcert
    echo "    [OK] mod_customcert installe"
else
    echo "    [SKIP] mod_customcert deja present"
fi

# 3. mod_attendance - Suivi des presences
echo ""
echo "[3/7] Installation mod_attendance (Presences)..."
cd /var/www/html/mod
if [ ! -d "attendance" ]; then
    curl -L -o attendance.zip "https://github.com/danmarsden/moodle-mod_attendance/archive/refs/heads/main.zip" 2>/dev/null
    unzip -q attendance.zip
    mv moodle-mod_attendance-* attendance
    rm attendance.zip
    chown -R www-data:www-data attendance
    echo "    [OK] mod_attendance installe"
else
    echo "    [SKIP] mod_attendance deja present"
fi

# 4. block_completion_progress - Barre de progression
echo ""
echo "[4/7] Installation block_completion_progress..."
cd /var/www/html/blocks
if [ ! -d "completion_progress" ]; then
    curl -L -o completion_progress.zip "https://github.com/deraadt/moodle-block_completion_progress/archive/refs/heads/master.zip" 2>/dev/null
    unzip -q completion_progress.zip
    mv moodle-block_completion_progress-* completion_progress
    rm completion_progress.zip
    chown -R www-data:www-data completion_progress
    echo "    [OK] block_completion_progress installe"
else
    echo "    [SKIP] block_completion_progress deja present"
fi

# 5. local_adminer - Administration BDD (dev uniquement)
echo ""
echo "[5/7] Installation report_coursestats..."
cd /var/www/html/report
if [ ! -d "completion" ]; then
    echo "    [SKIP] report_completion natif deja present"
else
    echo "    [OK] report_completion natif disponible"
fi

# 6. theme_boost_union - Theme ameliore (fork de Boost)
echo ""
echo "[6/7] Installation theme_boost_union..."
cd /var/www/html/theme
if [ ! -d "boost_union" ]; then
    curl -L -o boost_union.zip "https://github.com/moodle-an-hochschulen/moodle-theme_boost_union/archive/refs/heads/main.zip" 2>/dev/null
    unzip -q boost_union.zip
    mv moodle-theme_boost_union-* boost_union
    rm boost_union.zip
    chown -R www-data:www-data boost_union
    echo "    [OK] theme_boost_union installe"
else
    echo "    [SKIP] theme_boost_union deja present"
fi

# 7. mod_board - Tableau collaboratif (Kanban)
echo ""
echo "[7/7] Installation mod_board..."
cd /var/www/html/mod
if [ ! -d "board" ]; then
    curl -L -o board.zip "https://github.com/brickfield/moodle-mod_board/archive/refs/heads/main.zip" 2>/dev/null
    unzip -q board.zip
    mv moodle-mod_board-* board 2>/dev/null || true
    rm -f board.zip
    chown -R www-data:www-data board 2>/dev/null || true
    echo "    [OK] mod_board installe"
else
    echo "    [SKIP] mod_board deja present"
fi

echo ""
echo "=== TOUS LES PLUGINS TELECHARGES ==="
echo ""
echo "Plugins installes dans /var/www/html/mod :"
ls -d /var/www/html/mod/hvp /var/www/html/mod/customcert /var/www/html/mod/attendance /var/www/html/mod/board 2>/dev/null || true
echo ""
echo "Plugins installes dans /var/www/html/blocks :"
ls -d /var/www/html/blocks/completion_progress 2>/dev/null || true
echo ""
echo "Themes installes dans /var/www/html/theme :"
ls -d /var/www/html/theme/boost_union 2>/dev/null || true
