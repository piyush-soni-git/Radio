@echo off
title AzuraCast Global Public Tunnel Launcher
echo ========================================================
echo       AzuraCast Web Radio - Global Access Launcher
echo ========================================================
echo.
echo Starting global public HTTPS tunnel via Pinggy / SSH...
echo Your AzuraCast website will be accessible globally worldwide!
echo.
wsl -u root -- ssh -p 443 -R 0:localhost:80 qr@a.pinggy.io
pause
