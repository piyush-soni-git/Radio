@echo off
title Start AzuraCast Radio Engine
echo ========================================================
echo               Starting AzuraCast Engine
echo ========================================================
echo.
wsl -u root -- service docker start
wsl -u root -- bash -c "cd /mnt/c/azuracast && docker compose up -d"
echo.
echo AzuraCast is up and running!
echo Access local dashboard at: http://localhost
echo.
pause
