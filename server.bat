@echo off
set PHP_INI_DIR=%~dp0php
set PATH=%~dp0php;%PATH%
for /f "tokens=2 delims=:" %%f in ('ipconfig ^| find "IPv4"') do set IP=%%f
set IP=%IP:~1%

.\php\php.exe -d extension=php_sqlite3.dll -d extension=php_pdo_sqlite.dll artisan serve --host=%IP% --port=8000
pause