# TM Task
This repository contains a basic PHP demo application that recursevly reads a predefined local directory for .xml files containing book information and inserts them into a Postgres database. The database records are shown by accesing http://localhost after runnig the `docker-compose up` from the Docker folder. 

## Prerequsite

Please visit this URL and follow the steps to install Docker and docker-compose before you try to run the stack.
https://docs.docker.com/compose/install/

## Running the stack
1. Install Docker and docker-compose;
2. Use GIT to clone the repo to local disk `git clone`;
3. Open a terminal window inside Docker folder;
4. Type `docker-compose up`;
5. If no errors then you can acces http://localhost to view the app page;
6. To upload new .xml documents first copy them in the XML folder;
7. From the Docker folder run the folowing command `docker-compose exec php bash` to gain acces to the PHP container;
8. Then run `php worker.php` and it should index all the .xml files and create the database records.