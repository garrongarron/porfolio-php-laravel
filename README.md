## About this project

This is a project that shows the potential of how I can work and what I can do using the PHP language and Laravel as Framework.

Here some steps to help you to deploy the project localy.

```
sudo cp .env.example .env
```

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=symfony
DB_USERNAME=symfony
DB_PASSWORD=secret
```




```
sudo docker-compose up
```


```
sudo docker exec -ti php bash
```


```
composer install
```



```
php artisan key:generate
```





```
php artisan migrate
```


```
php artisan passport:install
```



Test in the browser
```
http://localhost:8080/
```

Consider always check writing permission and grant it

```
sudo chmod -R 777 .
```