# Loan APP

<h2>Introduction</h2>

It is an app that allows authenticated users to go through a loan application.

<h3>Prerequisites</h3>

<ul>
	<li>PHP: ^7.3|^8.0</li><li>Laravel: ^8.40</li><li>MySQL: ^10.4</li><li>Postman</li>
</ul>

<h3>Installation (Laravel 8.x)</h3>

<p><em>Clone/Download repository</em></p>

<p><pre>$ git clone https://github.com/aksamitksharma/loan_app</pre></p>


<p><em>Run in project folder</em></p>

<p><pre>cd folder_name</pre></p>
<p><pre>$ composer install</pre></p>


<p><em>Rename the .env.example to .env and do your db configurations</em></p>


<h3>Migration and Seed</h3>

<p><em><strong>Run in project folder:</strong></em></p>

<p><pre>$ php artisan migrate:fresh --seed</pre></p>


<h3> Seeded Login Credentials </h3>

<p><em><strong>User email: johndoe@mail.com</strong></em></p>

<p><em><strong>All seeded accounts use '<b>test@123</b>' password as well</strong></em></p>

<h3>Import Postman Setup</h3>

<p><em>Import Loan App.postman_collection file into Postman <small>(It is in your root directory)</small></em></p>


<h3>Postman Setup</h3>
 - <p><em>Configure 'Headers' to support 'JSON' response.</em></p>

 - <p><em>Run Login API with respective valid username and password.</em></p>

 - <p><em>Copy the response authorized token.</em></p>

 - <p><em>To access loans API, Need to configure authorization 'Headers' with 'Bearer authorized-token'</em></p>


<h3>Run Laravel App</h3>
Run `php artisan serve`

<h3>Testing</h3>
To run Feature and Unit tests
Run `php artisan test`

