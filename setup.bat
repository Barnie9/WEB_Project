@echo off

:: Numele proiectului
set PROJECT_NAME=CalendarAPI

:: Calea către directorul htdocs
set PROJECT_DIR=C:\xampp\htdocs

:: URL-ul repository-ului Git
set REPO_URL=https://github.com/Barnie9/WEB_Project.git

:: Crearea directorului proiectului web_project dacă nu există
if not exist %PROJECT_DIR%\web_project (
    mkdir %PROJECT_DIR%\web_project
)

:: Navigarea în directorul proiectului
cd %PROJECT_DIR%\web_project

:: Clonarea repository-ului Git
git clone %REPO_URL% .

:: Instalarea Node.js și npm dacă nu sunt deja instalate
where node >nul 2>nul
if %errorlevel% neq 0 (
    echo Node.js și npm nu sunt instalate. Instalarea acestora...
    curl -o nodejs.msi https://nodejs.org/dist/v16.13.0/node-v16.13.0-x64.msi
    msiexec /i nodejs.msi /quiet /norestart
    del nodejs.msi
)

cd app

:: Instalarea pachetelor npm din package.json
if exist package.json (
    npm install
)

:: Mesaj de finalizare
echo Configurarea proiectului %PROJECT_NAME% a fost finalizată cu succes!

pause
