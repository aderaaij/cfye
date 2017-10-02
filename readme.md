# 🌅 WP-Dawn - A WordPress starter Repo

A WordPress starter package to make WordPress theming fun! 

This package will automatically install WordPress in a subdirectory and start a gulp task to watch and compile assets to the starter theme.

### Install
* Clone package
* Run `yarn install`
* Run `gulp composer`
* Create a database
* Create `local-config.php` in `app/www/` with database credentials
* Create a virtual host pointing at `app/www/`
* Change `appUrl` in `gulpfile.js/config/index.js` to whatever vhost you just made
* Go to hostname and run the WP Installer
* Run `gulp`
* Start theming

### Rename Theme
To rename the theme you'll need to edit the following files/folders
* `gulpfile.js/config/index`, `themename`
* `app/www/content/themes/themefolder`
* `app/www/content/themes/style.css` => `Theme name:`

### To-Do
* Run a WP installer prompt from console for configuring wp-config, etc
* Use a DOTENV file to define wp-config and environment