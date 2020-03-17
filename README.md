[![The Stanford Daily logo](https://github.com/TheStanfordDaily/stanforddaily-graphic-assets/raw/master/DailyLogo/DailyLogo.png)](https://www.stanforddaily.com/)

# Stanford Daily website
[![Build Status](https://travis-ci.com/TheStanfordDaily/stanforddaily-website.svg?branch=master)](https://travis-ci.com/TheStanfordDaily/stanforddaily-website)

This is the Stanford Daily website. See it live at https://www.stanforddaily.com/. Contributions welcome!

## Local setup
### Installation
First, install `docker` and `docker-compose`. Make sure the Docker daemon is running.

### Run
Then run

```
docker-compose up
```

Finally, open http://localhost:8000/wp-admin/ in your computer.

You can log in with username `root` and password `root`.

## Theme Development
See https://github.com/TheStanfordDaily/tsd-wp-theme/.


## Submodules
We use submodules to track plugin dependencies from Github. WPEngine supports using submodules; that way we won't have to make copies of all the plugin files in code!

```bash
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
