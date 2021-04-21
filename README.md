<p align="center">    
    <strong>
      COVID19 Resource Directory
    </strong>
</p>
<p align="center">
    <img src="https://cdn.discordapp.com/attachments/530789778912837640/807544305526898698/icrewsystems-bot.png" width="300">   
</p>
<p align="center">    
    <small>
	Built with compassion, by humans at icrewsystems
   </small>
</p>

## About
This project is aimed to be used as a directory listing for resources about COVID19 in India. The application is capable of retrieving and indexing data from API sources.

## How to setup
1. ```git clone https://github.com/icrewsystemsofficial/covid19resources.git```
2. cd into the directory
3. Run composer install, ```composer install```
4. Create a seperate branch for yourself in git. ```git branch BRANCHNAME``` & ```git checkout BRANCHNAME``` -- Interns are requested not to use Master branch at all.
5. Copy .env file, ```cp .env.example .env```
6. Generate Key ```php artisan key:generate```
7. Create a database named ```laravel_airlime```
8. Go to /database/seed/DeveloperAccess.php and update the second entry to your name & email ID. By default, it will have Leonard's account setup. You can edit it or add a new entry for yourself. Enter your password by using the Hash facade, ```Hash::make("MyPassword")```
9. Setup symlink by running ```php artisan storage:link``` (This is only required the first time).
10. Migrate DB & Seed it (only required on the first time, unless directed by Project Manager)  ```php artisan migrate --seed```

## ALWAYS REMEMBER
1. Whenever you pull from the repository, please run ```composer install``` and ```npm run dev``` to compile all assets.
2. Run ```php artisan migrate:fresh --seed```. All required data MUST be put into the DB as seeders.

Done! Your project is now setup. You can now directly run it by going to your [http://localhost/covid19resources](http://localhost/covid19resources), you HAVE to run ```php artisan serve``` command. Since we'll be using ngrok to show previews to the client, it's mandatory to leave the server.php intact. If you're using Laragon, you don't have to worry about this, else you have to add an ```ASSET_URL="${APP_URL}/public"``` in your .env file. You can have a spearate tab open to run the php artisan serve command. 

## How to report?
Mark your assigned tasks from "Planned" to "In Progress" while working on it, Once you've committed & pushed it, change the task status to "Done". You must report your work on the commits.

## Copyrights
icrewsystems Software Engineering LLP, India <br>
<img src="https://icrewsystems.com/logo.png" width="150">   
