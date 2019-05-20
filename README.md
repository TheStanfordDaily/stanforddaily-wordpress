<img src="https://user-images.githubusercontent.com/1689183/55673023-25239a00-5857-11e9-9699-5f2d0ab365cf.png" width="100">

# Stanford Daily website
This is the Stanford Daily website. See it live at https://www.stanforddaily.com/. Contributions welcome!

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

The theme is using [Sass](https://sass-lang.com/) for styling. When developing the theme, you should be editing individual `.scss` files in the `sass/` folder. Do NOT manually edit the `style.css` file.

We are using [Grunt](https://gruntjs.com/) to compiling files.

To set up, type the following command in the theme folder (`wp-content/themes/thestanforddaily/`)
```
npm install -g grunt-cli
npm install -g sass
npm install
```

Then just type the following command every time you start working on the theme:
```
grunt
```

If you see:
```
Running "watch" task
Waiting...
```

It means that grunt is up and running. Grunt will watch your `scss` files changes and automatically update the `style.css` and `style.min.css` for you.

# Alternative ways

https://github.com/TheStanfordDaily/stanforddaily-website/wiki/Setting-up-the-Stanford-Daily-website-on-your-Mac-or-Windows-using-Local-by-Flywheel


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
