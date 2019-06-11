[![The Stanford Daily logo](https://github.com/TheStanfordDaily/stanforddaily-graphic-assets/raw/master/DailyLogo/DailyLogo.png)](https://www.stanforddaily.com/)

# Stanford Daily website
[![Build Status](https://travis-ci.com/TheStanfordDaily/stanforddaily-website.svg?branch=master)](https://travis-ci.com/TheStanfordDaily/stanforddaily-website)

This is the Stanford Daily website. See it live at https://www.stanforddaily.com/. Contributions welcome!

## Local setup
### Installation
Download [VirtualBox](https://www.virtualbox.org/wiki/Downloads)

Download [Vagrant](https://www.vagrantup.com/downloads.html)

Then run the following commands to install some necessary vagrant plugins:
```
vagrant plugin install vagrant-hostmanager
vagrant plugin install vagrant-triggers
vagrant plugin install vagrant-hostsupdater
```

### Run
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

### Re-setup
Normally, when you shutdown the local server using `vagrant halt`, all data in your local database (e.g., if you posted a new article on your local website) will *not* be lost the next time you `vagrant up`.

However, if you wish to restart from a `.sql` file, you can run:
```
vagrant up # Vagrant needs first to be up and running
vagrant destroy # Current database will be exported to `wp-vagrant/db_dumps/`
# Put your `.sql` file inside `wp-vagrant/`
vagrant up
```

### More info on setup
Taken from https://github.com/digitalquery/wp-vagrant

### Alternative ways to setup
https://github.com/TheStanfordDaily/stanforddaily-website/wiki/Setting-up-the-Stanford-Daily-website-on-your-Mac-or-Windows-using-Local-by-Flywheel


## Theme Development
See https://github.com/TheStanfordDaily/tsd-wp-theme/.


## Submodules
We use submodules to track plugin dependencies from Github. WPEngine supports using submodules; that way we won't have to make copies of all the plugin files in code!
```

### Pulling latest changes from submodules (after cloning or when submodules are updated)

# init submodules
git submodule init

# update your submodule
git submodule update --remote

### Adding a new submodule
# add submodule to track master branch
git submodule add -b master [URL to Git repo] [sub-directory path]

# for example: adding a plugin to the `wp-content/plugins/` folder
git submodule add -b master https://github.com/TheStanfordDaily/tsd-push-notification.git wp-content/plugins/tsd-push-notification

```
