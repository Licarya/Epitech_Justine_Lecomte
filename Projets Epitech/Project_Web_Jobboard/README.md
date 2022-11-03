# <div align="center"> :computer: AGENCE-JA :computer: </div>

<div align="center"><em>Justine LECOMTE && Antoine DUQUENNE </em> </div><br><br>

Pour utiliser le projet, une fois cloner : ``` composer install ```

## Resume
This project aims at realising:

* a database to store job advertisements,
* a webpage (front end) using Javascript technologies to display an online job advertisements board as well as an adminitration page for the admin user,
* an API (back end)
* to allow user to apply to jobs
* to manage the DB (only for admin user) - CRUD operations (Create, Read, Update, Delete)

## Summary
1. [Steps](#steps)
2. [Technologies used](#technologies-used)
3. [API CRUD](#api-crud-1)
4. [Sources](#sources)

## Steps

<details><summary>Step 01</summary>
<p>
<h4>Create an SQL database to store job advertisements</h4>
<p>It must contain at least :</p>
<ul>
<li>a table to store advertisements</li>
<li>a table to store companies</li>
<li>a table to store people (whether in charge of an advertisement or applying to an advertisement)</li>
<li>a table to keep information about a job application (referencing the mails sent, the people concerned, the ad concerned...)</li>
</ul>
</p>
</details>

<details><summary>Step 02</summary>
<h4>Write a HTML/CSS page showing several job advertisements.</h4>
<p>
For each ad, there must be at least a place for a title, one for a short description, and a <em>“learn more”</em> button.
Clicking on this <em>“learn more”</em> button does not have any action for the moment.
</p>
</details>

<details><summary>Step 03</summary>
<h4>The <em>"learn more".</em> button</h4>
<p>
Must now display all the available information about the ad (full description, wages,
place, working time,.. .), without reloading the page.
<strong>No popup.</strong>
Keep the database fields coherent with the information you display on the HTML page.
</p>
</details>

<details><summary>Step 04</summary>
<h4>API CRUD.</h4>
<p>
Create an API providing CRUD operations on the database tables <strong>(Create, Read, Update, Delete)</strong>.
The “learn more” button must be linked to an API route to dynamically fetch the job infos.
</p>
</details>

<details><summary>Step 05</summary>
<h4>On your webpage, add an <em>“Apply”</em> button for each ad. When this button is clicked, it opens a form to :</h4>
<ul>
<li>enter information about you (name, email, phone,.. .)</li>
<li>send a message to the owner of the ad (you)</li>
</ul>
<p>
This action must be saved in the database.
</p>
</details>

<details><summary>Step 06</summary>
<h4>Add an authentication mecanism on the webpage.</h4>
<p>
When identified, you don’t have to fill in your personal information to apply to a job.
</p>
</details>

<details><summary>Step 07</summary>
<h4>Create a HTML/CSS page for monitoring the database.</h4>
<p>
From this page the user can list all the records of your tables, can create new records and can update or delete the existing ones. 
This page can be accessed only by an admin. So a successful connection rediret to this page for an admin user or to the page created at <strong>step 02</strong> otherwise.
</p>
</details>

<details><summary>Step 08</summary>
<h4>Now you can polish your pages up by improving their design, tweaking and refining the style sheets.</h4>
</details>

## Technologies used

| Framework  | Back-end |  Font-end  |    Database     |
| :--------: | :------: | :--------: | :-------------: |
|  Laravel 9 |   PHP8   | HTML5/CSS3 | Mysql Workbench |
|[Documentation](https://laravel.com/docs/9.x)| [Documentation](https://www.php.net/manual/en)|[HTML5](https://developer.mozilla.org/fr/docs/Web/HTML)/[CSS3](https://developer.mozilla.org/fr/docs/Web/CSS/Reference)| [Documentation](https://dev.mysql.com/doc/workbench/en/) |


## API CRUD

#### Create a model to target columns in a table {dir: app/Models/...}[^1]
```js
//Replace "Name" with your needs
php artisan make:model Name
```

#### With the model create a migration file {dir: database/migrations/...}[^2]
```js
//Replace "nameTable" with your needs
php artisan make:migration create_nameTable_table
```

#### Lauch server (default: http://localhost:8000)
```js
php artisan serve
```

#### Create a Controller for CRUD API, flag `-r` refer to add automatically each CRUD method[^3]
```js
//Replace "Name" with your needs but keep "Controller"
php artisan make:controller NameController -r
```

#### Create a Request to add attribute for each columns like `required`, `max:32`(nb of char)...[^4]
```js
//Replace "Name" with your needs but keep "Request"
php artisan make:request NameRequest
```

#### With this command you can check every Route of your project
```js
php artisan route:list
```

#### Migrate files shema into your BDD, `:fresh` remove every Tables existing to create new one
```js
php artisan migrate:fresh
```

## Sources


*Laravel Doc*
[^1]:[Models_laravel](https://laravel.com/docs/9.x/eloquent)
[^2]:[Migrations_laravel](https://laravel.com/docs/9.x/migrations)
[^3]:[Controllers_laravel](https://laravel.com/docs/9.x/controllers)
[^4]:[Requests_laravel](https://laravel.com/docs/9.x/requests#retrieving-uploaded-files)
