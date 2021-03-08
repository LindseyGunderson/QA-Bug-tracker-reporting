# QA-Bug-tracker-reporting
 This is a QA bug tracking application, where users can track bugs and leave comments to address the bugs.

## Legend

- Description
- Installation


## Description
This applicaiton was inspired by a QA course within the New Media program at BCIT. Taking my knowledge of PHP, I wanted to create a login system and create a way for bugs to be tracked on a project. The user will login and see all the bugs reported and can leave comments on each bug. Once the bug has been tested, it can be moved to resolved or the option to reopen the ticket will also be available.

## Installation
#### Database
In order this application to run, you will need to connect to a MySQL server. MAMP is suggested. However feel free to use whichever application fits your needs. Once you've created the database, use the included sql file to set up the structure of your database to import the tables for your database. 

### Connections
Just a note, in order to connect to your database, you will need to add your credentials to `inc/config.php`. Make all variables match your development environment.