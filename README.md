# Local setup

## Installation

Download [VirtualBox](https://www.virtualbox.org/wiki/Downloads)

Download [Vagrant](https://www.vagrantup.com/downloads.html)

Then run the following commands to install some necessary vagrant plugins:
```
vagrant plugin install vagrant-hostmanager
vagrant plugin install vagrant-triggers
vagrant plugin install vagrant-hostsupdater
```

## Run

First, download the database dump (`.sql`) file and put it into the `wp-vagrant/` folder.

Then, run this command from the cloned `stanforddaily-website/` folder to start the local server: (If you are on Mac, you may need to enter in your password during this step.)
```
vagrant up
```

Open http://localhost.stanforddaily.com/ on your computer.

To sign in to the admin, go to http://localhost.stanforddaily.com/wp-admin/ and sign in with username *root* and password *root*.

To shutdown the local server, run:
```
vagrant halt
```

## Re-setup

Normally, when you shutdown the local server using `vagrant halt`, all data in your local database (e.g., if you posted a new article on your local website) will *not* be lost the next time you `vagrant up`.

However, if you wish to restart from a `.sql` file, you can run:
```
vagrant up # Vagrant needs first to be up and running
vagrant destroy # Current database will be exported to `wp-vagrant/db_dumps/`
# Put your `.sql` file inside `wp-vagrant/`
vagrant up
```

## More info on setup
Taken from https://github.com/digitalquery/wp-vagrant

# Theme Development

When developing the theme, you should be editing individual `.scss` files in the `sass/` folder. To compile all the `.scss` files into `style.css`, run the following command at the root of the theme folder (`wp-content/themes/thestanforddaily/`):
```
sass sass/style.scss style.css
```

Learn more: https://sass-lang.com/

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
Exit mysql, create admin user:

```
cd /vagrant
wp user create root local@stanforddaily.local --role=administrator --user-pass=root
```

```
mysqldump -uroot -proot wp_stanforddaily2 > /vagrant/wp-vagrant/dump.sql
sed -i 's/utf8mb4_unicode_520_ci/utf8mb4_unicode_ci/g' /vagrant/wp-vagrant/dump.sql

sed -i 's/https:\/\/localhost.stanforddaily.com/http:\/\/localhost.stanforddaily.com/g' /vagrant/wp-vagrant/dump.sql
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

# Alternative ways

https://github.com/TheStanfordDaily/stanforddaily-website/wiki/Setting-up-the-Stanford-Daily-website-on-your-Mac-or-Windows-using-Local-by-Flywheel
