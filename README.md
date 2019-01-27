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

# Alternative ways

https://github.com/TheStanfordDaily/stanforddaily-website/wiki/Setting-up-the-Stanford-Daily-website-on-your-Mac-or-Windows-using-Local-by-Flywheel
