

# NotesUP 

### What is NotesUp?
NotesUP is basically a note app like Google Keeps.  You can write, delete and change your notes. 

## Installation 
First of all we should install php and php server.`Xampp` includes them. 
You can install `Xampp` [here](https://www.apachefriends.org/tr/download.html).

After install Xampp we are going to `htdocs` folder. Because all of frontend and backend codes executes from there. You can change folder which  php mainly  executes  but i prefer it is  default. 

You will see lots of file and folder in `htdocs` folder. Don't worry you can delete all of them in `htdocs`.
Copy all files and folders without sql folder to `htdocs` folder and start Xampp. 

Start Apache and MySQL servers. 

> Photo is  representation. Versions can be different.

<hr>
<img src="https://i.ytimg.com/vi/2Xog4Mebpg0/maxresdefault.jpg">
<hr>

### After start servers...
We have to configure MySQL database for user activity. I prepared that for you. In `sql` folder your database is ready for use. 
Go localhost/phpmyadmin and sing in and create new database. 

> Database name must be `first_database`. Otherwise MySQL server throws error. 

After create the database, you can import sql tables. In this webApp we have 2 table. 
One of them for user accounts and other one is for user notes. 

After create database select import button and select sql files in `sql` folder. 

<img src="https://help.one.com/hc/article_attachments/115010378189/en_choose-file-to-import.png">

### Thats All! 
Restart your Apache and MySQL servers and go `localhost`. 


