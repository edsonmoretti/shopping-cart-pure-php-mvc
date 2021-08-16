@echo off
@echo OBS.: Requer  PHP 7.4+
@echo Iniciando servidor na porta 8013...

for /f "delims=[] tokens=2" %%a in ('ping -4 -n 1 %ComputerName% ^| findstr [') do set NetworkIP=%%a
echo Acesse no seu navegador http://%NetworkIP%:8013/

php -S 0.0.0.0:8013

pause