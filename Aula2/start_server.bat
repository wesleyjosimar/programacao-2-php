@echo off
echo ========================================
echo    Iniciando Servidor PHP Local
echo ========================================
echo.
echo Servidor sera iniciado em: http://localhost:8000
echo.
echo Para parar o servidor, pressione Ctrl+C
echo.
echo ========================================
echo.

cd /d "%~dp0"
php -S localhost:8000

pause
