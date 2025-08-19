# Script PowerShell para iniciar servidor PHP local
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "    Iniciando Servidor PHP Local" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Servidor será iniciado em: http://localhost:8000" -ForegroundColor Green
Write-Host ""
Write-Host "Para parar o servidor, pressione Ctrl+C" -ForegroundColor Yellow
Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Navegar para o diretório do script
Set-Location $PSScriptRoot

# Iniciar servidor PHP
php -S localhost:8000

Write-Host ""
Write-Host "Servidor parado." -ForegroundColor Red
Read-Host "Pressione Enter para sair"
