Description
===========
This is a small project that shows some sample code on how to implement several ordering services that may require 
entirely different applications.
This projects also features a full set of unit tests.

Setup
=====
- Clone this project
- run `composer install`. If you dont have composer, take a look at `getcomposer.org`
- run `docker-compose up`
- navigate to `https://localhost:8000`
  - Note that this project uses a self-signed certificate, so a privacy warning will be shown
- add a brand to the url like so: `https://localhost:8000?brand=foo`.
  - Currently supported brands are: `foo` and `bar`. Any other brand should give an error message in JSON.