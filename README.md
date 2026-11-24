# Drupal 11 Portfolio: Custom Theme and Kumasi Job Board

Two Drupal 11 practice projects built locally with DDEV, Composer and Drush.

## Project 1: Custom theme, SDC card and block plugin
- **fjorge_theme**: custom theme generated from the core starterkit, with a global CSS library attached through libraries.yml and info.yml.
- **Card component (SDC)**: `components/card` with title and url props, a body slot, Twig and CSS.
- **Teaser override**: `node--teaser.html.twig` renders article teasers through the card component.
- **Latest Articles block** (`fjorge_blocks` module): block plugin using the PHP `#[Block]` attribute, an access-checked entity query for the 3 newest published articles, and the `node_list` cache tag.

## Project 2: Kumasi job board
- **Job content type**: Company, Location, Job type (list), Salary, Application deadline, Body.
- **Jobs in Ghana view** at `/jobs`: exposed filters for Job type and Location (contains).
- **Views template**: `views-view-unformatted--jobs.html.twig` renders each job as a card in a responsive CSS Grid.
- **Apply form** (`job_apply` module): `hook_schema` table `job_application`, route `/jobs/apply`, Form API form with validation, a database insert and a status message.

## Tech
Drupal 11, PHP, Twig, CSS Grid, DDEV, Docker, WSL2, Composer, Drush, mkcert (local HTTPS), Git.

## Run it locally
git clone https://github.com/Ella-123-art/drupal-kumasi-job-board.git
cd drupal-kumasi-job-board
ddev start
ddev composer install
ddev drush site:install minimal -y
ddev drush config:set system.site uuid "$(grep uuid config/sync/system.site.yml | awk '{print $2}')" -y
ddev drush cim -y
ddev drush cr
ddev launch

Content (jobs and articles) is stored in the database, so add your own after installing.

## Structure
- web/themes/custom/fjorge_theme      theme, card component, templates
- web/modules/custom/fjorge_blocks    Latest Articles block plugin
- web/modules/custom/job_apply        apply form and database table
- config/sync                         exported site configuration

## Author
Emmanuella Martey Odetsi
