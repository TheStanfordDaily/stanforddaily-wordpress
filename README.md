# Local setup
Download [Virtualbox](https://www.virtualbox.org/wiki/Downloads)

Download [Vagrant](https://www.vagrantup.com/downloads.html) 

## Run

First, download the database dump .sql file, then put it into `wp-vagrant/dumps`.

```
vagrant plugin install vagrant-hostmanager
vagrant plugin install vagrant-triggers
vagrant plugin install vagrant-hostsupdater
vagrant up
```
(If you are on Mac, you may need to enter in your password during this step).

Open http://localhost.stanforddaily.com/ on your computer.

To sign in to the admin, go to http://localhost.stanforddaily.com/wp-admin/ and sign in with username *root* and password *root*.

## More info on setup
Taken from https://github.com/digitalquery/wp-vagrant

## Notes
Random notes:

```
vagrant ssh
```

Befor running vagrant up (if loading db dump directly from wpengine):
```
sed -i 's/utf8mb4_unicode_520_ci/utf8mb4_unicode_ci/g' /vagrant/wp-vagrant/dump.sql
perl -i -pe 's/utf8mb4_unicode_520_ci/utf8mb4_unicode_ci/g' wp-vagrant/wp_stanforddaily2.sql
```

Create admin user:

```
cd /vagrant
wp user create root admin@localhost.stanforddaily.com --role=administrator --user_pass=root
wp user update root --user_email=admin@localhost.stanforddaily.com
```

MySQL queries to make db smaller:
```
mysql -uroot -proot

use wp_stanforddaily2;
delete from wp_pv_am_activities;
delete from wp_3wp_activity_monitor_index;
delete from wp_comments;
delete from wp_popularpostssummary;
delete from wp_options where option_name like '%jnews%';
delete from wp_postmeta where meta_key like '%jnews%';
UPDATE wp_postmeta
  WHERE post_type = 'attachment'
  SET guid = replace(guid, 'localhost.stanforddaily.com', 'www.stanforddaily.com');
DELETE p, pm
  FROM wp_posts p
 INNER 
  JOIN wp_postmeta pm
    ON pm.post_id = p.ID
 WHERE (p.post_type = "post" and (p.post_date < "2018" or p.post_status != 'publish')) ;
```

Check table sizes
```
SELECT 
     table_schema as `Database`, 
     table_name AS `Table`, 
     round(((data_length + index_length) / 1024 / 1024), 2) `Size in MB` 
FROM information_schema.TABLES 
ORDER BY (data_length + index_length) DESC;
```

Nginx logs
```
sudo tail -f /var/log/nginx/error.log
sudo vim /etc/nginx/sites-enabled/default.conf
```
