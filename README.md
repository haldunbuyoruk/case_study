# Haldun Buyorük - Developer Candidate Assessment_v1.0.2

##Project Setup

### Host Settings

```command
vi /etc/hosts
```

Add the following:

```command
127.0.0.1       developerca.hb
```

#### Add virtual host

```command

<VirtualHost *:80>
    ServerAdmin test@developerca.com
    DocumentRoot "/Users/yourprojectfolder/developerca/public"
    ServerName developerca.hb
    ServerAlias www.developerca.hb
    ErrorLog "logs/developerca.example.com-error_log"
    CustomLog "logs/developerca.example.com-access_log" common
</VirtualHost>
```

### Mysql Settings

Change the following lines ####Configs/Config.php with your MySQL credentials:

```mysql
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = 'root';
```

Run  ``` /src/db/db.sql ```

Thats all!


## Report Link (5)

Tracking report page url:

``` http://developerca.hb/reports ```
