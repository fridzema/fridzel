<p align="center">
  <a href="https://fridzema.com"><img src="https://static.fridzema.com/img/fridzel.svg" alt="Fridzel logo" title="Fridzel" width="150" height="150" /></a>
</p>

# Fridzel
Fridzel | Minimalistic photo CMS 📸

## 🖼 Screenshots
<img src="https://static.fridzema.com/img/s1.jpg?v=3" alt="Frontend" title="Frontend"/>
<img src="https://static.fridzema.com/img/s2.jpg?v=3" alt="Login" title="Login"/>
<img src="https://static.fridzema.com/img/s3.jpg?v=3" alt="Admin" title="Admin"/>

## ⚙️ Features
* Basic parallel Drag and Drop File upload (Dropzone)
* Drag and drop reordering
* Photo EXIF data extraction (Not displayed yet)
* Optional CDN Support
* Optional Google Analytics Support
* Envoy deploy script

## 🚧  Roadmap
* Better responsive css, at the moment almost as minimal/showable possible
* Multiple themes, different grids
* Optional abums
* Photo search/filtering
* Reordering photos
* Configuration options
* Lightroom publishing plugin
* Photo stories and EXIF information
* Photo comments
* Photo votes
* Photo social media sharing
* Google AMP Pages
* SEO
* Ansible provision script

## Installation

Recommended:

`composer create-project fridzema/fridzel `

Or:

`git clone https://github.com/fridzema/fridzel && cd fridzel && composer install && cp .env.example .env`

Fill the `.env` file with your own values, and then do not forget to seed the database

`php artisan migrate --seed`

If there are no photos found yet you will be redirected to the login page, you can login with following default credentials:

`user@fridzel.dev`

`password`

## Questions?
Feel free to make an issue about whatever you want!

## Extra
[Photo samples](https://static.fridzema.com/downloads/fridzel-samples.zip)
