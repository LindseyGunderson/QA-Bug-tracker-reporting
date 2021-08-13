# QA-Bug-tracker
 This is a QA bug tracking application, where users can track bugs and leave comments to address the bugs.
 
 ## Technologies Used
<img alt="PHP" src="https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=white&style=flat-square"/> <img alt="MySQL" src="https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=white&style=flat-square"/>
<img alt="HTML5" src="https://img.shields.io/badge/-HTML5-E34F26?logo=html5&logoColor=white&style=flat-square"/>
<img alt="CSS3" src="https://img.shields.io/badge/-CSS3-1572B6?logo=css3&logoColor=white&style=flat-square"/>
<img alt="Bootstrap" src="https://img.shields.io/badge/-Bootstrap-7952B3?logo=bootstrap&logoColor=white&style=flat-square"/>

## Legend

- Description
- Installation
- Overview


## Description
This applicaiton was inspired by a QA course within the New Media program at BCIT. Taking my knowledge of PHP, I wanted to create a login system and create a way for bugs to be tracked on a project. The user will login and see all the bugs reported and can leave comments on each bug. Once the bug has been tested, it can be moved to resolved or the option to reopen the ticket will also be available.

## Installation
#### Database
In order this application to run, you will need to connect to a MySQL server. MAMP is suggested. However feel free to use whichever application fits your needs. Once you've created the database, use the included sql file to set up the structure of your database to import the tables for your database. 

### Connections
Just a note, in order to connect to your database, you will need to add your credentials to `inc/config.php`. Make all variables match your development environment.

## Overview Images

### Login Page
[![login.jpg](https://i.postimg.cc/FRYT51r0/login.jpg)](https://postimg.cc/34HX28Dw)

### Main Page After Login
[![main-page.jpg](https://i.postimg.cc/qMVjSk9C/main-page.jpg)](https://postimg.cc/fkCc0hWw)

### Add A New Bug/Issue
[![added-bug.jpg](https://i.postimg.cc/3wcZB7XN/added-bug.jpg)](https://postimg.cc/2qnvksXN)

### Add A Comment To A Bug
[![added-comment.jpg](https://i.postimg.cc/FztgMZnQ/added-comment.jpg)](https://postimg.cc/620vRdXH)

### Resolve/Re-Open Bug
[![re-open.jpg](https://i.postimg.cc/1XpcsqLV/re-open.jpg)](https://postimg.cc/4Hxh1m4X)
