<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Steps to install the Medical Center Application

1. Clone the repository
2. Run `vagrant ssh`
3. Run `composer install` 
4. Copy the .env.example and rename the file as .env
5. Add to you Homestead.yaml file the following lines :

sites:     
    - map: project.test
      to: /home/vagrant/WAF/MyLaravelProjects/Cassandra/public

(pagination is sensitive)

databases:
    - cassandra


6. On the htdocs file `127.0.0.1 project.test` (that will be your URL)
7. Run `php artisan migrate`
8. Run `php artisan db:seed`
9. Make sure node.js is installed and run ```npm run dev```  

## Side notes
When logging in, you have the choice between four users
- the admin: his email is ```smith@mail.com``` and password ```secret``` -> admin user
- the doctors :  ```mcfiffe@mail.com``` and password ```secret``` -> moderator user
- the cleitns :  ```farelly@mail.com``` and password ```secret``` -> client user
