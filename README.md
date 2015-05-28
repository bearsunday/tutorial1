# MyVendor.Weekday

A tutorial application that introduces and explains step-by-step how to use BEAR.Sunday in [official manual](http://bearsunday.github.io/manuals/1.0/en/tutorial.html).


## Install

```
git clone https://github.com/bearsunday/MyVendor.Weekday.git
cd MyVendor.Weekday
composer install
```

### Request `/weekday` resource

```
php bootstrap/api.php options /weekday
```
```
200 OK
allow: get
```
```
php bootstrap/api.php get '/weekday/1981/09/08'
```
```
200 OK
Content-Type: application/hal+json

{
    "weekday": "Tue",
    "_links": {
        "self": {
            "href": "/weekday/1981/09/08"
        }
    }
}
```
See `var/log/weekday.log`.

## @Cacheable test

Start PHP server
```
 php -S 127.0.0.1:8081 bootstrap/api.php 
```

### GET
```
 curl -v http://127.0.0.1:8081/todo?id=1
```

### PUT 

```
curl http://127.0.0.1:8081/todo?id=1 -X PUT -d 'id=1&todo=think'
```
