#!/bin/bash
set -e

echo "=== Installation des sous-modules H5P ==="

cd /var/www/html/mod/hvp

# 1. h5p-php-library (library/)
echo "[1/3] h5p-php-library..."
rm -rf library
curl -sL -o lib.zip "https://github.com/h5p/h5p-php-library/archive/refs/heads/moodle.zip"
unzip -q lib.zip
mv h5p-php-library-* library
rm lib.zip
echo "  [OK] library/"

# 2. h5p-editor-php-library (editor/)
echo "[2/3] h5p-editor-php-library..."
rm -rf editor
curl -sL -o editor.zip "https://github.com/h5p/h5p-editor-php-library/archive/refs/heads/stable.zip"
unzip -q editor.zip
mv h5p-editor-php-library-* editor
rm editor.zip
echo "  [OK] editor/"

# 3. h5p-php-report (reporting/)
echo "[3/3] h5p-php-report..."
rm -rf reporting
curl -sL -o report.zip "https://github.com/h5p/h5p-php-report/archive/refs/heads/stable.zip"
unzip -q report.zip
mv h5p-php-report-* reporting
rm report.zip
echo "  [OK] reporting/"

chown -R www-data:www-data library editor reporting
echo ""
echo "=== Verification ==="
ls library/h5p.classes.php && echo "[OK] h5p.classes.php present"
ls editor/h5peditor.class.php && echo "[OK] h5peditor.class.php present"
