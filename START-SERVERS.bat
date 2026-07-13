@echo off
title Pavitra B2B — Server Startup
echo.
echo  ╔══════════════════════════════════════════════╗
echo  ║     PAVITRA B2B — Starting All Services     ║
echo  ╚══════════════════════════════════════════════╝
echo.

set "BASEDIR=%~dp0"
set "MYSQLD=%BASEDIR%\db-bin\mariadb-10.11.8-winx64\bin\mysqld.exe"
set "DATADIR=%BASEDIR%\db-bin\mariadb-10.11.8-winx64\data"
set "PHP=%BASEDIR%\php-bin\php.exe"
set "CLOUDFLARED=%BASEDIR%\cloudflared.exe"

REM 1. Kill leftover processes
echo [1/4] Cleaning up old processes...
taskkill /F /IM mysqld.exe /T >nul 2>&1
taskkill /F /IM cloudflared.exe /T >nul 2>&1
timeout /t 2 /nobreak >nul

REM 2. Start MariaDB
echo [2/4] Starting MariaDB database...
start "" /B "%MYSQLD%" "--datadir=%DATADIR%" "--port=3306" "--bind-address=127.0.0.1"
echo      Waiting for database to initialize...
timeout /t 8 /nobreak >nul
netstat -an | find ":3306" >nul 2>&1
if %errorlevel%==0 (
    echo      [OK] MariaDB running on port 3306
) else (
    echo      [WARN] MariaDB may still be starting, please wait...
)

REM 3. Start PHP server
echo [3/4] Starting PHP development server on port 8000...
start "PHP Server" /MIN "%PHP%" -S 127.0.0.1:8000 -t "%BASEDIR%\public"
timeout /t 2 /nobreak >nul
echo      [OK] PHP server started at http://localhost:8000

REM 4. Start Cloudflare tunnel
echo [4/4] Starting Cloudflare tunnel...
start "Cloudflare Tunnel" /MIN "%CLOUDFLARED%" tunnel --url http://localhost:8000
echo      Tunnel starting... check the title bar of the Cloudflare window for the public URL
echo.
echo  ╔══════════════════════════════════════════════════════════════════╗
echo  ║  DONE! All services starting.                                   ║
echo  ║                                                                  ║
echo  ║  Local:   http://localhost:8000                                  ║
echo  ║  Public:  Check the "Cloudflare Tunnel" window title            ║
echo  ║           (look for: https://xxxx.trycloudflare.com)            ║
echo  ╚══════════════════════════════════════════════════════════════════╝
echo.
echo  TIP: Run this script every time you restart your PC.
echo  Press any key to close this window (servers keep running)...
pause >nul
